<?php
declare(strict_types=1);

namespace App\Controller;
use Cake\Core\Configure;
use Cake\Utility\Security;

/**
 * Configuration Controller
 *
 * @property \App\Model\Table\ConfigurationTable $Configuration
 * @method \App\Model\Entity\Configuration[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ConfigurationController extends AppController
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

        $this->redirect(['action'=>'edit']);
    }

    /**
     * Edit method, configuration is defined in config/bootstrap.php (crest_default_config by default). For now it doesnt handle multiples configurations (à refactorer)
     *
     * @param string|null $id Configuration id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit()
    {

         //Authorisation. Trouver une meilleure pratique
        if($this->Authentication->getIdentity()->get('admin'))
            $this->Authorization->skipAuthorization();
        
        $default_configuration = Configure::read('default_configuration');
        $configuration = $this->Configuration->find()
                    ->where(['name' => $default_configuration])->first();


        if ($this->request->is(['patch', 'post', 'put'])) 
        {
           
            if(!$configuration->getErrors) 
            {
                $configuration->set('home_text',$this->request->getData('home_text'));

                //Gestion de la suppression de l'image
                if(!empty($this->request->getData('deletePicture')))
                {               
                    $configuration->deletePicture();
                }

                //gestion de l'upload de l'image
                $configuration->addPicture($this->request->getData('home_picture'));

                if ($this->Configuration->save($configuration)) 
                {
                    $this->Flash->success(__('The configuration has been saved.'));
                    return $this->redirect(['action' => 'edit']);
                }

                $this->Flash->error(__('The configuration could not be saved. Please, try again.'));
            }
        }

        $this->set(compact('configuration'));
    }

    public function editMails()
    {
        //Authorisation. Trouver une meilleure pratique
        if($this->Authentication->getIdentity()->get('admin'))
            $this->Authorization->skipAuthorization();

         $default_configuration = Configure::read('default_configuration');
         $configuration = $this->Configuration->find()
                     ->where(['name' => $default_configuration])->first();


         if ($this->request->is(['patch', 'post', 'put'])) 
         {
           
            if(!$configuration->getErrors) 
            {

                $configuration->set('reminder_mail_object',$this->request->getData('reminder_mail_object'));
                $configuration->set('reminder_mail_text',$this->request->getData('reminder_mail_text'));

                $configuration->set('send_mail_resa_admin',$this->request->getData('send_mail_resa_admin'));
                $configuration->set('send_mail_resa_admin_object',$this->request->getData('send_mail_resa_admin_object'));
                $configuration->set('send_mail_resa_admin_text',$this->request->getData('send_mail_resa_admin_text'));

                $configuration->set('send_mail_edit_resa_admin',$this->request->getData('send_mail_edit_resa_admin'));
                $configuration->set('send_mail_edit_resa_admin_object',$this->request->getData('send_mail_edit_resa_admin_object'));
                $configuration->set('send_mail_edit_resa_admin_text',$this->request->getData('send_mail_edit_resa_admin_text'));

                $configuration->set('send_mail_delete_resa_admin',$this->request->getData('send_mail_delete_resa_admin'));
                $configuration->set('send_mail_delete_resa_admin_object',$this->request->getData('send_mail_delete_resa_admin_object'));
                $configuration->set('send_mail_delete_resa_admin_text',$this->request->getData('send_mail_delete_resa_admin_text'));

                $configuration->set('send_mail_resa_user',$this->request->getData('send_mail_resa_user'));
                $configuration->set('send_mail_resa_user_object',$this->request->getData('send_mail_resa_user_object'));
                $configuration->set('send_mail_resa_user_text',$this->request->getData('send_mail_resa_user_text'));

                $configuration->set('send_mail_edit_resa_user',$this->request->getData('send_mail_edit_resa_user'));
                $configuration->set('send_mail_edit_resa_user_object',$this->request->getData('send_mail_edit_resa_user_object'));
                $configuration->set('send_mail_edit_resa_user_text',$this->request->getData('send_mail_edit_resa_user_text'));

                $configuration->set('send_mail_delete_resa_user',$this->request->getData('send_mail_delete_resa_user'));
                $configuration->set('send_mail_delete_resa_user_object',$this->request->getData('send_mail_delete_resa_user_object'));
                $configuration->set('send_mail_delete_resa_user_text',$this->request->getData('send_mail_delete_resa_user_text'));

                $configuration->set('send_mail_back_resa_user',$this->request->getData('send_mail_back_resa_user'));
                $configuration->set('send_mail_back_resa_user_object',$this->request->getData('send_mail_back_resa_user_object'));
                $configuration->set('send_mail_back_resa_user_text',$this->request->getData('send_mail_back_resa_user_text'));

                $configuration->set('mail_protocol',$this->request->getData('mail_protocol'));
                $configuration->set('mail_host',$this->request->getData('mail_host'));
                $configuration->set('mail_port',$this->request->getData('mail_port'));
                $configuration->set('mail_username',$this->request->getData('mail_username'));
                $configuration->set('mail_password',$this->request->getData('mail_password'));

                

                if ($this->Configuration->save($configuration)) 
                {
                    $this->Flash->success(__('la configuration a été sauvegardée'));

                    return $this->redirect($this->referer());
                }

                $this->Flash->error(__('Problème lors de la sauvegarde de la configuration'));
            }
        }

        $this->set(compact('configuration'));
    }

    public function editOpeningDays()
    {

         //Authorisation. Trouver une meilleure pratique
        if($this->Authentication->getIdentity()->get('admin'))
            $this->Authorization->skipAuthorization();
        
        $default_configuration = Configure::read('default_configuration');
        $configuration = $this->Configuration->find()
                    ->where(['name' => $default_configuration])->first();


        if ($this->request->is(['patch', 'post', 'put'])) 
        {
           
            if(!$configuration->getErrors) 
            {
                $configuration->set('open_monday', $this->request->getData('open_monday'))
                                ->set('start_hour_monday', $this->request->getData('start_hour_monday'))
                                ->set('end_hour_monday', $this->request->getData('end_hour_monday'))
                                ->set('open_tuesday', $this->request->getData('open_tuesday'))
                                ->set('start_hour_tuesday', $this->request->getData('start_hour_tuesday'))
                                ->set('end_hour_tuesday', $this->request->getData('end_hour_tuesday'))
                                ->set('open_wednesday', $this->request->getData('open_wednesday'))
                                ->set('start_hour_wednesday', $this->request->getData('start_hour_wednesday'))
                                ->set('end_hour_wednesday', $this->request->getData('end_hour_wednesday'))
                                ->set('open_thursday', $this->request->getData('open_thursday'))
                                ->set('start_hour_thursday', $this->request->getData('start_hour_thursday'))
                                ->set('end_hour_thursday', $this->request->getData('end_hour_thursday'))
                                ->set('open_friday', $this->request->getData('open_friday'))
                                ->set('start_hour_friday', $this->request->getData('start_hour_friday'))
                                ->set('end_hour_friday', $this->request->getData('end_hour_friday'));

                if ($this->Configuration->save($configuration)) 
                {
                    $this->Flash->success(__('The configuration has been saved.'));
                    return $this->redirect($this->referer());
                }

                $this->Flash->error(__('The configuration could not be saved. Please, try again.'));
            }
        }

        $this->set(compact('configuration'));
    }

    //Renvoi les jours de fermeture du CREST pour le picker.
    public function closingDays()
    {
        $this->Authorization->skipAuthorization();
        $default_configuration = Configure::read('default_configuration');
        $configuration = $this->Configuration->find()
                    ->where(['name' => $default_configuration])->first();
        
        $closingDays = $configuration->getClosingDays();


        // Convertir les données en format JSON et les envoyer en réponse
        $this->autoRender = false;
        $this->response = $this->response->withType('application/json')->withStringBody(json_encode($closingDays));

        return $this->response;
    }

    //Renvoi les horaires d'ouverture pour affichage
    public function openingDays()
    {
         $this->Authorization->skipAuthorization();
        $default_configuration = Configure::read('default_configuration');
        $configuration = $this->Configuration->find()
                    ->where(['name' => $default_configuration])->first();
        
        $openingDays = $configuration->getOpeningDays();


        // Convertir les données en format JSON et les envoyer en réponse
        $this->autoRender = false;
        $this->response = $this->response->withType('application/json')->withStringBody(json_encode($openingDays));

        return $this->response;
    }
   
}
