<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Configuration $configuration
 */
?>
<div class="container">   

     <div class="row mt-2">   
 
            <h3 class="text-center font-weight-bold"><?= __('Configuration') ?></h3>


            <?= $this->Form->create($configuration, ['type' => 'file']) ?>
           
            <fieldset>

                    <div class = "col-8 px-5 pt-1 pb-4 mx-auto bg-white rounded">
                            <h4 class="font-weight-bold"><?= __('Personnaliser l\'accueil') ?></h4>

                           <div class='d-flex align-items-center'>
                                <?= $this->Form->control('home_picture',['type' => 'file', 'value' =>$configuration->home_picture, 'id'=>'rAddPicture', 'label' => 'Ajouter une image d\'entête (.png, .jpg, .jpeg)', 'accept' => 'image/*']); ?>

                                     <div id='rResetPicture' class = invisible>
                                        <button class="btn fa-solid fa-xmark fa-xl"> </button>
                                    </div>
                            </div> 
                            
                            <?php
                                    //Gestion de la suppression à refactorer voir global.js
                                    if($configuration->home_picture)
                                    {
                                        echo '<div id="PictureManagementBlock">';
                                        echo '<div id="cancelDeletePicture" class="invisible d-inline"></div>';
                                        echo '<div id="PictureManagement" class="d-inline">';
                                        echo 'fichier actuel : '.$configuration->home_picture;
                                        echo '<div id="rDeletePicture" class="d-inline"><button class="btn fa-solid fa-xmark fa-xl" data-toggle="tooltip" data-placement="top" title="Supprimer"> </button></div>';
                                        echo '<input type="checkbox" id="deletePictureToggler" name="deletePicture" class="invisible">';
                                        echo '</div>';
                                        echo '</div>';
                                    }
                            ?>

                            <div class="mt-4">
                                <?= $this->Form->control('home_text',['label'=>'Personnaliser le texte d\'accueil']); ?>
                            </div>
                         

                            <div class="text-center">
                                <?= $this->Form->button(__('Enregistrer')) ?>
                                <?= $this->Form->end() ?>
                            </div>
                    </div>

            </fieldset>
           
    </div>
</div>


