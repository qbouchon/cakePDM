<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

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
 * 
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

        return $formatObject;
    }


}
