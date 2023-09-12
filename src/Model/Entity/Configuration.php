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
    protected array $_accessible = [
        'name' => true,
        'home_text' => true,
        'home_picture' => true,
        'home_picture_path' => true,
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


}
