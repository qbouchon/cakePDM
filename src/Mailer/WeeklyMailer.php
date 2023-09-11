<?php

namespace App\Mailer;

use Cake\Mailer\Mailer;

class WeeklyMailer extends Mailer
{
    public function sendWeeklyReport($recipient, $data)
    {
        // $this
        //     ->setTo($recipient)
        //     ->setSubject('Rapport hebdomadaire')
        //     ->setViewVars(['data' => $data])
        //     ->send("testMessage");

    // $this->setFrom(['moi@example.com' => 'Mon Site'])
    // ->setTo('toi@example.com')
    // ->setSubject('À propos')
    // ->send('Mon message');

        $this->setTransport('mailtrap')
            ->setSender('quentin.bouchon@univ-grenoble-alpes.fr','Admin Cakepdm')
            ->setTo($recipient)
            ->setSubject('Test subject')
            ->deliver($data);

    }
}

?>