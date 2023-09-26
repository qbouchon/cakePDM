<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Resource $resource
 * @var string[]|\Cake\Collection\CollectionInterface $domains
 */

?>

<?php $this->assign('title', 'CREST - Ressources'); ?>

<div class="container">   

   <div class="row mt-2">
   
        <?= $this->Form->create($resource,['type' => 'file']) ?>

         <fieldset>

            <div class = "col-8 px-5 pt-1 pb-4 mx-auto bg-white rounded">

                <h3 class="text-center"><?= $resource->name." <i>(édition)</i>" ?></h3>


                    <?= $this->Form->control('name',['label'=> 'Nom']);?>

                    <div class='d-flex align-items-center'>
                        <?=  $this->Form->control('picture',['type' => 'file',  'class'=>'d-inline', 'id'=>'rAddPicture', 'label' => 'Importer une image (.png, .jpg, .jpeg)', 'accept' => 'image/*']); ?>
                        <div id='rResetPicture' class = "displaynone">
                            <button class="btn deletePictureButton fa-solid fa-xmark fa-xl"></button>
                        </div>                       
                    </div>

                    <?php
                        //Gestion de la suppression à refactorer voir app.js
                        if($resource->picture)
                        {
                            echo '<div id="PictureManagementBlock">';
                            echo '<div id="cancelDeletePicture" class="displaynone"></div>';
                            echo '<div id="PictureManagement" class="">';
                            echo '<div class="d-inline d-flex align-items-center">';
                            echo 'fichier actuel : '.$resource->picture;
                            echo '<div id="rDeletePicture" class="d-inline"><button class="btn deletePictureButton fa-solid fa-xmark fa-xl" ></button></div>';
                            echo '<input type="checkbox" id="deletePictureToggler" name="deletePicture" class="displaynone">';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                        }
                    ?>


                    <?= $this->Form->control('description',['label' => 'Description']); ?>
                    <?= $this->Form->control('domain_id', ['options' => $domains, 'empty' => true, 'label' => 'Domaine']); ?>

                    <div class="row d-flex align-items-center">
                        <?= $this->Form->label('Durée de réservation maximale (1 semaine = 7 jours)'); ?>
                        <div class='col-2 mt-2'>
                            <?= $this->Form->control('max_duration',['label'=>false, 'class' => 'form-control w-75']); ?>
                        </div>
                        <div class='col-2 pb-1'>
                            <i>jour(s)</i>
                        </div>
                    </div>

                    <!-- $this->Form->control('color',['type'=>'color', 'label'=>'Couleur de la ressource pour l\'affichage dans le calendrier']); -->
                    <?= $this->Form->control('archive', ['label' => 'Archiver cette resource (ne sera plus réservable)']); ?>
                     
                    <!-- Pour ajouter d'autres fichiers -->
                    <div class="d-flex align-items-center">
                        <?= $this->Form->control('files[]', ['type' => 'file', 'id'=>'File', 'class'=>'iFile d-inline', 'label' => 'Importer un fichier (image, pdf, document office, openoffice, libreoffice)', 'accept' => '*']) ?>  
                        <div id="rFile" class ="rResetFile displaynone" data-toggle="File">
                            <button class="btn deleteFileButton fa-solid fa-xmark fa-xl"> </button>
                        </div>
                    </div>

                    <div  id="inputFileDiv" class=""></div>

                    <div class="d-flex justify-content-center mb-3">    
                        <i id="addFileInput" class=" addButton addFileButton fa-solid fa-plus fa-xl" ></i> 
                    </div>  
                        
                    <!-- Gestion des fichiers -->
                    <?php

                        if(!empty($resource->files))
                        {
                                                      
                            echo '<h4 class="mb-3">Fichier(s) attaché(s) :</h4>';
                            echo '<ul>';

                            foreach ($resource->files as $file)
                            {
                                
                                echo '<li><div id="cancelDeleteFile'.$file->id.'" data-toggle ="'.$file->id.'" class="cancelDeleteFile displaynone"></div>';
                                
                                echo '<div id="FileManagement'.$file->id.'" class="">';
                                echo '<div class="d-flex d-inline">';
                                echo $file->name;
                                echo '<div id="rDeleteFile'.$file->id.'" data-toggle ="'.$file->id.'"class= "rDeleteFile"><button class="btn deleteFileButton fa-solid fa-xmark fa-xl"> </button></div>';
                                //echo '<input type="checkbox" id="deleteFileToggler'.$file->id.'" name="deleteFile[]" class="displaynone">';
                                echo $this->Form->hidden('deleteFile[]', ['val' => $file->id, 'disabled' => 'true', 'id' => 'deleteFileToggler'.$file->id]);
                                echo '</div>'; 
                                echo '</div></li>'; 
                                                            
                            }
                            
                            echo '</ul>';
                        }
                    ?>
        

                    <div class="text-center">
                         <?= $this->Form->button(__('Enregistrer')) ?>
                         <?= $this->Form->end() ?>
                    </div>

            </div>
       </fieldset>
    </div>
</div>