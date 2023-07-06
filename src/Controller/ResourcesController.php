<?php
declare(strict_types=1);
namespace App\Controller;

use App\Model\Entity\File;
use App\Model\Table\FilesTable;

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
        $this->paginate = [
            'contain' => ['Domains'],
        ];
        $resources = $this->paginate($this->Resources);

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


        //gestion fil d'Ariane
        // $this->Breadcrumbs->add(
        //             'Liste des ressources ',
        //              ['controller' => 'Resources', 'action' => 'view']
        // );


        $resource = $this->Resources->get($id, [
            'contain' => ['Domains', 'Files', 'Reservations'],
        ]);

        $this->set(compact('resource'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {


        // //gestion fil d'Ariane
        // $this->Breadcrumbs->add(
        //             'Créer une ressource ',
        //              ['controller' => 'Resources', 'action' => 'add']
        // );



        $resource = $this->Resources->newEmptyEntity();

        if ($this->request->is('post')) {


            if(!$resource->getErrors) {

                $resource->set('name', $this->request->getData('name'));
                $resource->set('description', $this->request->getData('description'));
                $resource->set('domain_id', $this->request->getData('domain_id'));
                $resource->set('archive', $this->request->getData('archive'));

                //ajout de l'image
                $resource->addPicture($this->request->getData('picture'));

                //Upload des fichiers 
                $resource->addFiles($this->request->getData('files'),$this->getTableLocator()->get('Files'));

                if ($this->Resources->save($resource)) {

                    $this->Flash->success(__('Ressource '.$resource->name.' créee'));

                    return $this->redirect(['action' => 'index']);
                }

                $this->Flash->error(__('Erreur lors de la création e la ressource '.$resource->name));
                
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

        // //gestion fil d'Ariane
        // $this->Breadcrumbs->add(
        //             'Editer '.$resource->name,
        //              ['controller' => 'Resources', 'action' => 'edit']
        // );



        $resource = $this->Resources->get($id, [
            'contain' => ['Files'],
        ]);


        if ($this->request->is(['patch', 'post', 'put'])) {
     
            if(!$resource->getErrors) {

                $resource->set('name', $this->request->getData('name'));
                $resource->set('description', $this->request->getData('description'));
                $resource->set('domain_id', $this->request->getData('domain_id'));
                $resource->set('archive', $this->request->getData('archive'));

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

                    return $this->redirect($this->referer());
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

        //Gestion de la suppression de l'image sur le serveur
        if($resource->picture_path)
        {
            $resource->deletePicture();
        }

        //Supression des fichiers
        $resource->deleteFiles($resource->files, $this->getTableLocator()->get('Files'));

        //Suppression des réservations
        $resource->deleteReservations($resource->reservations, $this->getTableLocator()->get('Reservations') );

        if ($this->Resources->delete($resource)) {
            $this->Flash->success(__('La ressource '. $resource->name .' a été supprimée'));
        } else {
            $this->Flash->error(__('La ressource '. $resource->name .' n\'a pas pu être supprimée'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function archive($id = null)
    {
        $this->request->allowMethod(['post', 'put', 'patch']);
        $resource = $this->Resources->get($id, [
        ]);

            $resource->set('archive',true);

        if ($this->Resources->save($resource)) {
            $this->Flash->success(__('Ressource '.$resource->name.' archivée'));
        } else {
            $this->Flash->error(__('TLa resource '.$resource->name.' n\'a pas pu être archivée.'));
        }

        return $this->redirect($this->referer());
    }

    public function unArchive($id = null)
    {
        $this->request->allowMethod(['post', 'put', 'patch']);
        $resource = $this->Resources->get($id, [
        ]);

            $resource->set('archive',false);

        if ($this->Resources->save($resource)) {
            $this->Flash->success(__('Ressource '.$resource->name.' désarchivée'));
        } else {
            $this->Flash->error(__('La resource '.$resource->name.' n\'a pas pu être désarchivée.'));
        }

        return $this->redirect($this->referer());
    }
}
