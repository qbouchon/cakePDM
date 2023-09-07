<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ClosingDate $closingDate
 */
?>
<div class="row">

        <div class="closingDates form content">
            <?= $this->Form->create($closingDate) ?>
            <fieldset>
                <legend><?= __('Edit Closing Date') ?></legend>
                <?php
                    echo $this->Form->control('name');
                    echo $this->Form->control('start_date');
                    echo $this->Form->control('end_date');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
