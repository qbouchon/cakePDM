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

                 <?php echo $this->Form->control('name',['label'=>'Nom du Domaine']); ?> 
                <div class='d-flex align-items-center'>
                    <?php 
                        echo $this->Form->control('picture',['type' => 'file', 'id'=>'rAddPicture', 'label' => 'Importer une image (.png, .jpg, .jpeg) / fichier actuel : '.$domain->picture, 'accept' => 'image/*'])                     
                    ?>
                    <div id='rResetPicture' class = invisible>
                            <button class="btn fa-solid fa-xmark fa-xl"> </button>
                    </div>                   
                </div>
                    <?php echo $this->Form->control('description',['label'=>'Si vous souhaitez ajouter une description :']); 
                    ?>

            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
