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

<?php $this->assign('title', 'CREST - Ressources'); ?>

<div class="container">                
        <div class="row mt-2">

            <?= $this->Form->create($resource,['type' => 'file']) ?>

            <fieldset>

                <div class = "col-8 px-5 pt-1 pb-4 mx-auto bg-white rounded"> 

                    <div class='d-flex justify-content-between align-items-center'>
                        <i onclick="history.back();" class="backButton fa-solid fa-left-long fa-xl"></i>
                        <h3 class="text-center"><?= __('Créer une Ressource')?></h3>  
                        <div></div>
                    </div>

                    <?= $this->Form->control('name', ['label' => 'Nom']); ?>
                    <?= $this->Form->control('domain_id', ['options' => $domains, 'empty' => true, 'label' => 'Domaine']); ?>

                    <?= $this->Form->label('Nombre d\'exemplaires :'); ?>
                    <div class='col-2 mt-2'>
                        <?= $this->Form->control('quantity', ['label' => false]); ?>
                    </div>

                    <!-- Gestion de l'upload d'image -->
                    <div class='d-flex align-items-center'>
                        <?php echo $this->Form->control('picture',['type' => 'file', 'class'=>'d-inline', 'id'=>'rAddPicture', 'label' => 'Importer une image (.png, .jpg, .jpeg)', 'accept' => 'image/*']); ?>
                        <div id="rResetPicture" class = "displaynone">
                           <button class="btn deletePictureButton fa-solid fa-xmark fa-xl"> </button>
                       </div>
                    </div>

                     <?= $this->Form->control('description'); ?>

                    <div class="row d-flex align-items-center">
                            <?= $this->Form->label('Durée de réservation maximale (1 semaine = 7 jours)'); ?>
                            <div class='col-2 mt-2'>
                                <?= $this->Form->control('max_duration',['label'=>false, 'class' => 'form-control w-75']); ?>
                            </div>
                            <div class='col-2 pb-1'>
                                <i>jour(s)</i>
                            </div>
                    </div>
                    
                    <!-- $this->Form->control('color',['type'=>'color', 'value' => '#3788d8', 'label'=>'Couleur de la ressource pour l\'affichage dans le calendrier']); -->
                    <?= $this->Form->control('archive', ['label' => 'Archiver cette ressource (ne sera pas réservable)']); ?>
                     
                    <!-- Gestion de l'upload de fichiers -->
                    <div class="d-flex align-items-center">
                         <?= $this->Form->control('files[]', ['type' => 'file', 'id'=>'File', 'class'=>'iFile d-inline', 'label' => 'Importer un fichier (image, pdf, document office, openoffice, libreoffice)', 'accept' => '*']) ?>  

                            <div id="rFile" class ="rResetFile displaynone" data-toggle="File">
                                <i class="btn deleteFileButton fa-solid fa-xmark fa-xl"> </i>
                            </div>
                    </div>

                    <div  id="inputFileDiv" class="">                           
                    </div>
                    
                    <div class="d-flex justify-content-center mb-3"> 
                        <i id="addFileInput" class="addButton addFileButton fa-solid fa-plus fa-xl" ></i> 
                    </div>
                      
                    <div class="text-center">
                        <?= $this->Form->button(__('Créer')) ?>
                        <?= $this->Form->end() ?>
                    </div> 

                </div>

            </fieldset>
        
        </div>
                                                                           
</div>

