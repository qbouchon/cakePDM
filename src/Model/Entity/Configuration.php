<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Mailer\TransportFactory;

/**
 * Configuration Entity
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $home_text
 * @property string|null $home_picture
 * @property string|null $home_picture_path
 * @property string|null $reminder_mail_text
 * @property string|null $reminder_mail_oject
 * @property bool|null $send_mail_resa_admin
 * @property bool|null $send_mail_edit_resa_admin
 * @property bool|null $send_mail_delete_resa_admin
 * @property bool|null $send_mail_resa_user
 * @property bool|null $send_mail_edit_resa_user
 * @property bool|null $send_mail_delete_resa_user
 * @property string|null $send_mail_resa_admin_object
 * @property string|null $send_mail_resa_admin_text
 * @property string|null $send_mail_edit_admin_object
 * @property string|null $send_mail_edit_admin_text
 * @property string|null $send_mail_delete_resa_admin_object
 * @property string|null $send_mail_delete_resa_admin_text
 * @property string|null $send_mail_resa_user_object
 * @property string|null $send_mail_resa_user_text
 * @property string|null $send_mail_edit_resa_user_object
 * @property string|null $send_mail_edit_resa_user_text
 * @property string|null $send_mail_delete_resa_user_object
 * @property string|null $send_mail_delete_resa_user_text
 * @property string|null $mail_protocol
 * @property string|null $mail_host
 * @property string|null $mail_port
 * @property string|null $mail_username
 * @property string|null $mail_password
 * @property bool|null $open_monday
 * @property bool|null $open_tuesday
 * @property bool|null $open_wednesday
 * @property bool|null $open_thursday
 * @property bool|null $open_friday
 * @property string|null $start_hour_monday
 * @property string|null $end_hour_monday
 * @property string|null $start_hour_tuesday
 * @property string|null $end_hour_tuesday
 * @property string|null $start_hour_wednesday
 * @property string|null $end_hour_wednesday
 * @property string|null $start_hour_thursday
 * @property string|null $end_hour_thursday
 * @property string|null $start_hour_friday
 * @property string|null $end_hour_friday
 * 
 * 

 * 

 * 
 */
class Configuration extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected $_accessible = [
        'name' => true,
        'home_text' => true,
        'home_picture' => true,
        'home_picture_path' => true,
        'reminder_mail_text' => true,
        'reminder_mail_object' => true,
        'send_mail_resa_admin' => true,
        'send_mail_edit_resa_admin' => true,
        'send_mail_delete_resa_admin' => true,
        'send_mail_resa_user' => true,
        'send_mail_edit_resa_user' => true,
        'send_mail_delete_resa_user' => true,
        'send_mail_back_resa_user' => true,
        'mail_protocol' => true,
        'mail_host' => true,
        'mail_port' => true,
        'mail_username' => true,
        'mail_password' => true,
        'open_monday' => true,
        'open_tuesday' => true,
        'open_wednesday' => true,
        'open_thursday' => true,
        'open_friday' => true,
        'start_hour_monday' => true,
        'end_hour_monday' => true,
        'start_hour_tuesday' => true,
        'end_hour_tuesday' => true,
        'start_hour_wednesday' => true,
        'end_hour_wednesday' => true,
        'start_hour_thursday' => true,
        'end_hour_thursday' => true,
        'start_hour_friday' => true,
        'end_hour_friday' => true,
        
    ];


     /*add picture both on server and entity (call save after calling this to update db)
    * eventually delete old picture
    */
    public function addPicture($newPicture){       

        $fileName = $newPicture->getClientFilename();
        $targetfileID = uniqid((string)rand(),true);
        $targetPath = WWW_ROOT.'img'.DS.'home'.DS.$targetfileID.$fileName;

        if($fileName) {

            //check si c'est une image
            $allowed_types = array ( 'image/jpeg', 'image/png', 'image/jpg' );
            $fileInfo = finfo_open(FILEINFO_MIME_TYPE);
            $detected_type = finfo_file( $fileInfo, $_FILES['home_picture']['tmp_name'] );
            
            if (!in_array($detected_type, $allowed_types)) {

                die ( 'Please upload a pdf or an image ' );
            }
            else {

                finfo_close( $fileInfo );

                //Si une image est déjà présente, on la supprime
                if($this->home_picture_path)
                {
                    $this->deletePicture();
                }

                $newPicture->moveTo($targetPath);
                $this->set('home_picture', $fileName); 
                $this->set('home_picture_path', $targetfileID.$fileName); 
            }
            
        }


    }

    //delete picture both on server and entity (call save after calling this to update db)
    public function deletePicture(){

        $oldPicture = WWW_ROOT.'img'.DS.'home'.DS.$this->home_picture_path;

        if(file_exists($oldPicture))
        {
            unlink($oldPicture);
        }

        $this->set('home_picture',null);
        $this->set('home_picture_path',null);
    }


    //Remplace les variables du mail par les valeurs correspondantes à la reservation
    public function formatReminderMailText($reservation)
    {

            $mailText = str_replace('$firstname', $reservation->user->firstname, $this->reminder_mail_text);
            $mailText = str_replace('$lastname', $reservation->user->lastname, $mailText);
            $mailText = str_replace('$resource', $reservation->resource->name, $mailText);
            $mailText = str_replace('$start', $reservation->start_date->format('d-m-Y'), $mailText);
            $mailText = str_replace('$end', $reservation->end_date->format('d-m-Y'), $mailText);
            $mailText = str_replace('$login', $reservation->user->username, $mailText);
            $mailText = str_replace('$id', strval($reservation->id), $mailText);

            if($reservation->is_back)
                $mailText = str_replace('$back', 'rendue', $mailText);
            else
                $mailText = str_replace('$back', 'non rendue', $mailText);

            return $mailText;
    }


    //Remplace les variables de l'objet du mail par les valeurs correspondantes à la reservation
    public function formatReminderMailObject($reservation)
    {

            $mailObject = str_replace('$firstname', $reservation->user->firstname, $this->reminder_mail_object);
            $mailObject = str_replace('$lastname', $reservation->user->lastname, $mailObject);
            $mailObject = str_replace('$resource', $reservation->resource->name, $mailObject);
            $mailObject = str_replace('$start', $reservation->start_date->format('d-m-Y'), $mailObject);
            $mailObject = str_replace('$end', $reservation->end_date->format('d-m-Y'), $mailObject);
            $mailObject = str_replace('$login', $reservation->user->username, $mailObject);
            $mailObject = str_replace('$id', strval($reservation->id), $mailObject);

            if($reservation->is_back)
                $mailObject = str_replace('$back', 'rendue', $mailObject);
            else
                $mailObject = str_replace('$back', 'non rendue', $mailObject);


            return $mailObject;
    }

    public function formatContent($reservation, $content)
    {
        $formatObject = str_replace('$firstname', $reservation->user->firstname, $content);
        $formatObject = str_replace('$lastname', $reservation->user->lastname, $formatObject);
        $formatObject = str_replace('$resource', $reservation->resource->name, $formatObject);
        $formatObject = str_replace('$start', $reservation->start_date->format('d-m-Y'), $formatObject);
        $formatObject = str_replace('$end', $reservation->end_date->format('d-m-Y'), $formatObject);
        $formatObject = str_replace('$login', $reservation->user->username, $formatObject);
        $formatObject = str_replace('$id', strval($reservation->id), $formatObject);

        if($reservation->is_back)
            $formatObject = str_replace('$back', 'rendue', $formatObject);
        else
            $formatObject = str_replace('$back', 'non rendue', $formatObject);

        return $formatObject;
    }


    public function getFormattedHomeText()
    {
        $openingDays = $this->getOpeningDays();
        $openingDaysContent = '<div><b>Horaires d\'ouverture du CREST :</b></div>';

        if($openingDays)
        {
            foreach($openingDays as $day => $hours)
            {
                   $openingDaysContent .= '<div>'.$day.' : '.$hours[0].'-'.$hours[1].'</div>';
            }

        }

        $formattedHomeText = str_replace('$horaires', $openingDaysContent, $this->home_text);

        return $formattedHomeText;
    }

    // à refactorer (voir reservationMailer)
    public function createTransport()
    {
        TransportFactory::setConfig('crestTransport', [
               'host' => $this->mail_host,
               'port' => $this->mail_port,
               'username' => $this->mail_username,
               'password' => $this->mail_password,
               'className' => $this->mail_protocol
        ]);

        return 'crestTransport';
    }



    //Renvoi les jours de fermeture du CREST pour le picker. Bricollage avec le nom des jours pour feet les besoins du picker
    //Manque d'adaptabilité
    public function getClosingDays()
    {
        $closingDays =[];

        if(!$this->open_monday)
            $closingDays[]= 'Lundi';
        if(!$this->open_tuesday)
            $closingDays[]= 'Mardi';
        if(!$this->open_wednesday)
            $closingDays[]= 'Mercredi';
        if(!$this->open_thursday)
            $closingDays[]= 'Jeudi';
        if(!$this->open_friday)
            $closingDays[]= 'Vendredi';
        
        $closingDays[] = 'Samedi';
        $closingDays[] = 'Dimanche';

        return $closingDays;
    }

    //Renvoie les horaires poour affichage  
    public function getOpeningDays()
    {
        $openingDays = [];

        if($this->open_monday)
        {
            $openingDays['Lundi'] = [$this->start_hour_monday, $this->end_hour_monday];
        }
        if($this->open_tuesday)
        {
            $openingDays['Mardi'] = [$this->start_hour_tuesday, $this->end_hour_tuesday];
        }
        if($this->open_wednesday)
        {
            $openingDays['Mercredi'] = [$this->start_hour_wednesday, $this->end_hour_wednesday];
        }
        if($this->open_thursday)
        {
            $openingDays['Jeudi'] = [$this->start_hour_thursday, $this->end_hour_thursday];
        }
        if($this->open_friday)
        {
            $openingDays['Vendredi'] = [$this->start_hour_friday, $this->end_hour_friday];
        }

        return $openingDays;
    }

}
