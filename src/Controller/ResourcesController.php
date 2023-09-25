<?php
declare(strict_types=1);
namespace App\Controller;

use App\Model\Entity\File;
use App\Model\Table\FilesTable;
use Cake\Core\Configure;
use Cake\ORM\TableRegistry;
use Cake\I18n\FrozenDate;

/**
 * Resources Controller
 *
 * @property \App\Model\Table\ResourcesTable $Resources
 * @method \App\Model\Entity\Resource[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ResourcesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        //Authorisation. Trouver une meilleure pratique
        if($this->Authentication->getIdentity()->get('admin'))
            $this->Authorization->skipAuthorization();

        $this->paginate = [
            'contain' => ['Domains'],
            'order' => ['Resources.archive' => 'asc']
        ];
        $resources = $this->paginate($this->Resources->find());

        $this->set(compact('resources'));
    }

    /**
     * View method
     *
     * @param string|null $id Resource id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $resource = $this->Resources->get($id, [
            'contain' => ['Domains', 'Files', 
                            
                            'Reservations'=> [
                                'conditions' => ['Reservations.is_back' => false], 
                                'sort' => ['Reservations.end_date' => 'DESC']],
                           
                        'Reservations.Users', 'Reservations.Resources'],
        ]);

        //Authorization
        $this->Authorization->authorize($resource);

        //Mail Text
        $default_configuration = Configure::read('default_configuration');

        $configurationTable = TableRegistry::getTableLocator()->get('Configuration');

        $configuration = $configurationTable->find()
        ->where(['name' => $default_configuration])->first();


        $this->set(compact('resource', 'configuration'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $resource = $this->Resources->newEmptyEntity();
        
        //Authorization
        $this->Authorization->authorize($resource);


        if ($this->request->is('post')) {


            if(!$resource->getErrors) {

                $resource->set('name', $this->request->getData('name'));
                $resource->set('description', $this->request->getData('description'));
                $resource->set('domain_id', $this->request->getData('domain_id'));
                $resource->set('archive', $this->request->getData('archive'));
                $resource->set('max_duration', $this->request->getData('max_duration'));

                
                //Deprécié il n'y a plus que 2 couleurs pour afficher les ressources (voir getReservationsBetween de reservation controller)
                // if($this->request->getData('color')) // && $this->request->getData('color') != '#ffffff')
                //     $resource->set('color', $this->request->getData('color'));
                // else
                //     $resource->setRandomColor();
                

                if( $this->request->getData('domain_id'))
                    $resource->set('domain', $this->getTableLocator()->get('Domains')->get($this->request->getData('domain_id')));

                //ajout de l'image
                $resource->addPicture($this->request->getData('picture'));

                //Upload des fichiers 
                $resource->addFiles($this->request->getData('files'),$this->getTableLocator()->get('Files'));

                if ($this->Resources->save($resource)) {

                    $this->Flash->success(__('Ressource '.$resource->name.' créee'));

                    return $this->redirect(['action' => 'index']);
                }

                $this->Flash->error(__('Erreur lors de la création de la ressource '.$resource->name));
                
            }
     
        }

        $domains = $this->Resources->Domains->find('list', ['limit' => 200])->all();
        $this->set(compact('resource', 'domains'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Resource id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {

        $resource = $this->Resources->get($id, [
            'contain' => ['Files'],
        ]);
       
        //Authorization
        $this->Authorization->authorize($resource);



        if ($this->request->is(['patch', 'post', 'put'])) {
     
            if(!$resource->getErrors) {

                $resource->set('name', $this->request->getData('name'));
                $resource->set('description', $this->request->getData('description'));
                $resource->set('domain_id', $this->request->getData('domain_id'));
                $resource->set('archive', $this->request->getData('archive'));
                $resource->set('max_duration', $this->request->getData('max_duration'));

                if( $this->request->getData('domain_id'))
                    $resource->set('domain', $this->getTableLocator()->get('Domains')->get($this->request->getData('domain_id')));


                //Deprécié il n'y a plus que 2 couleurs pour afficher les ressources (voir getReservationsBetween de reservation controller)
                // if($this->request->getData('color') && $this->request->getData('color') != '#FFFFFF')
                //     $resource->set('color', $this->request->getData('color'));
                // else
                //     $resource->setRandomColor();

                //Gestion de la suppression de l'image
                if(!empty($this->request->getData('deletePicture')))
                {             
                    $resource->deletePicture();
                }

                //gestion de la suppression des fichiers
                $resource->deleteFilesByIds($this->request->getData('deleteFile'),$this->getTableLocator()->get('Files'));

                //gestion de l'upload de l'image
                $resource->addPicture($this->request->getData('picture'));

                //Gestion de l'upload de fichiers
                $resource->addFiles($this->request->getData('files'),$this->getTableLocator()->get('Files'));


                if ($this->Resources->save($resource)) {

                    $this->Flash->success(__('Ressource '.$resource->name.' modifiée'));                

                    return $this->redirect(['action' => 'index']);
                }

                $this->Flash->error(__('Erreur lors de la modification de la ressource '.$resource->name));
                    
            }

        }

        $domains = $this->Resources->Domains->find('list', ['limit' => 200])->all();
        $this->set(compact('resource', 'domains'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Resource id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $resource = $this->Resources->get($id, [
            'contain' => ['Files', 'Reservations'],
        ]);
        
        //Authorization
        $this->Authorization->authorize($resource);


        //Gestion de la suppression de l'image sur le serveur
        if($resource->picture_path)
        {
            $resource->deletePicture();
        }

        //Supression des fichiers
        $resource->deleteFiles($resource->files, $this->getTableLocator()->get('Files'));

        //Suppression des réservations
        $resource->deleteReservations($resource->reservations, $this->getTableLocator()->get('Reservations') );

        if ($this->Resources->delete($resource))
            $this->Flash->success(__('La ressource '. $resource->name .' a été supprimée'));
        else 
            $this->Flash->error(__('La ressource '. $resource->name .' n\'a pas pu être supprimée'));
    
        return $this->redirect(['action' => 'index']);
    }

    public function archive($id = null)
    {
        $this->request->allowMethod(['post', 'put', 'patch']);
        $resource = $this->Resources->get($id, [
        ]);
        
        //Authorization
        $this->Authorization->authorize($resource);

        $resource->set('archive',true);

        if ($this->Resources->save($resource)) 
            $this->Flash->success(__('Ressource '.$resource->name.' archivée'));
         else 
            $this->Flash->error(__('TLa resource '.$resource->name.' n\'a pas pu être archivée.'));

        return $this->redirect($this->referer());
    }

    public function unArchive($id = null)
    {
        $this->request->allowMethod(['post', 'put', 'patch']);
        $resource = $this->Resources->get($id, [
        ]);
        
        //Authorization
        $this->Authorization->authorize($resource);

        $resource->set('archive',false);

        if ($this->Resources->save($resource))
            $this->Flash->success(__('Ressource '.$resource->name.' désarchivée'));
        else
            $this->Flash->error(__('La resource '.$resource->name.' n\'a pas pu être désarchivée.'));

        return $this->redirect($this->referer());
    }



    public function getCurrentReservationsDates($id = null, $id_reservation = null)
    {
        $resource = $this->Resources->get($id, ['contain' => 'Reservations'
        ]);

        //Authorization
        $this->Authorization->authorize($resource);

        if($id_reservation)
        {
            $reservation = $this->Resources->Reservations->get($id_reservation);
            $dates = $resource->getCurrentReservationsDatesESR($reservation);
        }
        else
            $dates = $resource->getCurrentReservationsDates();

        // Convert the data to JSON format and send it as the response
        $this->autoRender = false;
        $this->response->getBody()->write(json_encode($dates));
        $this->response = $this->response->withType('application/json');

        return $this->response;
    }

    public function getMaxDuration($id = null)
    {
        $resource = $this->Resources->get($id);

        //Authorization
        $this->Authorization->authorize($resource);

        $md = $resource->max_duration;
              
        // Convert the data to JSON format and send it as the response
        $this->autoRender = false;
        $this->response->getBody()->write(json_encode($md));
        $this->response = $this->response->withType('application/json');

        return $this->response;
    }


}


