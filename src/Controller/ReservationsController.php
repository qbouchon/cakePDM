<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Reservations Controller
 *
 * @property \App\Model\Table\ReservationsTable $Reservations
 * @method \App\Model\Entity\Reservation[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ReservationsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Resources', 'Users'],
        ];
        $reservations = $this->paginate($this->Reservations);

        $this->set(compact('reservations'));
    }

    /**
     * View method
     *
     * @param string|null $id Reservation id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $reservation = $this->Reservations->get($id, [
            'contain' => ['Resources', 'Users'],
        ]);

        $this->set(compact('reservation'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add($selected_resource_id = null)
    {
        $reservation = $this->Reservations->newEmptyEntity();
        if ($this->request->is('post')) {



            //$reservation = $this->Reservations->patchEntity($reservation, $this->request->getData());


            // if( $this->request->getData('resource_id'))
            //         $resource->set('resource', $this->getTableLocator()->get('Resource')->get($this->request->getData('resource_id')));
            // if( $this->request->getData('domain_id'))
            //         $resource->set('user', $this->getTableLocator()->get('Users')->get($this->request->getData('user_id')));
            
            $reservation->set('resource_id', $this->request->getData('resource_id'));
            $reservation->set('user_id', $this->request->getData('user_id'));

            $reservation->set('start_date', $this->request->getData('name'));
            $reservation->set('end_date', $this->request->getData('name'));

            
        // //     echo 'data '.$d['start_date'];
        // // echo 'start '.$reservation->start_date;
        // // echo 'end '.$reservation->end_date;
        // // echo 'back '.$reservation->is_back;
        // // echo 'rid '.$reservation->resource_id;
        // // echo 'uid '.$reservation->user_id;
        // // echo 'r '.$reservation->resource;
        // //  echo 'u '.$reservation->user;

        //  die("ok");


            if ($this->Reservations->save($reservation)) {
                $this->Flash->success(__('The reservation has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The reservation could not be saved. Please, try again.'));
        }



        $resources = $this->Reservations->Resources->find('list', ['groupField' => 'domain_name'])->contain('Domains')->all()->toArray();



        //Replace by the actual logged user
        $users = $this->Reservations->Users->find('list', ['keyField' => 'id', 'valueField' => 'login', 'limit' => 200])->all();

        $this->set(compact('reservation', 'resources', 'users', 'selected_resource_id'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Reservation id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $reservation = $this->Reservations->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $reservation = $this->Reservations->patchEntity($reservation, $this->request->getData());
            if ($this->Reservations->save($reservation)) {
                $this->Flash->success(__('The reservation has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The reservation could not be saved. Please, try again.'));
        }
        $resources = $this->Reservations->Resources->find('list', ['limit' => 200])->all();
        $users = $this->Reservations->Users->find('list', ['limit' => 200])->all();
        $this->set(compact('reservation', 'resources', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Reservation id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $reservation = $this->Reservations->get($id);
        if ($this->Reservations->delete($reservation)) {
            $this->Flash->success(__('The reservation has been deleted.'));
        } else {
            $this->Flash->error(__('The reservation could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
