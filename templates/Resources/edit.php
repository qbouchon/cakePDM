<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Resource $resource
 * @var string[]|\Cake\Collection\CollectionInterface $domains
 */

?>
<div class="container">   

           <div class="row mt-2">
           
                <?= $this->Form->create($resource,['type' => 'file']) ?>

                         <fieldset>

                                 <div class = "col-8 px-5 pt-1 pb-4 mx-auto bg-white rounded">

                                        <h3 class="text-center"><?= $resource->name." <i>(édition)</i>" ?></h3>


                                            <?= $this->Form->control('name',['label'=> 'Nom']);?>

                                            <div class='d-flex align-items-center'>
                                                <?=  $this->Form->control('picture',['type' => 'file',  'class'=>'d-inline', 'id'=>'rAddPicture', 'label' => 'Importer une image (.png, .jpg, .jpeg)', 'accept' => 'image/*']); ?>
                                                
                                                <div id='rResetPicture' class = invisible>
                                                    <button class="btn fa-solid fa-xmark fa-xl"> </button>
                                                </div>                       
                                            </div>

                                            <?php
                                                //Gestion de la suppression à refactorer voir global.js
                                                if($resource->picture)
                                                {
                                                    echo '<div id="PictureManagementBlock">';
                                                    echo '<div id="cancelDeletePicture" class="invisible d-inline"></div>';
                                                    echo '<div id="PictureManagement" class="d-inline">';
                                                    echo 'fichier actuel : '.$resource->picture;
                                                    echo '<div id="rDeletePicture" class="d-inline"><button class="btn fa-solid fa-xmark fa-xl" data-toggle="tooltip" data-placement="top" title="Supprimer" > </button></div>';
                                                    echo '<input type="checkbox" id="deletePictureToggler" name="deletePicture" class="invisible">';
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
                                                    <div id="rFile" class ="rResetFile invisible" data-toggle="File">
                                                        <button class="btn fa-solid fa-xmark fa-xl" data-toggle="tooltip" data-placement="top" title="Supprimer"> </button>
                                                    </div>
                                                </div>

                                                <div  id="inputFileDiv" class=""></div>

                                                <div class="d-flex justify-content-center">    
                                                    <button id="addFileInput" class="btn fa-solid fa-plus fa-2xl" data-toggle="tooltip" data-placement="top" title='Ajouter un autre fichier'> </button> 
                                                </div>  
                                                
                                            <!-- Gestion des fichiers -->
                                            <?php

                                                if(!empty($resource->files)):
                                                    

                                                   
                                                    echo '<h4 class="mb-3 d-flex">Fichier(s) attaché(s) :</h4>';
                                                    echo '<li>';
                                                    foreach ($resource->files as $file) :
                                                        echo '<ul><div id="cancelDeleteFile'.$file->id.'" data-toggle ="'.$file->id.'" class="cancelDeleteFile invisible d-inline"></div>';
                                                        echo '<div id="FileManagement'.$file->id.'" class="d-flex d-inline">';
                                                        echo $file->name;
                                                        echo '<div id="rDeleteFile'.$file->id.'" data-toggle ="'.$file->id.'"class= "rDeleteFile d-inline"><button data-toggle="tooltip" data-placement="top" title="Supprimer" class="btn fa-solid fa-xmark fa-xl"> </button></div>';
                                                        //echo '<input type="checkbox" id="deleteFileToggler'.$file->id.'" name="deleteFile[]" class="invisible">';
                                                        echo $this->Form->hidden('deleteFile[]', ['val' => $file->id, 'disabled' => 'true', 'id' => 'deleteFileToggler'.$file->id]);
                                                        echo '</div></ul>';
                                                        

                                                    endforeach;
                                                    echo '</li>';
                                                endif;
                                            ?>
                                

                                                <div class="text-center">
                                                     <?= $this->Form->button(__('Enregistrer')) ?>
                                                     <?= $this->Form->end() ?>
                                                </div>

                                </div>
                       </fieldset>
            </div>
</div>