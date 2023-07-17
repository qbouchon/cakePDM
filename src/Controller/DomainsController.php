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
        $domains = $this->paginate($this->Domains->find('all')->contain('Resources'));

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

     public function resources($id = null)
    {
        $domain = $this->Domains->get($id, [
            'contain' => ['Resources' => ['Files']],
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
            $domain->set('description',$this->request->getData('description'));


            if(!$domain->getErrors) {

                $domain->addPicture($this->request->getData('picture'));
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


            if(!$domain->getErrors) {

                $domain->set('name',$this->request->getData('name'));
                $domain->set('description',$this->request->getData('description'));


                //Gestion de la suppression de l'image
                if(!empty($this->request->getData('deletePicture')))
                {               
                    $domain->deletePicture();
                }

                //gestion de l'upload de l'image
                $domain->addPicture($this->request->getData('picture'));
                    

                if ($this->Domains->save($domain)) {

                     $this->Flash->success(__('The domain has been saved.'));
                    return $this->redirect(['action' => 'index']);
                }
               
                $this->Flash->error(__('The domain could not be saved. Please, try again.'));

            }


            
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
        $domain = $this->Domains->get($id, ['contain' => ['Resources']]);


        //Gestion de la suppression de l'image sur le serveur
        if($domain->picture_path)
        {
            $domain->deletePicture();
        }

        //On rend les ressources associées orphelines
        $domain->removeResources($domain->resources,$this->getTableLocator()->get('Resources'));



        if ($this->Domains->delete($domain)) {
            $this->Flash->success(__('The domain has been deleted.'));
        } else {
            $this->Flash->error(__('The domain could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
