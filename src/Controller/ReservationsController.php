<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\I18n\FrozenTime;

use Cake\Log\Log;

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
            'order' => ['Reservations.is_back' => 'asc']
        ];
        $reservations = $this->paginate($this->Reservations);

        //Authorisation. Trouver une meilleure pratique
        if($this->Authentication->getIdentity()->get('admin'))
            $this->Authorization->skipAuthorization();

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

        //authorization
        $this->Authorization->authorize($reservation);


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

         //authorization
        $this->Authorization->authorize($reservation);


        if ($this->request->is('post')) {

          
            $reservation = $this->Reservations->patchEntity($reservation, $this->request->getData());
            //Ajout de l'utilisateur connecté à la réservation
            $user = $this->Reservations->Users->get($this->Authentication->getIdentity()->get('id'));
            $reservation->set('user',$user);
            $reservation->set('user_id',$user->id);

            $resource = $this->Reservations->Resources->get($this->request->getData('resource_id'),['contain' => 'Reservations']);


            $reservation->set('resource', $resource);

                 

                        if ($this->Reservations->save($reservation)) {

                            $this->Flash->success(__('La reservation pour la ressource '.$resource->name.' du '.$reservation->start_date.' au '.$reservation->end_date.' a bien été enregistrée'));
                            return $this->redirect(['action' => 'add',$this->request->getData('resource_id')]);
                        }
                        $this->Flash->error(__("La réservation n'a pas pu être créée."));
                    
        }



        $resources = $this->Reservations->Resources->find('list', ['groupField' => 'domain_name'])->contain('Domains')->contain('Reservations')->all()->toArray();



        //Replace by the actual logged user
        $users = $this->Reservations->Users->find('list', ['keyField' => 'id', 'valueField' => 'username', 'limit' => 200])->all();

        $this->set(compact('reservation', 'resources', 'users', 'selected_resource_id'));
    }


     /**
     * Add for a specific user method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function addForUser($selected_resource_id = null)
    {
        $reservation = $this->Reservations->newEmptyEntity();

         //authorization
        $this->Authorization->authorize($reservation);


        if ($this->request->is('post')) {

                  
                $reservation = $this->Reservations->patchEntity($reservation, $this->request->getData());
                $resource = $this->Reservations->Resources->get($this->request->getData('resource_id'),['contain' => 'Reservations']);
                $reservation->set('resource', $resource);

                        if ($this->Reservations->save($reservation)) {

                            $this->Flash->success(__('La reservation pour la ressource '.$resource->name.' du '.$reservation->start_date.' au '.$reservation->end_date.' a bien été enregistrée'));
                            return $this->redirect(['action' => 'addForUser',$this->request->getData('resource_id')]);
                        }
                        $this->Flash->error(__("La réservation n'a pas pu être créée."));
              
        }



        $resources = $this->Reservations->Resources->find('list', ['groupField' => 'domain_name'])->where(['archive'=>false])->contain('Domains')->contain('Reservations')->all()->toArray();


        $users = $this->Reservations->Users->find('list', ['keyField' => 'id', 'valueField' => 'username', 'limit' => 200])->all();

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

         //authorization
        $this->Authorization->authorize($reservation);


        if ($this->request->is(['patch', 'post', 'put'])) {
            $reservation = $this->Reservations->patchEntity($reservation, $this->request->getData());
            if ($this->Reservations->save($reservation)) {
                $this->Flash->success(__('La réservation a été modifiée'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__("La réservation n'a pas pu être modifiée."));
        }
        $resources = $this->Reservations->Resources->find('list', ['limit' => 200])->all();
        $users = $this->Reservations->Users->find('list', ['keyField' => 'id', 'valueField' => 'username', 'limit' => 200])->all();
        $this->set(compact('reservation', 'resources', 'users'));
    }

    public function editForUser($id = null)
    {
        $reservation = $this->Reservations->get($id, [
            'contain' => [],
        ]);
        
         //authorization
        $this->Authorization->authorize($reservation);

            $oldStartDate = $reservation->start_date;
            $oldEndDate = $reservation->end_date;

            Log::info('OLD DATE ' . $oldEndDate);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $reservation = $this->Reservations->patchEntity($reservation, $this->request->getData());
            $resource = $this->Reservations->Resources->get($this->request->getData('resource_id'),['contain' => 'Reservations']);
            $reservation->set('resource', $resource);

                        if ($this->Reservations->save($reservation)) {
                            $this->Flash->success(__('La réservation a été modifiée'));

                            return $this->redirect(['action' => 'index']);
                        }
                        else
                            $this->Flash->error(__("La réservation n'a pas pu être modifiée."));

        }
        $resources = $this->Reservations->Resources->find('list', ['limit' => 200])->all();
        $users = $this->Reservations->Users->find('list', ['keyField' => 'id', 'valueField' => 'username', 'limit' => 200])->all();

        // $reservation->set('start_date',$oldStartDate);
        // $reservation->set('end_date',$oldEndDate);


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

         //authorization
        $this->Authorization->authorize($reservation);


        if ($this->Reservations->delete($reservation)) {
            $this->Flash->success(__('La réservation a été supprimée'));
        } else {
            $this->Flash->error(__("Erreur lors de la suppression de la réservation."));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function setBack($id = null)
    {
        $this->request->allowMethod(['post', 'put', 'patch']);
        
        $reservation = $this->Reservations->get($id, [
            'contain' => ['Resources','Users']
        ]);
        
        //Authorization
        $this->Authorization->authorize($reservation);

        $reservation->set('is_back',true);
        $today = FrozenTime::now();

        $reservation->set('back_date', $today->i18nFormat('yyyy-MM-dd'));

        if ($this->Reservations->save($reservation)) {
            $this->Flash->success(__('la reservation pour ' . $reservation->resource->name . ' du ' . $reservation->start_date . ' au ' . $reservation->end_date . ' par ' . $reservation->user->username . ' a été marquée comme rendue le ' . $today ));
        } else {
            $this->Flash->error(__('Erreur lors de la tentative de définir la reservation comme rendue'));
        }

        return $this->redirect($this->referer());
    }

    public function unSetBack($id = null)
    {
        $this->request->allowMethod(['post', 'put', 'patch']);

        $reservation = $this->Reservations->get($id, [
            'contain' => ['Resources','Users']
        ]);
        
        //Authorization
        $this->Authorization->authorize($reservation);


        $reservation->set('is_back',false);
        $reservation->set('back_date', null);

        if ($this->Reservations->save($reservation)) {
            $this->Flash->success(__('la reservation pour ' . $reservation->resource->name . ' du ' . $reservation->start_date . ' au ' . $reservation->end_date . ' par ' . $reservation->user->username . ' a été marquée comme non rendue' ));
        } else {
            $this->Flash->error(__('Erreur lors de la tentative de définir la reservation comme non rendue'));
        }

        return $this->redirect($this->referer());
    }

}
