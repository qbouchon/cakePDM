<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Domain $domain
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $domain->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $domain->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Domains'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="domains form content">
            <?= $this->Form->create($domain, ['type' => 'file']) ?>
            <fieldset>
                <legend><?= __('Edit Domain') ?></legend>
                <?php
                    echo $this->Form->control('name');
                    echo $this->Form->control('picture',['type' => 'file', 'label' => 'Importer une image (.png, .jpg, .jpeg) / Fichier actuel : '.$domain->picture, 'accept' => 'image/*']);
                    echo $this->Form->control('description',['label'=>'Description :']);
                ?>

            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
