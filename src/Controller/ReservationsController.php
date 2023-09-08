<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\I18n\FrozenTime;
use Cake\I18n\FrozenDate;
use Cake\ORM\TableRegistry;

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
            'order' => ['Reservations.is_back' => 'asc', 'Reservations.start_date' => 'desc']
        ];
        $reservations = $this->paginate($this->Reservations);

        //Authorisation. Trouver une meilleure pratique
        if($this->Authentication->getIdentity()->get('admin'))
            $this->Authorization->skipAuthorization();

        $this->set(compact('reservations'));
    }

     public function indexUser()
    {

        $user = $this->Reservations->Users->get($this->Authentication->getIdentity()->get('id'));

        $this->paginate = [
            'contain' => ['Resources', 'Users'],
            'order' => ['Reservations.is_back' => 'asc', 'Reservations.start_date' => 'desc'],
            'conditions' => ['Reservations.user_id' => $user->id, 'Reservations.is_back' => false]
        ];
        $reservations = $this->paginate($this->Reservations);

        //authorization
        $this->Authorization->skipAuthorization();

        $this->set(compact('reservations'));
    }


     public function upcomingReservations()
    {
        // $this->paginate = [
        //     'contain' => ['Resources', 'Users'],
        //     'order' => ['Reservations.is_back' => 'asc']
        // ];
        // $reservations = $this->paginate($this->Reservations);

         //Authorisation. Trouver une meilleure pratique
         if($this->Authentication->getIdentity()->get('admin'))
             $this->Authorization->skipAuthorization();

        // $this->set(compact('reservations'));
    }

    /**
     * View method
     *
     * @param string|null $id Reservation id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    // public function view($id = null)
    // {
    //     $reservation = $this->Reservations->get($id, [
    //         'contain' => ['Resources', 'Users'],
    //     ]);

    //     //authorization
    //     $this->Authorization->authorize($reservation);


    //     $this->set(compact('reservation'));
    // }

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
                            return $this->redirect(['action' => 'indexUser']);
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
                            // return $this->redirect(['action' => 'addForUser',$this->request->getData('resource_id')]);
                            return $this->redirect(['action' => 'index']);
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

                return $this->redirect($this->referer());
            }
            $this->Flash->error(__("La réservation n'a pas pu être modifiée."));
        }
        $resources = $this->Reservations->Resources->find('list', ['limit' => 200])->all();

        $this->set(compact('reservation', 'resources'));
    }

    public function editForUser($id = null)
    {
        $reservation = $this->Reservations->get($id, [
            'contain' => [],
        ]);
        
         //authorization
        $this->Authorization->authorize($reservation);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $reservation = $this->Reservations->patchEntity($reservation, $this->request->getData());
            $resource = $this->Reservations->Resources->get($this->request->getData('resource_id'),['contain' => 'Reservations']);
            $reservation->set('resource', $resource);

                        if ($this->Reservations->save($reservation)) {
                            $this->Flash->success(__('La réservation a été modifiée'));

                            return $this->redirect($this->referer());
                        }
                        else
                            $this->Flash->error(__("La réservation n'a pas pu être modifiée."));

        }
        $resources = $this->Reservations->Resources->find('list', ['limit' => 200])->all();
        $users = $this->Reservations->Users->find('list', ['keyField' => 'id', 'valueField' => 'username', 'limit' => 200])->all();

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

        return $this->redirect($this->referer());
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

    public function getWeekReservationsBetween($date1 = null, $date2 = null)
    {


        //Authorisation. Trouver une meilleure pratique
        if($this->Authentication->getIdentity()->get('admin'))
            $this->Authorization->skipAuthorization();

        if ($date1 && $date2) {
        $reservations = $this->Reservations->find()
            ->where([
                'start_date <=' => $date2,
                'end_date >=' => $date1
            ])
            ->contain('Resources') // Chargement des ressources associées
            ->all();

        $groupedReservations = [];
        
        foreach ($reservations as $reservation) {
            $resourceId = $reservation->resource_id;
            if (!isset($groupedReservations[$resourceId])) {
                $groupedReservations[$resourceId] = [
                    'resource' => $reservation->resource, // Ressource associée
                    'reservations' => [] // Tableau de réservations pour cette ressource
                ];
            }
            $groupedReservations[$resourceId]['reservations'][] = $reservation;
        }

        // Convertir les données en format JSON et les envoyer en réponse
        $this->autoRender = false;
        $this->response = $this->response->withType('application/json')
            ->withStringBody(json_encode($groupedReservations));

        return $this->response;
        }

    }

    public function getMonthReservationsBetween($date1 = null, $date2 = null)
    {


        //Authorisation. Trouver une meilleure pratique
        if($this->Authentication->getIdentity()->get('admin'))
            $this->Authorization->skipAuthorization();

        if ($date1 && $date2) {
            $reservations = $this->Reservations->find()
                ->where([
                    'start_date <=' => $date2,
                    'end_date >=' => $date1
                ])
                ->contain('Resources') // Chargement des ressources associées
                ->contain('Users')
                ->all()
                ->toArray();


            // Convertir les données en format JSON et les envoyer en réponse
            $this->autoRender = false;
            $this->response = $this->response->withType('application/json')
                ->withStringBody(json_encode($reservations));

            return $this->response;
        }

    }

     public function getReservationsBetween()
    {

        //Authorisation. Trouver une meilleure pratique
        if($this->Authentication->getIdentity()->get('admin'))
            $this->Authorization->skipAuthorization();


        $start = $this->request->getQuery('start');
        $end = $this->request->getQuery('end');



        if ($start && $end) {


                        $reservations = $this->Reservations->find()
                            ->where([
                                'start_date <=' => $end,
                                'end_date >=' => $start
                            ])
                            ->contain('Resources') 
                            ->contain('Users')
                            ->all()
                            ->toArray();

                        //Création des events
                        $events = [];
                        foreach($reservations as $reservation)
                        {
                            $endDate = new FrozenDate($reservation->end_date);
                            $formattedStartDate = $reservation->start_date->format('d/m/Y');
                            $formattedEndDate = $reservation->end_date->format('d/m/Y');

                            $event = [

                                 'id' => $reservation->id,
                                 'title'  => $reservation->resource->name,
                                 'start'  => $reservation->start_date,
                                 'end'  => $endDate->modify('+1 day'), //On ajoute un jour par soucis d'affichage par fullCalendar qui affiche un jour de moins.
                                 'allDay'  => true,
                                 'overlap'  => false,
                                 'color'  => $reservation->resource->color,
                                 'isBack' => $reservation->is_back,
                                 'picture' => $reservation->resource->picture_path,
                                 'tooltip' => '<div class=""><b>Réservation</b></div>'.$reservation->resource->name.'<br> Du  <b>'.$formattedStartDate.'</b> au <b>'.$formattedEndDate.'</b> par : <b>'.$reservation->user->username.'</b>' 


                            ];
                            $events[] = $event;
                        }


                        //Récupération des dates de fermeture et création de background events
                       $closingDatesTable = TableRegistry::getTableLocator()->get('ClosingDates');
                       $closingDates = $closingDatesTable->find()
                        ->where([
                                'start_date >=' => FrozenDate::now()  //Je décide de n'afficher que les jours fermés futurs                     
                        ])
                        ->toArray();


                        foreach($closingDates as $closingDate)
                        {
                            $event = [

                                'id' => $closingDate->id,
                                'title' => $closingDate->name,
                                'start' => $closingDate->start_date,
                                'end' => $closingDate->end_date,
                                'display' => 'background',
                                'tooltip' => '<div class=""><b>Fermeture du CREST : </b></div>'.$closingDate->name,
                                'type' => 'backgroundEvent',
                                'color' => '#bf7a77'

                            ];

                            $events[] = $event;
                        }



                        // Convertir les données en format JSON et les envoyer en réponse
                        $this->autoRender = false;
                        $this->response = $this->response->withType('application/json')
                            ->withStringBody(json_encode($events));

                        return $this->response;
        }
        else
        {
           $this->Flash->error(__('Erreur dans la récupération des réservations'));
           return $this->redirect(['action'=>'upcomingReservations']);
        }

    }

}
