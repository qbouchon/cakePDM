<?php
namespace App\Command;

use App\Mailer\WeeklyMailer;
use Cake\ORM\TableRegistry;

use Cake\Command\Command;
use Cake\Console\Arguments;
use Cake\Console\ConsoleIo;

class WeeklyReportCommand extends Command
{
    public function execute(Arguments $args, ConsoleIo $io): int
    {
       


        $usersTable = TableRegistry::getTableLocator()->get('Users');
    	$users = $usersTable->find()->where(['admin'=>true]);

    	$recipients = $users;
        $data = 'test';

        $mailer = new WeeklyMailer();

        foreach ($recipients as $recipient) {


        	$io->out('Send Mail to : ' . $recipient->email);
            $mailer->sendWeeklyReport($recipient->email, $data);
        }


        return static::CODE_SUCCESS;
    }
}

?>

