<?php
    $this->Breadcrumbs->add(
    'Home',
    ['controller' => 'Pages', 'action' => 'display']
    )
    ->add(
    'Ressources',
    ['controller' => 'Resources', 'action' => 'index']
    )
    ->add('Editer ressource');



?>

<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Resource $resource
 * @var string[]|\Cake\Collection\CollectionInterface $domains
 */

?>
<div class = "row">
    <aside class="column">
        <div class="side-nav">
            <!-- <h4 class="heading"><?= __('Actions') ?></h4> -->
            <?= $this->Html->link(__('Liste des Ressources'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="resources form content">
            <?= $this->Form->create($resource,['type' => 'file']) ?>
            <fieldset>
                <h3 class="text-center"><?= $resource->name." <i>(édition)</i>" ?></h3>
                <?php
                echo $this->Form->control('name');?>

                <div class='d-flex align-items-center'>
                    <?php echo $this->Form->control('picture',['type' => 'file',  'class'=>'d-inline', 'id'=>'rAddPicture', 'label' => 'Importer une image (.png, .jpg, .jpeg)', 'accept' => 'image/*']); 
                    ?>
                    
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
                <?php    
                    echo $this->Form->control('description');
                    echo $this->Form->control('domain_id', ['options' => $domains, 'empty' => true]);
                    echo $this->Form->control('archive', ['label' => 'Archiver cette resource (ne sera plus réservable)']);
                ?> 
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
                    <!-- Pour ajouter d'autres fichiers -->
                    <div class="d-flex align-items-center">
                        <?php
                            echo $this->Form->control('files[]', ['type' => 'file', 'id'=>'File', 'class'=>'iFile d-inline', 'label' => 'Importer un fichier (image, pdf, document office, openoffice, libreoffice)', 'accept' => '*'])
                        ?>  
                        <div id="rFile" class ="rResetFile invisible" data-toggle="File">
                            <button class="btn fa-solid fa-xmark fa-xl" data-toggle="tooltip" data-placement="top" title="Supprimer"> </button>
                        </div>
                    </div>

                    <div  id="inputFileDiv" class=""></div>
                    <div class="d-flex justify-content-center">    
                        <button id="addFileInput" class="btn fa-solid fa-plus fa-2xl" data-toggle="tooltip" data-placement="top" title='Ajouter un autre fichier'> </button> 
                    </div>      
                    


            </fieldset>
            <?= $this->Form->button(__('Enregistrer')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
