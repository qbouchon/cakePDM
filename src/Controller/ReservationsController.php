<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\I18n\FrozenDate;
use Cake\ORM\TableRegistry;
use Cake\Core\Configure;
use App\Mailer\ReservationMailer;
use Cake\Log\Log;
use Cake\Http\Exception\NotFoundException;

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
       
        $conditions = [];
        $search = $this->request->getQuery('searchField');

        if($search)
        {
             $conditions['OR'] = [
                        
                        'CONVERT(Reservations.id, CHAR) LIKE' => '%' . $search . '%',
                        'Resources.name LIKE' => '%' . $search . '%',
                        'Users.firstname LIKE' => '%' . $search . '%',
                        'Users.lastname LIKE' => '%' . $search . '%',
                        'Users.username LIKE' => '%' . $search . '%',
                        'DATE_FORMAT(Reservations.start_date, "%d/%m") LIKE'  => '%' . $search . '%',
                        'DATE_FORMAT(Reservations.end_date, "%d/%m") LIKE'  => '%' . $search . '%',
                        'Reservations.is_back = 1 AND "oui" LIKE' => '%' . $search . '%', 
                        'Reservations.is_back = 0 AND "non" LIKE' => '%' . $search . '%',
                        'DATE_FORMAT(Reservations.back_date, "%d/%m") LIKE' => '%' . $search . '%',
                ];
        }
        if($this->request->getQuery('viewBack') == true){
            
            $this->paginate = [
                'contain' => ['Resources', 'Users'],
                'conditions' => $conditions,
                'maxLimit' => 12,
                'order' => ['Reservations.id' => 'desc']

            ];
        }
        else{

            $conditions = array_merge(['Reservations.is_back' => false], $conditions);

            $this->paginate = [
                'contain' => ['Resources', 'Users'],
                'conditions' => $conditions,
                'maxLimit' => 12,
                'order' => ['Reservations.id' => 'desc']
            
            ];
        }
      
        try{

            $reservations = $this->paginate($this->Reservations);
        }
        catch (NotFoundException $e){  

           //on redirige sur la dernière page du paginator (il y a peut-être plus simple)
           $lastpage = $this->request->getAttribute('paging');
           $page = $lastpage['Reservations']['pageCount'];

           $this->request = $this->request->withQueryParams(['page' =>$page ]);
           $reservations = $this->paginate($this->Reservations);
        }
       


        //Authorisation. Trouver une meilleure pratique
        if($this->Authentication->getIdentity()->get('admin'))
            $this->Authorization->skipAuthorization();

        //Mail Text
        $default_configuration = Configure::read('default_configuration');

        $configurationTable = TableRegistry::getTableLocator()->get('Configuration');

        $configuration = $configurationTable->find()
                ->where(['name' => $default_configuration])->first();
        

        $this->set(compact('reservations','configuration'));
    }

     public function indexUser()
    {

        $user = $this->Reservations->Users->get($this->Authentication->getIdentity()->get('id'));
        $conditions = [];
        $search = $this->request->getQuery('searchField');

        if($search)
        {
             $conditions['OR'] = [
                        
                        'CONVERT(Reservations.id, CHAR) LIKE' => '%' . $search . '%',
                        'Resources.name LIKE' => '%' . $search . '%',
                        'Users.firstname LIKE' => '%' . $search . '%',
                        'Users.lastname LIKE' => '%' . $search . '%',
                        'Users.username LIKE' => '%' . $search . '%',
                        'DATE_FORMAT(Reservations.start_date, "%d/%m") LIKE'  => '%' . $search . '%',
                        'DATE_FORMAT(Reservations.end_date, "%d/%m") LIKE'  => '%' . $search . '%',
                        'Reservations.is_back = 1 AND "oui" LIKE' => '%' . $search . '%', 
                        'Reservations.is_back = 0 AND "non" LIKE' => '%' . $search . '%',
                        'DATE_FORMAT(Reservations.back_date, "%d/%m") LIKE' => '%' . $search . '%',
                ];
        }

        $conditions = array_merge(['Reservations.user_id' => $user->id], $conditions);
        
        if($this->request->getQuery('viewBack') == true){

            
            $this->paginate = [
                'contain' => ['Resources', 'Users'],
                'conditions' => $conditions,
                'maxLimit' => 10,
                'order' => ['Reservations.id' => 'desc']
            ];

        }
        else{

            $conditions = array_merge(['Reservations.is_back' => false], $conditions);

            $this->paginate = [
                'contain' => ['Resources', 'Users'],
                'conditions' => $conditions,
                'maxLimit' => 10,
                'order' => ['Reservations.id' => 'desc']
            
            ];
        }


        try{
            
            $reservations = $this->paginate($this->Reservations);
        }
        catch (NotFoundException $e)
        {
           //on redirige sur la dernière page du paginator (il y a peut-être plus simple)
           $lastpage = $this->request->getAttribute('paging');
           $page = $lastpage['Reservations']['pageCount'];

           $this->request = $this->request->withQueryParams(['page' =>$page ]);
           $reservations = $this->paginate($this->Reservations);
        }


        //authorization
        $this->Authorization->skipAuthorization();

        $this->set(compact('reservations'));
    }


   
    public function stats()
    {
         if($this->Authentication->getIdentity()->get('admin'))
             $this->Authorization->skipAuthorization();
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

                //--------------------------------------Envoi des mails  
            

                $default_configuration = Configure::read('default_configuration');
                $configurationTable = TableRegistry::getTableLocator()->get('Configuration');
                $configuration = $configurationTable->find()
                        ->where(['name' => $default_configuration])->first();
                $mailer = new ReservationMailer();
                $mailer->setTransport($configuration->createTransport());

                if($configuration->send_mail_resa_admin){

                    $success = false;

                    try{                                
                                $mailer->sendMailResaAdmin($reservation); 
                                $success = true;
                        }
                        catch(\Exception $e){

                            if($this->Authentication->getIdentity()->get('admin'))
                                $this->Flash->error(__('Erreur lors de la tentative d\'envoi du mail de confirmation')); 
                        }
                        catch(\Error $e){ 

                            if($this->Authentication->getIdentity()->get('admin'))
                                $this->Flash->error(__('Erreur lors de la tentative d\'envoi du mail de confirmation'));  
                        }

                        if($this->Authentication->getIdentity()->get('admin') && $success)
                            $this->Flash->success(__('Un mail de confirmation a été envoyé aux admins'));   
                }     

                if($configuration->send_mail_resa_user){

                    $success = false;

                    try{
                        $mailer->sendMailResaUser($reservation); 
                        $success = true;
                    }
                    catch(\Exception $e){

                        if($this->Authentication->getIdentity()->get('admin'))
                            $this->Flash->error(__('Erreur lors de la tentative d\'envoi du mail de confirmation à l\'utilisateur'.$e->getMessage())); 
                    }
                    catch(\Error $e){ 

                        if($this->Authentication->getIdentity()->get('admin'))
                            $this->Flash->error(__('Erreur lors de la tentative d\'envoi du mail de confirmation à l\'utilisateur'.$e->getMessage()));  
                    }

                    if($this->Authentication->getIdentity()->get('admin') && $success)
                        $this->Flash->success(__('Un mail de confirmation vous a été envoyé'));   

                }
                //---------------------------------fin envoi mails

                return $this->redirect(['action' => 'indexUser']);
            }

            $this->Flash->error(__("La réservation n'a pas pu être créée."));
                    
        }



        $resources = $this->Reservations->Resources->find('list', ['groupField' => 'domain_name'])->contain('Domains')->contain('Reservations')->all()->toArray();

        //Replace by the actual logged user
        //$users = $this->Reservations->Users->find('list', ['keyField' => 'id', 'valueField' => 'username', 'limit' => 200])->all();

        $this->set(compact('reservation', 'resources', 'selected_resource_id'));
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

                $user = $this->Reservations->Users->get($this->request->getData('user_id'));
                $reservation->set('user',$user);

                if ($this->Reservations->save($reservation)) {

                    $this->Flash->success(__('La reservation pour la ressource '.$resource->name.' du '.$reservation->start_date.' au '.$reservation->end_date.' a bien été enregistrée'));

                    //--------------------------------------Envoi des mails  

                    $default_configuration = Configure::read('default_configuration');
                    $configurationTable = TableRegistry::getTableLocator()->get('Configuration');
                    $configuration = $configurationTable->find()
                            ->where(['name' => $default_configuration])->first();
                    $mailer = new ReservationMailer();
                    $mailer->setTransport($configuration->createTransport());

                    if($configuration->send_mail_resa_admin){

                         $success = false;

                        try{
                                $mailer->sendMailResaAdmin($reservation); 
                                $success = true;
                        }
                        catch(\Exception $e){

                            if($this->Authentication->getIdentity()->get('admin'))
                                $this->Flash->error(__('Erreur lors de la tentative d\'envoi du mail de confirmation'.$e->getMessage())); 
                        }
                        catch(\Error $e){ 

                            if($this->Authentication->getIdentity()->get('admin'))
                                $this->Flash->error(__('Erreur lors de la tentative d\'envoi du mail de confirmation'.$e->getMessage()));  
                        }

                        if($this->Authentication->getIdentity()->get('admin') && $success)
                            $this->Flash->success(__('Un mail de confirmation a été envoyé aux admins'));   
                    }     

                    if($configuration->send_mail_resa_user)
                    {
                        $success = false;

                        try{
                                $mailer->sendMailResaUser($reservation); 
                                $success = true;
                        }
                        catch(\Exception $e){

                                $this->Flash->error(__('Erreur lors de la tentative d\'envoi du mail de confirmation à l\'utilisateur')); 
                        }
                        catch(\Error $e){ 

                                $this->Flash->error(__('Erreur lors de la tentative d\'envoi du mail de confirmation à l\'utilisateur'));  
                        }

                        if($success)
                            $this->Flash->success(__('Un mail de confirmation a été envoyé à ' . $reservation->user->firstname . ' ' . $reservation->user->lastname));            
                    }

                    //Ajouter un mail au admins ? 
                    //---------------------------------fin envoi mails  

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

            $resource = $this->Reservations->Resources->get($this->request->getData('resource_id'),['contain' => 'Reservations']);
            $reservation->set('resource', $resource);

            $user = $this->Reservations->Users->get($this->Authentication->getIdentity()->get('id'));
            $reservation->set('user',$user);
            $reservation->set('user_id',$user->id);

            if ($this->Reservations->save($reservation)) {

                $this->Flash->success(__('La réservation a été modifiée'));

                    //--------------------------------------Envoi des mails  
                    $default_configuration = Configure::read('default_configuration');
                    $configurationTable = TableRegistry::getTableLocator()->get('Configuration');
                    $configuration = $configurationTable->find()
                            ->where(['name' => $default_configuration])->first();
                    $mailer = new ReservationMailer();
                    $mailer->setTransport($configuration->createTransport());
                    
                    if($configuration->send_mail_edit_resa_admin)
                    {
                        $success = false;

                        try{
                                $mailer->sendMailEditResaAdmin($reservation); 
                                $success = true;
                        }
                        catch(\Exception $e){

                            if($this->Authentication->getIdentity()->get('admin'))
                                $this->Flash->error(__('Erreur lors de la tentative d\'envoi du mail de confirmation aux admins')); 
                        }
                        catch(\Error $e){ 

                            if($this->Authentication->getIdentity()->get('admin'))
                                $this->Flash->error(__('Erreur lors de la tentative d\'envoi du mail de confirmation aux admins'));  
                        }

                        if($this->Authentication->getIdentity()->get('admin') && $success)
                            $this->Flash->success(__('Un mail de confirmation a été envoyé aux admins'));            
                    }

                    if($configuration->send_mail_edit_resa_user)
                    {
                        $success = false;

                        try{
                                $mailer->sendMailEditResaUser($reservation); 
                                $success = true;
                        }
                        catch(\Exception $e){

                            if($this->Authentication->getIdentity()->get('admin'))
                                $this->Flash->error(__('Erreur lors de la tentative d\'envoi du mail de confirmation')); 
                        }
                        catch(\Error $e){ 

                            if($this->Authentication->getIdentity()->get('admin'))
                                $this->Flash->error(__('Erreur lors de la tentative d\'envoi du mail de confirmation'));  
                        }

                        if($this->Authentication->getIdentity()->get('admin') && $success)
                            $this->Flash->success(__('Un mail de confirmation vous a été envoyé'));
                    }          
                    
                //---------------------------------fin envoi mails  

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
            'contain' => ['Users'],
        ]);
        
        //authorization
        $this->Authorization->authorize($reservation);

        if ($this->request->is(['patch', 'post', 'put'])) {

            $reservation = $this->Reservations->patchEntity($reservation, $this->request->getData());
            $resource = $this->Reservations->Resources->get($this->request->getData('resource_id'),['contain' => 'Reservations']);
            $reservation->set('resource', $resource);

            // $user = $this->Reservations->Users->get($this->request->getData('user_id'));
            // $reservation->set('user',$user);

                        if ($this->Reservations->save($reservation)) {

                            $this->Flash->success(__('La réservation a été modifiée'));

                            //--------------------------------------Envoi des mails  
                            $default_configuration = Configure::read('default_configuration');
                            $configurationTable = TableRegistry::getTableLocator()->get('Configuration');
                            $configuration = $configurationTable->find()
                                    ->where(['name' => $default_configuration])->first();
                            $mailer = new ReservationMailer();
                            $mailer->setTransport($configuration->createTransport());
                           
                            if($configuration->send_mail_edit_resa_user)
                            {

                                $success = false;

                                try{
                                        $mailer->sendMailEditResaUser($reservation); 
                                        $success = true;
                                }
                                catch(\Exception $e){

                                        $this->Flash->error(__('Erreur lors de la tentative d\'envoi du mail de confirmation à l\'utilisateur')); 
                                }
                                catch(\Error $e){ 

                                        $this->Flash->error(__('Erreur lors de la tentative d\'envoi du mail de confirmation à l\'utilisateur'));  
                                }

                                if($success)
                                    $this->Flash->success(__('Un mail de confirmation a été envoyé à ' . $reservation->user->firstname . ' ' . $reservation->user->lastname));      
                              
                            }

                            if($configuration->send_mail_edit_resa_admin)
                            {

                                    $success = false;

                                    try{
                                            $mailer->sendMailEditResaAdmin($reservation); 
                                            $success = true;
                                    }
                                    catch(\Exception $e){

                                        $this->Flash->error(__('Erreur lors de la tentative d\'envoi du mail de confirmation aux admins')); 
                                    }
                                    catch(\Error $e){ 

                                        $this->Flash->error(__('Erreur lors de la tentative d\'envoi du mail de confirmation aux admins'));  
                                    }

                                    if($success)
                                        $this->Flash->success(__('Un mail de confirmation a été envoyé aux admins'));        
                            }
                           
                    
                            //---------------------------------fin envoi mails

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
        $reservation = $this->Reservations->get($id, ['contain' => ['Resources','Users']]);

         //authorization
        $this->Authorization->authorize($reservation);

        if ($this->Reservations->delete($reservation))
        {
            $this->Flash->success(__('La réservation a été supprimée'));

            //--------------------------------------Envoi des mails  
            $default_configuration = Configure::read('default_configuration');
            $configurationTable = TableRegistry::getTableLocator()->get('Configuration');
            $configuration = $configurationTable->find()
                    ->where(['name' => $default_configuration])->first();
            $mailer = new ReservationMailer();
            $mailer->setTransport($configuration->createTransport());

            if($configuration->send_mail_delete_resa_user)
            {
                $success = false;

                try{
                        $mailer->sendMailDeleteResaUser($reservation); 
                        $success = true;
                }
                catch(\Exception $e){

                    if($this->Authentication->getIdentity()->get('admin'))
                        $this->Flash->error(__('Erreur lors de la tentative d\'envoi du mail de confirmation')); 
                }
                catch(\Error $e){ 

                    if($this->Authentication->getIdentity()->get('admin'))
                        $this->Flash->error(__('Erreur lors de la tentative d\'envoi du mail de confirmation'));  
                }

                if($this->Authentication->getIdentity()->get('admin') && $success)
                    $this->Flash->success(__('Un mail de confirmation a été envoyé à ' . $reservation->user->firstname . ' ' . $reservation->user->lastname));               
            }

            if($configuration->send_mail_delete_resa_admin)
            {
                
                $success = false;

                try{
                        $mailer->sendMailDeleteResaAdmin($reservation);
                        $success = true;
                }
                catch(\Exception $e){

                    if($this->Authentication->getIdentity()->get('admin'))
                        $this->Flash->error(__('Erreur lors de la tentative d\'envoi du mail de confrmation aux admins')); 
                }
                catch(\Error $e){ 

                    if($this->Authentication->getIdentity()->get('admin'))
                        $this->Flash->error(__('Erreur lors de la tentative d\'envoi du mail de confrmation aux admins'));  
                }

                if($this->Authentication->getIdentity()->get('admin') && $success)
                    $this->Flash->success(__('Un mail de confirmation a été envoyé aux admins'));   
            }
           
            //---------------------------------fin envoi mails
        }
        else
            $this->Flash->error(__("Erreur lors de la suppression de la réservation."));
    
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
        $today = FrozenDate::now();

        $reservation->set('back_date', $today->i18nFormat('yyyy-MM-dd'));

        if ($this->Reservations->save($reservation)){

            $this->Flash->success(__('la reservation pour ' . $reservation->resource->name . ' du ' . $reservation->start_date . ' au ' . $reservation->end_date . ' par ' . $reservation->user->username . ' a été marquée comme rendue le ' . $today ));

            //--------------------------------------Envoi des mails  
            $default_configuration = Configure::read('default_configuration');
            $configurationTable = TableRegistry::getTableLocator()->get('Configuration');
            $configuration = $configurationTable->find()
                    ->where(['name' => $default_configuration])->first();
            $mailer = new ReservationMailer();
            $mailer->setTransport($configuration->createTransport());
       
            if($configuration->send_mail_back_resa_user)
            {
                $success = false;

                try{
                        $mailer->sendMailBackResaUser($reservation); 
                        $success = true;
                }
                catch(\Exception $e) {
                    $this->Flash->error(__('Erreur lors de la tentative d\'envoi du mail de confirmatio nà l\'utilisateur'));   
                }
                catch (\Error $e) {
                    $this->Flash->error(__('Erreur lors de la tentative d\'envoi de mail de confirmation à l\'utilisateur'));  
                }

                if($success)
                    $this->Flash->success(__('Un mail de confirmation a été envoyé à ' . $reservation->user->firstname . ' ' . $reservation->user->lastname));             
            }         
            //---------------------------------fin envoi mails
        }
        else 
            $this->Flash->error(__('Erreur lors de la tentative de définir la reservation comme rendue'));   

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

        if ($this->Reservations->save($reservation))
        {
            $this->Flash->success(__('la reservation pour ' . $reservation->resource->name . ' du ' . $reservation->start_date . ' au ' . $reservation->end_date . ' par ' . $reservation->user->username . ' a été marquée comme non rendue' ));

            //--------------------------------------Envoi des mails  
           

            $default_configuration = Configure::read('default_configuration');
            $configurationTable = TableRegistry::getTableLocator()->get('Configuration');
            $configuration = $configurationTable->find()
                    ->where(['name' => $default_configuration])->first();
            $mailer = new ReservationMailer();
            $mailer->setTransport($configuration->createTransport());
       
            if($configuration->send_mail_back_resa_user)
            {
                $success = false;

                try{
                        $mailer->sendMailBackResaUser($reservation); 
                        $success = true;
                }
                catch(\Exception $e) {
                    $this->Flash->error(__('Erreur lors de la tentative d\'envoi du mail de confirmatio nà l\'utilisateur'));   
                }
                catch (\Error $e) {
                    $this->Flash->error(__('Erreur lors de la tentative d\'envoi de mail de confirmation à l\'utilisateur'));  
                }

                if($success)
                    $this->Flash->success(__('Un mail de confirmation a été envoyé à ' . $reservation->user->firstname . ' ' . $reservation->user->lastname));             
            }         
            //---------------------------------fin envoi mails
        }
        else
            $this->Flash->error(__('Erreur lors de la tentative de définir la reservation comme non rendue'));

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
                    'end_date >=' => $start,
                    'is_back =' => false,  //On ne récupère que les réservations non rendues. suup cette ligne pour inclure les rendues
                ])
                ->contain('Resources') 
                ->contain('Users')
                ->all()
                ->toArray();

            //Création des events
            $events = [];
            foreach($reservations as $reservation)
            {
                $today = FrozenDate::now();
                $endDate = new FrozenDate($reservation->end_date);
                $startDate = new FrozenDate($reservation->start_date);
                $formattedStartDate = $reservation->start_date->format('d/m/Y');
                $formattedEndDate = $reservation->end_date->format('d/m/Y');
               

                if($endDate <= $today)
                {
                     $color = '#CD6161';
                     $tooltip = '<div class=""><b>Réservation n°'.$reservation->id.' (non rendue)</b></div>'.$reservation->resource->name.'<br> Du  <b>'.$formattedStartDate.'</b> au <b>'.$formattedEndDate.'</b> par : <b>'.$reservation->user->username.'</b>';
                }
                else
                {
                    if($startDate >= $today)
                    {
                        $color = '#3073b3';  //Changement de couleur ?                                 
                        $tooltip = '<div class=""><b>Réservation n°'.$reservation->id.'</b></div>'.$reservation->resource->name.'<br> Du  <b>'.$formattedStartDate.'</b> au <b>'.$formattedEndDate.'</b> par : <b>'.$reservation->user->username.'</b>';
                    }
                    else
                    {
                        $color = '#3073b3';                                   
                        $tooltip = '<div class=""><b>Réservation n°'.$reservation->id.' (en cours)</b></div>'.$reservation->resource->name.'<br> Du  <b>'.$formattedStartDate.'</b> au <b>'.$formattedEndDate.'</b> par : <b>'.$reservation->user->username.'</b>';
                    }
                        
                }

                $event = [

                     'id' => $reservation->id,
                     'title'  => $reservation->resource->name. ' - ' . $reservation->user->username,
                     'start'  => $reservation->start_date,
                     'end'  => $endDate->modify('+1 day'), //On ajoute un jour par soucis d'affichage par fullCalendar qui affiche un jour de moins.
                     'allDay'  => true,
                     'overlap'  => false,
                     'color'  => $color,
                     'isBack' => $reservation->is_back,
                     'picture' => $reservation->resource->picture_path,
                     'tooltip' => $tooltip
           
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
                    'color' => '#b52f2a'

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

     public function getUserReservationsBetween()
    {

        //Authorisation. Trouver une meilleure pratique
        $this->Authorization->skipAuthorization();

        $start = $this->request->getQuery('start');
        $end = $this->request->getQuery('end');
        $user = $this->Authentication->getIdentity();

        if ($start && $end && $user) {

            $reservations = $this->Reservations->find()
                ->where([
                    'start_date <=' => $end,
                    'end_date >=' => $start,
                    'is_back =' => false,  //On ne récupère que les réservations non rendues. suup cette ligne pour inclure les rendues
                    'user_id =' => $user->id,
                ])
                ->contain('Resources') 
                ->contain('Users')
                ->all()
                ->toArray();

            //Création des events
            $events = [];
            foreach($reservations as $reservation)
            {
                $today = FrozenDate::now();
                $endDate = new FrozenDate($reservation->end_date);
                $startDate = new FrozenDate($reservation->start_date);
                $formattedStartDate = $reservation->start_date->format('d/m/Y');
                $formattedEndDate = $reservation->end_date->format('d/m/Y');
               

                if($endDate <= $today)
                {
                     $color = '#CD6161';
                     $tooltip = '<div class=""><b>Réservation n°'.$reservation->id.' (non rendue)</b></div>'.$reservation->resource->name.'<br> Du  <b>'.$formattedStartDate.'</b> au <b>'.$formattedEndDate.'</b> par : <b>'.$reservation->user->username.'</b>';
                }
                else
                {
                    if($startDate >= $today)
                    {
                        $color = '#3073b3';  //Changement de couleur ?                                 
                        $tooltip = '<div class=""><b>Réservation n°'.$reservation->id.'</b></div>'.$reservation->resource->name.'<br> Du  <b>'.$formattedStartDate.'</b> au <b>'.$formattedEndDate.'</b>';
                    }
                    else
                    {
                        $color = '#3073b3';                                   
                        $tooltip = '<div class=""><b>Réservation n°'.$reservation->id.' (en cours)</b></div>'.$reservation->resource->name.'<br> Du  <b>'.$formattedStartDate.'</b> au <b>'.$formattedEndDate.'</b>';
                    }
                        
                }

                $event = [

                     'id' => $reservation->id,
                     'title'  => $reservation->resource->name,
                     'start'  => $reservation->start_date,
                     'end'  => $endDate->modify('+1 day'), //On ajoute un jour par soucis d'affichage par fullCalendar qui affiche un jour de moins.
                     'allDay'  => true,
                     'overlap'  => false,
                     'color'  => $color,
                     'isBack' => $reservation->is_back,
                     'picture' => $reservation->resource->picture_path,
                     'tooltip' => $tooltip


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
                    'color' => '#b52f2a'

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

    //Renvoie le nombre de réservations par ressource sous une forme exploitable par chart.js
    public function getResourcesStats($start = null, $end = null)
    {
        //Authorisation. Trouver une meilleure pratique
        if($this->Authentication->getIdentity()->get('admin'))
            $this->Authorization->skipAuthorization();

        $resources = $this->Reservations->Resources->find()->contain('Reservations');

        $labels = [];
        $values = [];
        foreach($resources as $resource)
        {
            $labels[] = $resource->name;

            $query = $this->Reservations->find()->where(['resource_id' => $resource->id]);

            if ($start != 0){
                $query->where(['start_date >=' => $start]);
            }

            if ($end != 0){   

                $query->where(['start_date <=' => $end]);
            }

            $count = $query->count();
            $values[] = $count;
        }

        $datas = [
            'labels' => $labels, 
            'datasets' => [
                            [
                                'label' => 'Nombre de réservations',
                                'data' => $values,
                                'borderWidth' => 1
                            ]
            ]
        ];


       // Convertir les données en format JSON et les envoyer en réponse
        $this->autoRender = false;
        $this->response = $this->response->withType('application/json')
        ->withStringBody(json_encode($datas));

        return $this->response;

    }

    public function reminderMail($reservation_id = null)
    {

        if($this->Authentication->getIdentity()->get('admin'))
            $this->Authorization->skipAuthorization();

        $reservation = $this->Reservations->get($reservation_id, [
            'contain' => ['Users','Resources'],
        ]);

        $mailText = $this->request->getData('mail');
        $mailObject = $this->request->getData('mailObject');
   
        if($reservation)
        {
            $success = false;
            try{

                $mailer = new ReservationMailer();
                $mailer->sendReminderMail($reservation,$mailText, $mailObject);
                $reservation->set('last_mail_date', FrozenDate::now());
                $success = true;
            }
            catch(\Exception $e) {
                 $this->Flash->error(__('Erreur lors de la tentative d\'envoi du mail de confirmatio nà l\'utilisateur'));   
            }
            catch (\Error $e) {
                $this->Flash->error(__('Erreur lors de la tentative d\'envoi de mail de confirmation à l\'utilisateur'));  
            }
            if($success)
            {
                $this->Flash->success("Un mail de relance a été envoyé à l'utilisateur ".$reservation->user->username);

                if(!$this->Reservations->save($reservation))
                    $this->Flash->error("Erreur lors de la mise à jour de la date d'envoi de mail de relance");
                

                $this->redirect($this->referer());
            }
            
        }
        else
            $this->Flash->error("Erreur");

    }

}
