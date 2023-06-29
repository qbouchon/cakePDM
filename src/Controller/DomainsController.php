<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Domains Controller
 *
 * @property \App\Model\Table\DomainsTable $Domains
 * @method \App\Model\Entity\Domain[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class DomainsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $domains = $this->paginate($this->Domains);

        $this->set(compact('domains'));
    }

    /**
     * View method
     *
     * @param string|null $id Domain id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $domain = $this->Domains->get($id, [
            'contain' => ['Resources'],
        ]);

        $this->set(compact('domain'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
   public function add()
    {
        $domain = $this->Domains->newEmptyEntity();

        if ($this->request->is('post')) {

            $domain->set('name',$this->request->getData('name'));

            if(!$domain->getErrors) {

                $picture = $this->request->getData('picture');
                $fileName = $domain->id.$picture->getClientFilename();
                $targetPath = WWW_ROOT.'img'.DS.'domains'.DS.$fileName;

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
                                $domain->set('picture', $fileName); 
                            }
                                  
                        }
            }
            
                 
            if ($this->Domains->save($domain)) {
                $this->Flash->success(__('The domain has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The domain could not be saved. Please, try again.'));
        }
        $this->set(compact('domain'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Domain id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $domain = $this->Domains->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $domain = $this->Domains->patchEntity($domain, $this->request->getData());
            if ($this->Domains->save($domain)) {
                $this->Flash->success(__('The domain has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The domain could not be saved. Please, try again.'));
        }
        $this->set(compact('domain'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Domain id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $domain = $this->Domains->get($id);
        if ($this->Domains->delete($domain)) {
            $this->Flash->success(__('The domain has been deleted.'));
        } else {
            $this->Flash->error(__('The domain could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
