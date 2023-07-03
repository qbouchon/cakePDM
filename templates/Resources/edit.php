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
                        <?php echo $this->Form->control('picture',['type' => 'file',  'class'=>'d-inline', 'id'=>'rAddPicture', 'label' => 'Importer une image (.png, .jpg, .jpeg)', 'accept' => 'image/*']); 
                        ?>
                      
                        <div id='rResetPicture' class = invisible>
                            <button class="btn fa-solid fa-xmark fa-xl"> </button>
                        </div>                       
                    </div>
                <?php
                    //Gestion de la suppression à refactorer voir global.js
                    if($resource->picture)
                    {
                        echo '<div id="PictureManagementBlock">';
                        echo '<div id="cancelDeleteFile" class="invisible d-inline"></div>';
                        echo '<div id="PictureManagement" class="d-inline">';
                        echo 'fichier actuel : '.$resource->picture;
                        echo '<div id="rDeletePicture" class="d-inline"><button class="btn fa-solid fa-xmark fa-xl"> </button></div>';
                        echo '<input type="checkbox" id="deleteFileToggler" name="deleteFile" class="invisible">';
                        echo '</div>';
                        echo '</div>';
                    }
                ?>
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
