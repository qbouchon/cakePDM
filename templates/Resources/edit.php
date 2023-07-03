<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Resource $resource
 * @var string[]|\Cake\Collection\CollectionInterface $domains
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $resource->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $resource->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Resources'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="resources form content">
            <?= $this->Form->create($resource,['type' => 'file']) ?>
            <fieldset>
                <legend><?= __('Edit Resource') ?></legend>
                <?php
                    echo $this->Form->control('name');?>

                    <div class='d-flex align-items-center'>
                        <?php echo $this->Form->control('picture',['type' => 'file', 'class'=>'d-inline', 'id'=>'rAddPicture', 'label' => 'Importer une image (.png, .jpg, .jpeg) / fichier actuel : '.$resource->picture, 'accept' => 'image/*']); ?>
                        <div id='rResetPicture' class = invisible>
                        <button class="btn fa-solid fa-xmark fa-xl"> </button>
                        </div>
                    </div>
                <?php    
                    echo $this->Form->control('description');
                    echo $this->Form->control('domain_id', ['options' => $domains, 'empty' => true]);
                    echo $this->Form->control('archive');
                ?>       
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
