<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Domain $domain
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            
            <?= $this->Html->link(__('Liste des Domaines'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="domains form content">
            <?= $this->Form->create($domain, ['type' => 'file']) ?>
            <fieldset>
                <h3 class="text-center"><?= $domain->name." <i>(édition)</i>" ?></h3>

                <?php echo $this->Form->control('name',['label'=>'Nom du Domaine']); ?> 
                <div class='d-flex align-items-center'>
                    <?php 
                    echo $this->Form->control('picture',['type' => 'file', 'value' =>$domain->picture, 'id'=>'rAddPicture', 'label' => 'Importer une image (.png, .jpg, .jpeg)', 'accept' => 'image/*'])                     
                    ?>

                    <div id='rResetPicture' class = invisible>
                        <button class="btn fa-solid fa-xmark fa-xl"> </button>
                    </div> 
                </div>
                <?php
                //Gestion de la suppression à refactorer voir global.js
                if($domain->picture)
                {
                    echo '<div id="PictureManagementBlock">';
                    echo '<div id="cancelDeletePicture" class="invisible d-inline"></div>';
                    echo '<div id="PictureManagement" class="d-inline">';
                    echo 'fichier actuel : '.$domain->picture;
                    echo '<div id="rDeletePicture" class="d-inline"><button class="btn fa-solid fa-xmark fa-xl" data-toggle="tooltip" data-placement="top" title="Supprimer"> </button></div>';
                    echo '<input type="checkbox" id="deletePictureToggler" name="deletePicture" class="invisible">';
                    echo '</div>';
                    echo '</div>';
                }
                ?>

                
                <?php echo $this->Form->control('description',['label'=>'Si vous souhaitez ajouter une description :']); 
                ?>

            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
