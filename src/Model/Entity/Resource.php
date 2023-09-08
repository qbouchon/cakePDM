<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Resource Entity
 *
 * @property int $id
 * @property string $name
 * @property string|null $picture
 * @property string|null $picture_path
 * @property string|null $description
 * @property int|null $domain_id
 * @property int|null $max_duration
 * @property bool|null $archive
 * @property string|null $color
 * 
 *
 * @property \App\Model\Entity\Domain $domain
 * @property \App\Model\Entity\File[] $files
 * @property \App\Model\Entity\Reservation[] $reservations
 */
class Resource extends Entity
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
        'domain_id' => true,
        'max_duration' => true,
        'archive' => true,
        'domain' => true,
        'color' => true,
        'files' => true,
        'reservations' => true,
    ];

    protected $_virtual = ['domain_name'];


     protected function _getDomainName()
    {

        if($this->domain)
            return $this->domain->name;
        else
            return null;
    }


    public function setRandomColor(){

        $this->set('color',sprintf('#%02X%02X%02X', rand(0, 255), rand(0, 255), rand(0, 255)));
    }



    /*add picture both on server and entity (call save after calling this to update db)
    * eventually delete old picture
    */
    public function addPicture($newPicture){

        $fileName = $newPicture->getClientFilename();
        $targetfileID = uniqid((string)rand(),true);
        $targetPath = WWW_ROOT.'img'.DS.'resources'.DS.$targetfileID.$fileName;

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

        $oldPicture = WWW_ROOT.'img'.DS.'resources'.DS.$this->picture_path;

        if(file_exists($oldPicture))
        {
            unlink($oldPicture);
        }

        $this->set('picture',null);
        $this->set('picture_path',null);
    }


    /** add files both on server and entities (call save on resource after calling this to update db)
    * Also create a File entity for each files in newFiles and save them into db
    */ 
    public function addFiles($newFiles, $filesTable){


        $rallowed_types = array(
            'image' => array('image/jpeg', 'image/png'),
            'pdf' => array('application/pdf'),
            'text' => array('text/plain'),
            'office' => array(
                        'application/vnd.ms-office',
                        'application/vnd.openxmlformats-officedocument.wordprocessingml.document',  // .docx
                        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',  // .xlsx
                        'application/vnd.openxmlformats-officedocument.presentationml.presentation',  // .pptx
                        'application/msword',  // .doc
                        'application/vnd.ms-excel',  // .xls
                        'application/vnd.ms-powerpoint',  // .ppt
                    ),
            'openoffice' => array(
                            'application/vnd.oasis.opendocument.text',  // .odt
                            'application/vnd.oasis.opendocument.spreadsheet',  // .ods
                            'application/vnd.oasis.opendocument.presentation',  // .odp
                            'application/vnd.oasis.opendocument.graphics', //.odg
                        ),
            'libreoffice' => array(
                            'application/vnd.libreoffice.text',  // .odt
                            'application/vnd.libreoffice.spreadsheet',  // .ods
                            'application/vnd.libreoffice.presentation',  // .odp

                        )

        );

        if($newFiles)
        {
            //première boucle pour vérifier tous les fichiers avant d'enregistrer sur le serveur et bdd
            foreach($newFiles as $rF)
            { 
                $rFileName = $rF->getClientFilename();
                if($rFileName)
                {                           
                    //Verification du type de fichier
                    $fileInfo = finfo_open(FILEINFO_MIME_TYPE);
                    $detected_type = finfo_file( $fileInfo, $rF->getStream()->getMetadata('uri') );

                    if (!in_array($detected_type, array_merge(...array_values($rallowed_types)))) 
                    {

                        die ( $rFileName.' : Type non accepté. Type : '.$detected_type );
                    }
                    else
                    {
                        finfo_close( $fileInfo );
                    }
                }
            }

            //Seconde pour enregistrer
            foreach($newFiles as $rF)
            {   

                //Sauvegarde du fichier sur le serveur
                $rFileName = $rF->getClientFilename();
                $rTargetfileID = uniqid((string)rand(),true);
                $rTargetPath =  WWW_ROOT.'resourcesfiles'.DS.$rTargetfileID.$rFileName;

                if($rFileName)
                {

                    //sauvegarde sur le server
                    $rF->moveTo($rTargetPath);

                    // Sauvegarde dans la base Table Files
                    $fileEntity = $filesTable->newEmptyEntity();
                    $fileEntity->set('resource', $this);
                    $fileEntity->set('name', $rFileName);
                    $fileEntity->set('file_path', $rTargetfileID.$rFileName);

                    if ($filesTable->save($fileEntity))
                    {
                        echo 'file entity saved';
                    } 
                    else 
                    {
                        echo 'file entity unsaved';
                    }          

                }

            }
        }


    }

    //$filesToDeleteIds => array of files ids
    public function deleteFilesByIds($filesToDeleteIds, $filesTable){


         if(!empty($filesToDeleteIds))
            {
                foreach($filesToDeleteIds as $dFId)
                {
                    //supp le fichier en physique
                    $fileToDelete = $filesTable->get($dFId);
                    $fileToDeletePath = WWW_ROOT.'resourcesfiles'.DS.$fileToDelete->file_path;
                    if(file_exists($fileToDeletePath))
                    {
                        unlink($fileToDeletePath);
                    }

                    $filesTable->delete($fileToDelete);
                }

            }

    }

    //$filesToDelete => array of Files
    public function deleteFiles($filesToDelete, $filesTable){

         if(!empty($filesToDelete))
            {
                foreach($filesToDelete as $fileToDelete)
                {
                    //supp le fichier en physique
                    $fileToDeletePath = WWW_ROOT.'resourcesfiles'.DS.$fileToDelete->file_path;
                    if(file_exists($fileToDeletePath))
                    {
                        unlink($fileToDeletePath);
                    }

                    $filesTable->delete($fileToDelete);
                }

            }

    }

    public function deleteReservations($reservationsToDelete, $reservationsTable)
    {
        if(!empty($reservationsToDelete))
            {
                foreach($reservationsToDelete as $reservationToDelete)
                {
                    $reservationsTable->delete($reservationToDelete);
                }

            }
    }

    //Renvoie toutes les dates de réservations, peu importe si la ressource a été rendue ou non (utile pour les stats)
    public function getReservationsDates()
    {
        $dates = [];


        if(!empty($this->reservations))
        {
            foreach($this->reservations as $reservation)
            {
                    $dates[] = [$reservation->start_date,$reservation->end_date];
            }
        }
        

        return $dates;
    }

    //Renvoie les dates de réservation pour les ressources non retournées (utile pour créer des réservations)
    public function getCurrentReservationsDates()
    {
        $dates = [];


        if(!empty($this->reservations))
        {
            foreach($this->reservations as $reservation)
            {
                if(!$reservation->is_back)
                    $dates[] = [$reservation->start_date,$reservation->end_date];

            }
        }
        

        return $dates;
    }

     //Renvoie les dates de réservation pour les ressources non retournées sauf celle de la reservation passée en paramètre
    public function getCurrentReservationsDatesESR($reservationToExclude)
    {
        $dates = [];


        if(!empty($this->reservations))
        {
            foreach($this->reservations as $reservation)
            {
                if(!$reservation->is_back && $reservation->id != $reservationToExclude->id)
                    $dates[] = [$reservation->start_date,$reservation->end_date];

            }
        }
        

        return $dates;
    }

    public function getReservationsCount()
    {
       



             if(!empty($this->reservations))
                {
                    return count($this->reservations);
                }
                else
                    return 0;

  

    }

}




