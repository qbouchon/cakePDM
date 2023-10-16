<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Configuration $configuration
 */
?>

<?php $this->assign('title', 'CREST - Configuration'); ?>



     <div class="row mt-2">   
        
            <h3 class="text-center font-weight-bold mb-3"><?= __('Configuration') ?></h3>

            <?= $this->Form->create($configuration, ['type' => 'file']) ?>
           
            <fieldset>

                <div class = "col-8 px-5 pt-1 pb-4 mx-auto bg-white rounded">

                        <div class='d-flex justify-content-between align-items-center'>
                            <h4 class="font-weight-bold mt-3"><?= __('Personnaliser l\'accueil') ?></h4>
                            <i class="fa-solid helpHomeEditButton fa-circle-question fa-xl mt-3"></i>
                        </div>

                        <div class='d-flex align-items-center'>
                            <?= $this->Form->control('home_picture',['type' => 'file', 'value' =>$configuration->home_picture, 'id'=>'rAddPicture', 'label' => 'Ajouter une image d\'entête (.png, .jpg, .jpeg)', 'accept' => 'image/*']); ?>

                            
                            <div id='rResetPicture' class = displaynone>
                                <button class="btn fa-solid fa-xmark fa-xl deletePictureButton"> </button>
                            </div> 
                        </div> 
                        
                        <?php
                                //Gestion de la suppression à refactorer voir global.js
                                if($configuration->home_picture)
                                {
                                        echo '<div id="PictureManagementBlock">';
                                        echo '<div id="cancelDeletePicture" class="displaynone"></div>';
                                        echo '<div id="PictureManagement" class="">';
                                        echo '<div class="d-inline d-flex align-items-center">';
                                        echo 'fichier actuel : '.$configuration->home_picture;
                                        echo '<div id="rDeletePicture" class="d-inline"><button class="btn deletePictureButton fa-solid fa-xmark fa-xl" ></button></div>';
                                        echo '<input type="checkbox" id="deletePictureToggler" name="deletePicture" class="displaynone">';
                                        echo '</div>';
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



