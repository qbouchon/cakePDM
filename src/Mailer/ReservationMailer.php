<?php

namespace App\Mailer;

use Cake\Mailer\Mailer;

class ReservationMailer extends Mailer
{
    public function sendReminderMail($reservation,$mailText,$mailObject)
    {

        
        $this->setTransport('mailtrap')
            ->setSender('quentin.bouchon@univ-grenoble-alpes.fr','CREST - CakePDM')
            ->setTo($reservation->user->email)
            ->setSubject($mailObject)
             ->viewBuilder()
             
                ->setTemplate('reservation_reminder');
           
           $this->setEmailFormat('html')
            ->setViewVars(['content' => $mailText])
            ->send();

           
    }
}

?>