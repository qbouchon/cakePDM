<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ClosingDate $closingDate
 */
?>
<div class="container">   

        <div class="row mt-2">
            <div class = "col-8 px-5 pt-1 pb-4 mx-auto bg-white rounded">
                    <div class="closingDates form content">
                        <?= $this->Form->create($closingDate) ?>
                        <fieldset>
                            <h3 class="text-center"><?= __('Ajouter des dates de fermeture') ?></h3>
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

