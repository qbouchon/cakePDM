<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * ClosingDates Controller
 *
 * @property \App\Model\Table\ClosingDatesTable $ClosingDates
 * @method \App\Model\Entity\ClosingDate[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ClosingDatesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        
        if($this->Authentication->getIdentity()->get('admin'))
            $this->Authorization->skipAuthorization();


        $closingDates = $this->paginate($this->ClosingDates);

        $this->set(compact('closingDates'));
    }

    /**
     * View method
     *
     * @param string|null $id Closing Date id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {   

        
        if($this->Authentication->getIdentity()->get('admin'))
            $this->Authorization->skipAuthorization();


        $closingDate = $this->ClosingDates->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('closingDate'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        
        if($this->Authentication->getIdentity()->get('admin'))
            $this->Authorization->skipAuthorization();


        $closingDate = $this->ClosingDates->newEmptyEntity();
        if ($this->request->is('post')) {
            $closingDate = $this->ClosingDates->patchEntity($closingDate, $this->request->getData());
            if ($this->ClosingDates->save($closingDate)) {
                $this->Flash->success(__('The closing date has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The closing date could not be saved. Please, try again.'));
        }
        $this->set(compact('closingDate'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Closing Date id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        
        if($this->Authentication->getIdentity()->get('admin'))
            $this->Authorization->skipAuthorization();

        $closingDate = $this->ClosingDates->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $closingDate = $this->ClosingDates->patchEntity($closingDate, $this->request->getData());
            if ($this->ClosingDates->save($closingDate)) {
                $this->Flash->success(__('The closing date has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The closing date could not be saved. Please, try again.'));
        }
        $this->set(compact('closingDate'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Closing Date id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {

        if($this->Authentication->getIdentity()->get('admin'))
            $this->Authorization->skipAuthorization();

        $this->request->allowMethod(['post', 'delete']);
        $closingDate = $this->ClosingDates->get($id);
        if ($this->ClosingDates->delete($closingDate)) {
            $this->Flash->success(__('The closing date has been deleted.'));
        } else {
            $this->Flash->error(__('The closing date could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
