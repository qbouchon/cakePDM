<?php
declare(strict_types=1);

namespace App\Controller;

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
        $resource = $this->Resources->newEmptyEntity();
        if ($this->request->is('post')) {

            //$resource = $this->Resources->patchEntity($resource, $this->request->getData());
            $resource->set('name', $this->request->getData('name'));
            $resource->set('description', $this->request->getData('description'));
            $resource->set('domain_id', $this->request->getData('domain_id'));
            $resource->set('archive', $this->request->getData('archive'));

            //gestion de l'upload de l'image
             if(!$resource->getErrors) {

                $picture = $this->request->getData('picture');
                $fileName = $picture->getClientFilename();
                $targetPath = WWW_ROOT.'img'.DS.'resources'.DS.$resource->id.$fileName;

                        if($fileName) {
                                       
                            //check si c'est une image
                            $allowed_types = array ( 'image/jpeg', 'image/png', 'image/jpg' );
                            $fileInfo = finfo_open(FILEINFO_MIME_TYPE);
                            $detected_type = finfo_file( $fileInfo, $_FILES['picture']['tmp_name'] );
                                        
                            if (!in_array($detected_type, $allowed_types)) {

                                die ( 'Please upload a pdf or an image ' );
                            }
                            else {

                                finfo_close( $fileInfo );

                                $picture->moveTo($targetPath);
                                $resource->set('picture', $fileName); 
                            }
                                  
                        }
            }




            if ($this->Resources->save($resource)) {
                $this->Flash->success(__('The resource has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The resource could not be saved. Please, try again.'));
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
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {

           // $resource = $this->Resources->patchEntity($resource, $this->request->getData());
            $resource->set('name', $this->request->getData('name'));
            $resource->set('description', $this->request->getData('description'));
            $resource->set('domain_id', $this->request->getData('domain_id'));
            $resource->set('archive', $this->request->getData('archive'));

             //gestion de l'upload de l'image
             if(!$resource->getErrors) {

                $picture = $this->request->getData('picture');
                $fileName = $picture->getClientFilename();
                $targetPath = WWW_ROOT.'img'.DS.'resources'.DS.$resource->id.$fileName;

                        if($fileName) {
                                       
                            //check si c'est une image
                            $allowed_types = array ( 'image/jpeg', 'image/png', 'image/jpg' );
                            $fileInfo = finfo_open(FILEINFO_MIME_TYPE);
                            $detected_type = finfo_file( $fileInfo, $_FILES['picture']['tmp_name'] );
                                        
                            if (!in_array($detected_type, $allowed_types)) {

                                die ( 'Please upload a pdf or an image ' );
                            }
                            else {

                                finfo_close( $fileInfo );

                                $picture->moveTo($targetPath);
                                $resource->set('picture', $fileName); 
                            }
                                  
                        }
            }


            if ($this->Resources->save($resource)) {
                $this->Flash->success(__('The resource has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The resource could not be saved. Please, try again.'));
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
        $resource = $this->Resources->get($id);
        if ($this->Resources->delete($resource)) {
            $this->Flash->success(__('The resource has been deleted.'));
        } else {
            $this->Flash->error(__('The resource could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
