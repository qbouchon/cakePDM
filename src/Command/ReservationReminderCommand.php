<?php
namespace App\Command;

use App\Mailer\ReservationMailer;
use Cake\ORM\TableRegistry;

use Cake\Command\Command;
use Cake\Console\Arguments;
use Cake\Console\ConsoleIo;
use Cake\I18n\FrozenDate;
use Cake\Log\Log;

//Send a mail to user when reservation end date is tomorrow
class ReservationReminderCommand extends Command
{
    public function execute(Arguments $args, ConsoleIo $io): int
    {

        Cake\Log\Log::write('CommandResaReminder execute');

        $usersTable =  TableRegistry::getTableLocator()->get('Users');

        $today = FrozenDate::now();
        $tomorrow = $today->addDays(1);

        $reservationTable  =  TableRegistry::getTableLocator()->get('Reservations');

        $reservations = $reservationTable->find()->where([


            "end_date =" => $tomorrow,
            "is_back =" => false 


        ])->contain(['Users','Resources']);

        $recipients = [];
        $mailer = new ReservationMailer();

        foreach($reservations as $reservation)
        {

            Log::write('Send Mail to : ' .$reservation->user->email);
            // $user = $usersTable->find()->where([$reservation->user_id => $user->id]);
            $io->out('Send Mail to : ' .$reservation->user->email);

            $mailer->sendReminderMail($reservation);
        }


        return static::CODE_SUCCESS;
    }
}

?>