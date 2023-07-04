<?php
declare(strict_types=1);
namespace App\Controller;

use App\Model\Entity\File;
use App\Model\Table\FilesTable;

/**
 * Resources Controller
 *
 * @property \App\Model\Table\ResourcesTable $Resources
 * @method \App\Model\Entity\Resource[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ResourcesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Domains'],
        ];
        $resources = $this->paginate($this->Resources);

        $this->set(compact('resources'));
    }

    /**
     * View method
     *
     * @param string|null $id Resource id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $resource = $this->Resources->get($id, [
            'contain' => ['Domains', 'Files', 'Reservations'],
        ]);

        $this->set(compact('resource'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $resource = $this->Resources->newEmptyEntity();
        if ($this->request->is('post')) {

            //$resource = $this->Resources->patchEntity($resource, $this->request->getData());
            $resource->set('name', $this->request->getData('name'));
            $resource->set('description', $this->request->getData('description'));
            $resource->set('domain_id', $this->request->getData('domain_id'));
            $resource->set('archive', $this->request->getData('archive'));

            //gestion de l'upload de Fichiers
            if(!$resource->getErrors) {

                //Gestion de l'upload d'image
                $picture = $this->request->getData('picture');
                $fileName = $picture->getClientFilename();
                $targetfileID = uniqid((string)rand(),true);
                $targetPath = WWW_ROOT.'img'.DS.'resources'.DS.$targetfileID.$fileName;

                        if($fileName) {
                                       
                            //check si c'est une image
                            $allowed_types = array ( 'image/jpeg', 'image/png', 'image/jpg' );
                            //Verification du type de fichier
                            $fileInfo = finfo_open(FILEINFO_MIME_TYPE);
                            $detected_type = finfo_file( $fileInfo, $picture->getStream()->getMetadata('uri') );
       
                            if (!in_array($detected_type, $allowed_types)) {

                                die ( 'Please upload an image ' );
                            }
                            else {

                                finfo_close( $fileInfo );

                                $picture->moveTo($targetPath);
                                $resource->set('picture', $fileName); 
                                $resource->set('picture_path', $targetfileID.$fileName); 
                            }
                                  
                        }

                //Gestion de l'upload de fichiers
                $filesTable = $this->getTableLocator()->get('Files');
                $resourceFiles = $this->request->getData('files');
                // $rallowed_types = array ( 'image/', 'application/pdf', 'text/' );
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
                        ),
                        'libreoffice' => array(
                            'application/vnd.libreoffice.text',  // .odt
                            'application/vnd.libreoffice.spreadsheet',  // .ods
                            'application/vnd.libreoffice.presentation',  // .odp
                        )

                );

                if($resourceFiles)
                {
                    //première boucle pour vérifier tous les fichiers avant d'enregistrer sur le serveur et bdd
                    foreach($resourceFiles as $rF)
                    { 
                        $rFileName = $rF->getClientFilename();
                        if($rFileName)
                        {                           
                            //Verification du type de fichier
                                $fileInfo = finfo_open(FILEINFO_MIME_TYPE);
                                $detected_type = finfo_file( $fileInfo, $rF->getStream()->getMetadata('uri') );

                                if (!in_array($detected_type, array_merge(...array_values($rallowed_types)))) {

                                        die ( $rFileName.' : Type non accepté. Type : '.$detected_type );
                                    }
                                else
                                {
                                    finfo_close( $fileInfo );
                                }
                        }
                    }

                    //Seconde pour enregistrer
                    foreach($resourceFiles as $rF)
                    {   

                        //Sauvegarde du fichier sur le serveur
                        $rFileName = $rF->getClientFilename();
                        $rTargetfileID = uniqid((string)rand(),true);
                        $rTargetPath =  WWW_ROOT.'ressourcesfiles'.DS.$rTargetfileID.$rFileName;

                        if($rFileName)
                        {
                                
                            //sauvegarde sur le server
                            $rF->moveTo($rTargetPath);
                            // Sauvegarde dans la base
                            $fileEntity = $filesTable->newEmptyEntity();
                            $fileEntity->set('resource', $resource);
                            $fileEntity->set('name', $rFileName);
                            $fileEntity->set('file_path', $rTargetfileID.$rFileName);

                            if ($filesTable->save($fileEntity))
                            {
                                echo 'file entity saved';
                            } 
                            else {
                                echo 'file entity unsaved';
                            }          

                        }
                                               
                    }
                }
            }


            if ($this->Resources->save($resource)) {
                $this->Flash->success(__('The resource has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The resource could not be saved. Please, try again.'));
        }
        $domains = $this->Resources->Domains->find('list', ['limit' => 200])->all();
        $this->set(compact('resource', 'domains'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Resource id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $resource = $this->Resources->get($id, [
            'contain' => ['Files'],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {

           // $resource = $this->Resources->patchEntity($resource, $this->request->getData());
            $resource->set('name', $this->request->getData('name'));
            $resource->set('description', $this->request->getData('description'));
            $resource->set('domain_id', $this->request->getData('domain_id'));
            $resource->set('archive', $this->request->getData('archive'));

             //Gestion de la suppression de l'image
            if(!empty($this->request->getData('deletePicture')))
            {
                $oldPicture = WWW_ROOT.'img'.DS.'resources'.DS.$resource->picture_path;
                if(file_exists($oldPicture))
                {
                  unlink($oldPicture);
                }
                $resource->set('picture',null);
                $resource->set('picture_path',null);
                //ajouter la suppression du fichier
            }
            //gestion de la suppression des fichiers
            $deleteFiles = $this->request->getData('deleteFile');
            if(!empty($deleteFiles))
            {
                foreach($deleteFiles as $dFId)
                {
                    //supp le fichier en physique
                    $fileToDelete = $this->Resources->Files->get($dFId);
                    $fileToDeletePath = WWW_ROOT.'ressourcesfiles'.DS.$fileToDelete->file_path;
                    if(file_exists($fileToDeletePath))
                    {
                            unlink($fileToDeletePath);
                    }

                    $this->Resources->Files->delete($fileToDelete);
                }

            }

            //gestion de l'upload de l'image
            if(!$resource->getErrors) {

                $picture = $this->request->getData('picture');
                $fileName = $picture->getClientFilename();
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

                                //Suppression de la précédente image du serveur si il y en avait une
                                if($resource->picture_path)
                                {
                                    $oldPicture = WWW_ROOT.'img'.DS.'resources'.DS.$resource->picture_path;
                                    if(file_exists($oldPicture))
                                    {
                                        unlink($oldPicture);
                                    }
                                }

                                $picture->moveTo($targetPath);
                                $resource->set('picture', $fileName); 
                                $resource->set('picture_path', $targetfileID.$fileName);
                            }
                                  
                        }
                //Gestion de l'upload de fichiers
                $filesTable = $this->getTableLocator()->get('Files');
                $resourceFiles = $this->request->getData('files');
                // $rallowed_types = array ( 'image/', 'application/pdf', 'text/' );
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
                        ),
                        'libreoffice' => array(
                            'application/vnd.libreoffice.text',  // .odt
                            'application/vnd.libreoffice.spreadsheet',  // .ods
                            'application/vnd.libreoffice.presentation',  // .odp
                        )

                );

                if($resourceFiles)
                {
                    //première boucle pour vérifier tous les fichiers avant d'enregistrer sur le serveur et bdd
                    foreach($resourceFiles as $rF)
                    { 
                        $rFileName = $rF->getClientFilename();
                        if($rFileName)
                        {                           
                            //Verification du type de fichier
                                $fileInfo = finfo_open(FILEINFO_MIME_TYPE);
                                $detected_type = finfo_file( $fileInfo, $rF->getStream()->getMetadata('uri') );

                                if (!in_array($detected_type, array_merge(...array_values($rallowed_types)))) {

                                        die ( $rFileName.' : Type non accepté. Type : '.$detected_type );
                                    }
                                else
                                {
                                    finfo_close( $fileInfo );
                                }
                        }
                    }

                    //Seconde pour enregistrer
                    foreach($resourceFiles as $rF)
                    {   

                        //Sauvegarde du fichier sur le serveur
                        $rFileName = $rF->getClientFilename();
                        $rTargetfileID = uniqid((string)rand(),true);
                        $rTargetPath =  WWW_ROOT.'ressourcesfiles'.DS.$rTargetfileID.$rFileName;

                        if($rFileName)
                        {
                                
                            //sauvegarde sur le server
                            $rF->moveTo($rTargetPath);
                            // Sauvegarde dans la base
                            $fileEntity = $filesTable->newEmptyEntity();
                            $fileEntity->set('resource', $resource);
                            $fileEntity->set('name', $rFileName);
                            $fileEntity->set('file_path', $rTargetfileID.$rFileName);

                            if ($filesTable->save($fileEntity))
                            {
                                echo 'file entity saved';
                            } 
                            else {
                                echo 'file entity unsaved';
                            }          

                        }
                                               
                    }
                }
            }






            if ($this->Resources->save($resource)) {
                $this->Flash->success(__('The resource has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The resource could not be saved. Please, try again.'));
        }
        $domains = $this->Resources->Domains->find('list', ['limit' => 200])->all();
        $this->set(compact('resource', 'domains'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Resource id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $resource = $this->Resources->get($id);
        if ($this->Resources->delete($resource)) {
            $this->Flash->success(__('The resource has been deleted.'));
        } else {
            $this->Flash->error(__('The resource could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
