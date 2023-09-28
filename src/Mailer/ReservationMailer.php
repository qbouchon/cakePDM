<?php

namespace App\Mailer;

use Cake\Mailer\Mailer;
use Cake\ORM\TableRegistry;
use Cake\Core\Configure;

class ReservationMailer extends Mailer
{
    public function sendReminderMail($reservation,$mailText,$mailObject)
    {

        
        $this->setTransport('mailtrap')
            ->setSender('quentin.bouchon@univ-grenoble-alpes.fr','CREST - CakePDM') //Remplacer Mail
            ->setTo($reservation->user->email)
            ->setSubject($mailObject)
            ->viewBuilder()            
            ->setTemplate('default');
           
        $this->setEmailFormat('html')
            ->setViewVars(['content' => $mailText])
            ->send();

           
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
                ->setSender('quentin.bouchon@univ-grenoble-alpes.fr','CREST - CakePDM') //Remplacer Mail
                ->setTo($admin->email)
                ->setSubject($mailObject)
                ->viewBuilder()            
                ->setTemplate('default');
           
            $this->setEmailFormat('html')
                ->setViewVars(['content' => $mailText])
                ->send();

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
            ->setSender('quentin.bouchon@univ-grenoble-alpes.fr','CREST - CakePDM') //Remplacer Mail
            ->setTo($reservation->user->email)
            ->setSubject($mailObject)
            ->viewBuilder()            
            ->setTemplate('default');
       
        $this->setEmailFormat('html')
            ->setViewVars(['content' => $mailText])
            ->send();
    }   

}

?>