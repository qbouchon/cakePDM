<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Resource $resource
 * @var \Cake\Collection\CollectionInterface|string[] $domains
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Resources'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="resources form content">
            <?= $this->Form->create($resource,['type' => 'file']) ?>
            <fieldset>
                <legend><?= __('Add Resource') ?></legend>
                <?php
                    echo $this->Form->control('name');?>

                    <div class='d-flex align-items-center'>
                        <?php echo $this->Form->control('picture',['type' => 'file', 'class'=>'d-inline', 'id'=>'rAddPicture', 'label' => 'Importer une image (.png, .jpg, .jpeg)', 'accept' => 'image/*']); ?>
                        <div id="rResetPicture" class = "invisible">
                             <button class="btn fa-solid fa-xmark fa-xl" data-toggle="tooltip" data-placement="top" title="Supprimer"> </button>
                        </div>
                    </div>
                <?php    
                    echo $this->Form->control('description');
                    echo $this->Form->control('domain_id', ['options' => $domains, 'empty' => true]);
                    echo $this->Form->control('archive');
                ?>
                <div class="d-flex align-items-center">
                    <?php
                        echo $this->Form->control('files[]', ['type' => 'file', 'id'=>'File', 'class'=>'iFile d-inline', 'label' => 'Importer un fichier (image, pdf, document office, openoffice, libreoffice)', 'accept' => '*'])
                    ?>  
                    <div id="rFile" class ="rResetFile invisible" data-toggle="File">
                        <button class="btn fa-solid fa-xmark fa-xl" data-toggle="tooltip" data-placement="top" title="Supprimer"> </button>
                    </div>
                </div>

                <div  id="inputFileDiv" class=""></div>
                <div class="d-flex justify-content-center">    
                    <button id="addFileInput" class="btn fa-solid fa-plus fa-2xl" data-toggle="tooltip" data-placement="top" title='Ajouter un autre fichier'> </button> 
                </div>                
                    
                
            </fieldset>
            <?= $this->Form->button(__('Créer')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>

