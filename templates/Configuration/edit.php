<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Configuration $configuration
 */
?>
<div class="row">
    
    <div class="column-responsive column-80">
        <div class="configuration form content">
            <h3 class="text-center font-weight-bold"><?= __('Configuration') ?></h3>
            <?= $this->Form->create($configuration, ['type' => 'file']) ?>
            <fieldset>
                <h4 class="font-weight-bold"><?= __('Personnaliser l\'accueil') ?></h4>
                <?php
  
                     echo $this->Form->control('picture',['type' => 'file', 'value' =>$configuration->home_picture, 'id'=>'rAddPicture', 'label' => 'Ajouter une image d\'entête (.png, .jpg, .jpeg)', 'accept' => 'image/*']);                   
                ?>
                     <div id='rResetPicture' class = invisible>
                        <button class="btn fa-solid fa-xmark fa-xl"> </button>
                    </div> 
                </div>
                <?php
                //Gestion de la suppression à refactorer voir global.js
                if($configuration->picture)
                {
                    echo '<div id="PictureManagementBlock">';
                    echo '<div id="cancelDeletePicture" class="invisible d-inline"></div>';
                    echo '<div id="PictureManagement" class="d-inline">';
                    echo 'fichier actuel : '.$configuration->picture;
                    echo '<div id="rDeletePicture" class="d-inline"><button class="btn fa-solid fa-xmark fa-xl" data-toggle="tooltip" data-placement="top" title="Supprimer"> </button></div>';
                    echo '<input type="checkbox" id="deletePictureToggler" name="deletePicture" class="invisible">';
                    echo '</div>';
                    echo '</div>';
                }
                ?>


                <?php echo $this->Form->control('home_text',['label'=>'Personnaliser le texte d\'accueil']); ?>
            </fieldset>
            <?= $this->Form->button(__('Enregistrer')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>


