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

        <fieldset>
        
            <div class = "col-8 px-5 pt-1 pb-4 mx-auto bg-white rounded">

                <div class='d-flex justify-content-between align-items-center'>
                    <i onclick="history.back();" class="backButton fa-solid fa-left-long fa-xl"></i>
                    <h3 class="text-center"><?= __('Créer un Domaine') ?></h3>
                    <div></div>
                </div>

                

                <?php echo $this->Form->control('name',['label'=>'Nom du Domaine']); ?> 


                <div class='d-flex align-items-center'>
                    <?php 
                        echo $this->Form->control('picture',['type' => 'file', 'id'=>'rAddPicture', 'label' => 'Importer une image (.png, .jpg, .jpeg)', 'accept' => 'image/*'])                     
                    ?>
                    <div id="rResetPicture" class ="displaynone">
                        <button class="btn deletePictureButton fa-solid fa-xmark fa-xl"> </button>
                    </div>                   
                </div>

                <?php echo $this->Form->control('description',['label'=>'Si vous souhaitez ajouter une description :']); ?>

                <div class="text-center">
                    <?= $this->Form->button(__('Créer')) ?>
                    <?= $this->Form->end() ?>
                </div>

            </div>

        </fieldset>

    </div>

</div>