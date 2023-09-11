<?php

namespace App\Mailer;

use Cake\Mailer\Mailer;

class ReservationMailer extends Mailer
{
    public function sendReminderMail($reservation)
    {
    

        $this->setTransport('mailtrap')
            // ->setSender('quentin.bouchon@univ-grenoble-alpes.fr','CREST - CakePDM')
            ->setTo($reservation->user->email)
            ->setSubject('! Une de vos réservations arrive à son terme')
             ->viewBuilder()
                ->setTemplate('reservation_reminder');
           
           $this->setEmailFormat('html')
            ->setViewVars(['firstname' => $reservation->user->firstname,'lastname' => $reservation->user->lastname,'resource' => $reservation->resource->name, 'debut' => $reservation->start_date, 'fin' => $reservation->end_date])
            ->send();
    }
}

?>