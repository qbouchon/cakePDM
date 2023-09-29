<?php

namespace App\Mailer;

use Cake\Mailer\Mailer;
use Cake\ORM\TableRegistry;
use Cake\Core\Configure;

class ReservationMailer extends Mailer
{
    public function sendReminderMail($reservation,$mailText,$mailObject)
    {

        $this->setTransport('queue')
            ->setSender('no-reply@crest.fr','CREST - CakePDM') //Remplacer Mail
            ->setTo($reservation->user->email)
            ->setSubject($mailObject)
            ->viewBuilder()            
            ->setTemplate('default');

           
        $this->setEmailFormat('html')
            ->setViewVars(['content' => $mailText]);
            // ->deliver();

        $queuedJobsTable = TableRegistry::getTableLocator()->get('Queue.QueuedJobs');
        $queuedJobsTable->createJob(
                                    'Queue.Email',
                                    ['settings' => $this]
        );

        // $data = [
        //     'settings' => [
        //             'to' => 'test@gmail.com', //$reservation->user->email,
        //             'from' =>'no-reply@crest.fr', //Configure::read('Config.adminEmail'),
        //             'subject' => $mailObject,
        //             'template' => 'default',
        // ],  
        //     'vars' => [
        //             'content' => $mailText,       
        //     ],
        //     'transport' => 'queue', // Specify the desired transport here
        // ];
        // $queuedJobsTable = TableRegistry::getTableLocator()->get('Queue.QueuedJobs');
        // $queuedJobsTable->createJob('Queue.Email', $this);
           
    }

    public function sendMailResaAdmin($reservation)
    {

        $default_configuration = Configure::read('default_configuration');
        $configurationTable = TableRegistry::getTableLocator()->get('Configuration');
        $configuration = $configurationTable->find()
                ->where(['name' => $default_configuration])->first();

        $mailObject = $configuration->formatContent($reservation, $configuration->send_mail_resa_admin_object);
        $mailText =  $configuration->formatContent($reservation, $configuration->send_mail_resa_admin_text);

        $userTable =  TableRegistry::getTableLocator()->get('Users');
        $admins = $userTable->find()->where(['admin' => true]);

        foreach($admins as $admin)
        {
            $this->setTransport('mailtrap')
                ->setSender('no-reply@crest.fr','CREST - CakePDM') //Remplacer Mail
                ->setTo($admin->email)
                ->setSubject($mailObject)
                ->viewBuilder()            
                ->setTemplate('default');
           
            $this->setEmailFormat('html')
                ->setViewVars(['content' => $mailText])
                ->deliver();

        }  

    } 

      public function sendMailEditResaAdmin($reservation)
    {

        $default_configuration = Configure::read('default_configuration');
        $configurationTable = TableRegistry::getTableLocator()->get('Configuration');
        $configuration = $configurationTable->find()
                ->where(['name' => $default_configuration])->first();

        $mailObject = $configuration->formatContent($reservation, $configuration->send_mail_edit_resa_admin_object);
        $mailText =  $configuration->formatContent($reservation, $configuration->send_mail_edit_resa_admin_text);

        $userTable =  TableRegistry::getTableLocator()->get('Users');
        $admins = $userTable->find()->where(['admin' => true]);

        foreach($admins as $admin)
        {
            $this->setTransport('mailtrap')
                ->setSender('no-reply@crest.fr','CREST - CakePDM') //Remplacer Mail
                ->setTo($admin->email)
                ->setSubject($mailObject)
                ->viewBuilder()            
                ->setTemplate('default');
           
            $this->setEmailFormat('html')
                ->setViewVars(['content' => $mailText])
                ->deliver();

        }  

    }

      public function sendMailDeleteResaAdmin($reservation)
    {

        $default_configuration = Configure::read('default_configuration');
        $configurationTable = TableRegistry::getTableLocator()->get('Configuration');
        $configuration = $configurationTable->find()
                ->where(['name' => $default_configuration])->first();

        $mailObject = $configuration->formatContent($reservation, $configuration->send_mail_delete_resa_admin_object);
        $mailText =  $configuration->formatContent($reservation, $configuration->send_mail_delete_resa_admin_text);

        $userTable =  TableRegistry::getTableLocator()->get('Users');
        $admins = $userTable->find()->where(['admin' => true]);

        foreach($admins as $admin)
        {
            $this->setTransport('mailtrap')
                ->setSender('no-reply@crest.fr','CREST - CakePDM') //Remplacer Mail
                ->setTo($admin->email)
                ->setSubject($mailObject)
                ->viewBuilder()            
                ->setTemplate('default');
           
            $this->setEmailFormat('html')
                ->setViewVars(['content' => $mailText])
                ->deliver();

        }  

    }

    public function sendMailResaUser($reservation)
    {
        $default_configuration = Configure::read('default_configuration');
        $configurationTable = TableRegistry::getTableLocator()->get('Configuration');
        $configuration = $configurationTable->find()
                ->where(['name' => $default_configuration])->first();

        $mailObject = $configuration->formatContent($reservation, $configuration->send_mail_resa_user_object);
        $mailText =  $configuration->formatContent($reservation, $configuration->send_mail_resa_user_text);

        $this->setTransport('mailtrap')
            ->setSender('no-reply@crest.fr','CREST - CakePDM') //Remplacer Mail
            ->setTo($reservation->user->email)
            ->setSubject($mailObject)
            ->viewBuilder()            
            ->setTemplate('default');
       
        $this->setEmailFormat('html')
            ->setViewVars(['content' => $mailText])
            ->deliver();
    }   

    public function sendMailEditResaUser($reservation)
    {
        $default_configuration = Configure::read('default_configuration');
        $configurationTable = TableRegistry::getTableLocator()->get('Configuration');
        $configuration = $configurationTable->find()
                ->where(['name' => $default_configuration])->first();

        $mailObject = $configuration->formatContent($reservation, $configuration->send_mail_edit_resa_user_object);
        $mailText =  $configuration->formatContent($reservation, $configuration->send_mail_edit_resa_user_text);

        $this->setTransport('mailtrap')
            ->setSender('no-reply@crest.fr','CREST - CakePDM') //Remplacer Mail
            ->setTo($reservation->user->email)
            ->setSubject($mailObject)
            ->viewBuilder()            
            ->setTemplate('default');
       
        $this->setEmailFormat('html')
            ->setViewVars(['content' => $mailText])
            ->deliver();
    }   

    public function sendMailDeleteResaUser($reservation)
    {
        $default_configuration = Configure::read('default_configuration');
        $configurationTable = TableRegistry::getTableLocator()->get('Configuration');
        $configuration = $configurationTable->find()
                ->where(['name' => $default_configuration])->first();

        $mailObject = $configuration->formatContent($reservation, $configuration->send_mail_delete_resa_user_object);
        $mailText =  $configuration->formatContent($reservation, $configuration->send_mail_delete_resa_user_text);

        $this->setTransport('mailtrap')
            ->setSender('no-reply@crest.fr','CREST - CakePDM') //Remplacer Mail
            ->setTo($reservation->user->email)
            ->setSubject($mailObject)
            ->viewBuilder()            
            ->setTemplate('default');
       
        $this->setEmailFormat('html')
            ->setViewVars(['content' => $mailText])
            ->deliver();
    }   


    public function sendMailBackResaUser($reservation)
    {
        $default_configuration = Configure::read('default_configuration');
        $configurationTable = TableRegistry::getTableLocator()->get('Configuration');
        $configuration = $configurationTable->find()
                ->where(['name' => $default_configuration])->first();

        $mailObject = $configuration->formatContent($reservation, $configuration->send_mail_back_resa_user_object);
        $mailText =  $configuration->formatContent($reservation, $configuration->send_mail_back_resa_user_text);

        $this->setTransport('mailtrap')
            ->setSender('no-reply@crest.fr','CREST - CakePDM') //Remplacer Mail
            ->setTo($reservation->user->email)
            ->setSubject($mailObject)
            ->viewBuilder()            
            ->setTemplate('default');
       
        $this->setEmailFormat('html')
            ->setViewVars(['content' => $mailText])
            ->deliver();
    }   


}

?>