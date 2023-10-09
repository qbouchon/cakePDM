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
                    <div class="closingDates form content">
                        <?= $this->Form->create($closingDate) ?>
                        <fieldset>

                            <div class='d-flex justify-content-between align-items-center'>
                                <i onclick="history.back();" class="backButton fa-solid fa-left-long fa-xl"></i>
                                 <h3 class="text-center"><?= __('Ajouter des dates de fermeture') ?></h3>
                                <div></div>
                            </div>
                                                    
                            <?php
                                echo $this->Form->control('name',['label' =>'Nom']);
                                echo $this->Form->control('start_date',['label' =>'Date de début']);
                                echo $this->Form->control('end_date',['label' =>'Date de fin']);
                            ?>
                        </fieldset>
                        <div class="text-center">

                            <?= $this->Form->button(__('Ajouter')) ?>
                            <?= $this->Form->end() ?>

                        </div>
                    </div>
            </div>
        </div>
</div>

