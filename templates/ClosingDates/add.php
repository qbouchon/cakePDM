<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ClosingDate $closingDate
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Closing Dates'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="closingDates form content">
            <?= $this->Form->create($closingDate) ?>
            <fieldset>
                <legend><?= __('Add Closing Date') ?></legend>
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

