<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Configuration $configuration
 */
?>

<?php $this->assign('title', 'CREST - Configuration'); ?>


<div class="container">   

    <div class="row mt-2">   
 
        <h3 class="text-center font-weight-bold mb-3"><?= __('Configuration') ?></h3>

        <?= $this->Form->create($configuration, ['type' => 'file']) ?>
       
        <fieldset>

            <div class = "col-8 px-5 pt-1 pb-4 mx-auto bg-white rounded">

                <div class='d-flex justify-content-between align-items-center'>
                        <h4 class="font-weight-bold mt-3"><?= __('Personnaliser le mail de relance') ?></h4>
                        <i class="fa-solid helpMailButton fa-circle-question fa-xl mt-3"></i>
                </div>  

                <div class="mt-1">
                    <?= $this->Form->control('reminder_mail_object',['label'=>'Objet du mail']); ?>
                </div>

                <div class="mt-4">
                    <?= $this->Form->control('reminder_mail_text',['label'=>false]); ?>
                </div>
                
                <div class="text-center">
                    <?= $this->Form->button(__('Enregistrer')) ?>
                    <?= $this->Form->end() ?>
                </div>

            </div>

        </fieldset>
           
    </div>
</div>


