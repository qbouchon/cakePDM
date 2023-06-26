<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Matos Controller
 *
 * @property \App\Model\Table\MatosTable $Matos
 * @method \App\Model\Entity\Mato[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class MatosController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'limit' => 5,
        ];

        $matos = $this->paginate($this->Matos);

        $this->set(compact('matos'));
    }

    /**
     * View method
     *
     * @param string|null $id Mato id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $mato = $this->Matos->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('mato'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $mato = $this->Matos->newEmptyEntity();
        if ($this->request->is('post')) {
            $mato = $this->Matos->patchEntity($mato, $this->request->getData());
            if ($this->Matos->save($mato)) {
                $this->Flash->success(__('The mato has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The mato could not be saved. Please, try again.'));
        }
        $this->set(compact('mato'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Mato id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $mato = $this->Matos->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $mato = $this->Matos->patchEntity($mato, $this->request->getData());
            if ($this->Matos->save($mato)) {
                $this->Flash->success(__('The mato has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The mato could not be saved. Please, try again.'));
        }
        $this->set(compact('mato'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Mato id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $mato = $this->Matos->get($id);
        if ($this->Matos->delete($mato)) {
            $this->Flash->success(__('The mato has been deleted.'));
        } else {
            $this->Flash->error(__('The mato could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
