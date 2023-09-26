<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ClosingDate $closingDate
 */
?>

<?php $this->assign('title', 'CREST - Dates de fermetures'); ?>

<div class="container">   

        <div class="row mt-2">
                <div class = "col-8 px-5 pt-1 pb-4 mx-auto bg-white rounded">  
                    <?= $this->Form->create($closingDate) ?>

                    <fieldset>
                        <h3 class="text-center"><?= __('Modifier une plage de dates de fermeture') ?></h3>
                        
                        <?php
                            echo $this->Form->control('name',['label' => 'Nom']);
                            echo $this->Form->control('start_date',['label' =>'Date de début']);
                            echo $this->Form->control('end_date',['label' =>'Date de fin']);
                        ?>
                    </fieldset>
                    <div class="text-center">
                        <?= $this->Form->button(__('Modifier')) ?>
                        <?= $this->Form->end() ?>
                    </div>
                </div>
        </div>
</div>
