<?php
declare(strict_types=1);

namespace App\Controller;
use Cake\Core\Configure;

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

                // Application de la configuration de mail
                if($configuration->mail_protocol && $configuration->mail_host && $configuration->mail_port && $configuration->mail_username && $configuration->mail_password)
                {
                    $emailConfig = [
                                        'default' => [
                                        'host' => $configuration->mail_host,
                                        'port' =>  $configuration->mail_port,
                                        'username' => $configuration->mail_username,
                                        'password' => $configuration->mail_password,
                                        'transport' => $configuration->mail_protocol,
                                        ],
                                    ];

                    Configure::write('Email', $emailConfig);

                }


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

   
}
