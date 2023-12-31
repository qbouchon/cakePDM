<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Domain Entity
 *
 * @property int $id
 * @property string $name
 * @property string|null $picture
 * @property string|null $picture_path
 * @property string|null $description
 *
 * @property \App\Model\Entity\Resource[] $resources
 */
class Domain extends Entity
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
        'picture' => true,
        'picture_path' => true,
        'description' => true,
        'resources' => true,
    ];


    /*add picture both on server and entity (call save after calling this to update db)
    * eventually delete old picture
    */
    public function addPicture($newPicture){       

        $fileName = $newPicture->getClientFilename();
        $targetfileID = uniqid((string)rand(),true);
        $targetPath = WWW_ROOT.'img'.DS.'domains'.DS.$targetfileID.$fileName;

        if($fileName) {

            //check si c'est une image
            $allowed_types = array ( 'image/jpeg', 'image/png', 'image/jpg' );
            $fileInfo = finfo_open(FILEINFO_MIME_TYPE);
            $detected_type = finfo_file( $fileInfo, $_FILES['picture']['tmp_name'] );
            
            if (!in_array($detected_type, $allowed_types)) {

                die ( 'Please upload a pdf or an image ' );
            }
            else {

                finfo_close( $fileInfo );

                //Si une image est déjà présente, on la supprime
                if($this->picture_path)
                {
                    $this->deletePicture();
                }

                $newPicture->moveTo($targetPath);
                $this->set('picture', $fileName); 
                $this->set('picture_path', $targetfileID.$fileName); 
            }
            
        }


    }

    //delete picture both on server and entity (call save after calling this to update db)
    public function deletePicture(){

        $oldPicture = WWW_ROOT.'img'.DS.'domains'.DS.$this->picture_path;

        if(file_exists($oldPicture))
        {
            unlink($oldPicture);
        }

        $this->set('picture',null);
        $this->set('picture_path',null);
    }


    //set domain_id null for ressources 
    public function removeResources($resourcesToRemove, $resourcesTeble){

        if(!empty($resourcesToRemove))
        {
            foreach($resourcesToRemove as $rtr)
            {
                $resourcesTeble->patchEntity($rtr,['domain_id' => null]);
                $resourcesTeble->save($rtr);
            }
        }


    }
}
