<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Domain $domain
 */
?>

<?php $this->assign('title', 'CREST - Domaines'); ?>

<div class="container">   

    <div class="row mt-2">

        <?= $this->Form->create($domain, ['type' => 'file']) ?>
      
        <div class = "col-8 px-5 pt-1 pb-4 mx-auto bg-white rounded">  

            <fieldset>  

                <div class='d-flex justify-content-between align-items-center'>
                    <i onclick="history.back();" class="backButton fa-solid fa-left-long fa-xl"></i>
                    <h3 class="text-center"><?= $domain->name." <i>(édition)</i>" ?></h3>
                    <div></div>
                </div>
                
                

                <?= $this->Form->control('name',['label'=>'Nom du Domaine']); ?> 
                
                <div class='d-flex align-items-center'>
                    <?= $this->Form->control('picture',['type' => 'file', 'value' =>$domain->picture, 'id'=>'rAddPicture', 'label' => 'Importer une image (.png, .jpg, .jpeg)', 'accept' => 'image/*']); ?>

                    <div id='rResetPicture' class = displaynone>
                        <button class="btn fa-solid fa-xmark fa-xl deletePictureButton"> </button>
                    </div> 
                </div>

                <?php
                        //Gestion de la suppression à refactorer voir global.js
                        if($domain->picture)
                        {
                            echo '<div id="PictureManagementBlock">';
                            echo '<div id="cancelDeletePicture" class="displaynone"></div>';
                            echo '<div id="PictureManagement" class="">';
                            echo '<div class="d-inline d-flex align-items-center">';
                            echo 'fichier actuel : '.$domain->picture;
                            echo '<div id="rDeletePicture" class="d-inline"><button class="btn deletePictureButton fa-solid fa-xmark fa-xl" ></button></div>';
                            echo '<input type="checkbox" id="deletePictureToggler" name="deletePicture" class="displaynone">';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                        }
                ?>

                
                <?= $this->Form->control('description',['label'=>'Si vous souhaitez ajouter une description :']); ?>
 
                <div class="text-center">
                    <?= $this->Form->button(__('Submit')) ?>
                    <?= $this->Form->end() ?>
                </div>

            </fieldset>
            
        </div>
       
    </div>
</div>    
