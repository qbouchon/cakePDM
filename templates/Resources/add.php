<?php
    $this->Breadcrumbs->add(
    'resources',
    ['controller' => 'resources', 'action' => 'index']
);
?>


<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Resource $resource
 * @var \Cake\Collection\CollectionInterface|string[] $domains
 */

?>
<div class="container">                
                        <div class="row mt-2">

                            <?= $this->Form->create($resource,['type' => 'file']) ?>

                            <fieldset>

                                    <div class = "col-8 px-5 pt-1 pb-4 mx-auto bg-white rounded"> 

                                       

                                      <h3 class="text-center"><?= __('Créer une Ressource') ?></h3>  

                                                <?=  $this->Form->control('name'); ?>

                                                <?= $this->Form->control('domain_id', ['options' => $domains, 'empty' => true, 'label' => 'Domaine']); ?>

                                                <div class='d-flex align-items-center'>
                                                    <?php echo $this->Form->control('picture',['type' => 'file', 'class'=>'d-inline', 'id'=>'rAddPicture', 'label' => 'Importer une image (.png, .jpg, .jpeg)', 'accept' => 'image/*']); ?>
                                                    <div id="rResetPicture" class = "invisible">
                                                       <button class="btn fa-solid fa-xmark fa-xl" data-toggle="tooltip" data-placement="top" title="Supprimer"> </button>
                                                   </div>
                                                </div>

                                                 <?= $this->Form->control('description'); ?>

                                                 <?= $this->Form->control('archive'); ?>
                                                 

                                                 <div class="d-flex align-items-center">
                                                     <?= $this->Form->control('files[]', ['type' => 'file', 'id'=>'File', 'class'=>'iFile d-inline', 'label' => 'Importer un fichier (image, pdf, document office, openoffice, libreoffice)', 'accept' => '*']) ?>  

                                                        <div id="rFile" class ="rResetFile invisible" data-toggle="File">
                                                            <button class="btn fa-solid fa-xmark fa-xl" data-toggle="tooltip" data-placement="top" title="Supprimer"> </button>
                                                        </div>
                                                 </div>

                                                <div  id="inputFileDiv" class="">                           
                                                </div>
                                                       
                                                <button id="addFileInput" class="btn addButton fa-solid fa-plus fa-2xl" data-toggle="tooltip" data-placement="top" title='Ajouter un autre fichier'> </button> 
                                                  
                                                <div class="text-center">
                                                    <?= $this->Form->button(__('Créer')) ?>
                                                    <?= $this->Form->end() ?>
                                                </div>         
                                    </div>

                            </fieldset>
                        
                        </div>
                                                                           
</div>

