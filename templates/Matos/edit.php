<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Mato $mato
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $mato->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $mato->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Matos'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="matos form content">
            <?= $this->Form->create($mato) ?>
            <fieldset>
                <legend><?= __('Edit Mato') ?></legend>
                <?php
                    echo $this->Form->control('name');
                    echo $this->Form->control('type');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
