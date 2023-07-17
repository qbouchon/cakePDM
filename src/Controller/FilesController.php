<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Files Controller
 *
 * @property \App\Model\Table\FilesTable $Files
 * @method \App\Model\Entity\File[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class FilesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Resources'],
        ];
        $files = $this->paginate($this->Files);

        $this->set(compact('files'));
    }

    /**
     * View method
     *
     * @param string|null $id File id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $file = $this->Files->get($id, [
            'contain' => ['Resources'],
        ]);

        $this->set(compact('file'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $file = $this->Files->newEmptyEntity();
        if ($this->request->is('post')) {
            $file = $this->Files->patchEntity($file, $this->request->getData());
            if ($this->Files->save($file)) {
                $this->Flash->success(__('The file has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The file could not be saved. Please, try again.'));
        }
        $resources = $this->Files->Resources->find('list', ['limit' => 200])->all();
        $this->set(compact('file', 'resources'));
    }

    /**
     * Edit method
     *
     * @param string|null $id File id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $file = $this->Files->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $file = $this->Files->patchEntity($file, $this->request->getData());
            if ($this->Files->save($file)) {
                $this->Flash->success(__('The file has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The file could not be saved. Please, try again.'));
        }
        $resources = $this->Files->Resources->find('list', ['limit' => 200])->all();
        $this->set(compact('file', 'resources'));
    }

    /**
     * Delete method
     *
     * @param string|null $id File id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $file = $this->Files->get($id);

        //Suppression du fichier sur le serveur
        $fileToDeletePath = WWW_ROOT.'ressourcesfiles'.DS.$file->file_path;
        if(file_exists($fileToDeletePath))
        {
            unlink($fileToDeletePath);
        }

        if ($this->Files->delete($file)) {
            $this->Flash->success(__('The file has been deleted.'));
        } else {
            $this->Flash->error(__('The file could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }

    public function download($id = null)
    {
        $file = $this->Files->get($id);
     
        return $this->response->withFile($file->getFilePath(),['download' => true, 'name' => $file->name]);

    }


}
