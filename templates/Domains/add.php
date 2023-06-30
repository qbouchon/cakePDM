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
            <?= $this->Html->link(__('Liste des Domaines'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="domains form content">
            <?= $this->Form->create($domain, ['type' => 'file']) ?>
            <fieldset>
                <legend><?= __('Créer un Domaine') ?></legend>
                <?php
                    echo $this->Form->control('name',['label'=>'Nom du Domaine']);                   
                    echo $this->Form->control('picture',['type' => 'file', 'label' => 'Importer une image (.png, .jpg, .jpeg)', 'accept' => 'image/*']);
                    echo $this->Form->control('description',['label'=>'Si vous souhaitez ajouter une description :']);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Créer')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>