<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Resource> $resources
 */

?>
<?= $this->Html->script('search'); ?>

<div class="container">
    <div class="resources index content">

        <div class="d-flex justify-content-beetwen align-items-center">

            <h3 class=" font-weight-bold mx-auto"><?= __('Ressources') ?></h3>

        </div>


        <div class="d-flex align-items-center justify-content-between mb-1">
            <div >
                <?= $this->Html->link('<i class=" text-center fas fa-plus fa-xl"></i>' , ['action'=>'add' ],[ 'class' => 'text-center  btn addButton','data-toggle'=>'tooltip', 'data-placement'=>'top', 'title'=>'Créer une ressource','escape' =>false]); ?>
            </div>
            <div>
                 <div class="input-group">                        
                        <input type="text" class="form-control border-right-0" id="searchBox" onkeyup="search()" placeholder="Rechercher">   
                         <span class="input-group-text bg-white border-left-0">
                                <i class="fa fa-search"></i>
                        </span>

                </div>
               
            </div>
        </div>



        <div>
            <table id="searchTable" class="table table-bordered table-hover table-sm  table-light table-responsive  align-middle">
                <thead>
                    <tr class="bg-white">
                       <th scope="col" class="col-4 text-center"><?= $this->Paginator->sort('name') ?></th>
                       <th scope="col" class="col-4 text-center"><?= $this->Paginator->sort('picture') ?></th>
                       <th scope="col" class="col-4 text-center"><?= $this->Paginator->sort('domain_id') ?></th>
                       <th scope="col" class="col-4 text-center"><?= $this->Paginator->sort('max_duration') ?></th>
                       <th scope="col" class="col-4 text-center"><?= $this->Paginator->sort('archive') ?></th>
                       <th scope="col" class="col-4 text-center"><?= $this->Paginator->sort('color') ?></th>
                       
                       <th class="actions text-center" scope="col"><?= __('Actions') ?></th>
                   </tr>
               </thead>
               <tbody>
                <?php 

                        foreach ($resources as $resource): 

                           

                ?>
                    <?= $resource->archive ? '<tr class = "bg-secondary bg-opacity-50 text-decoration-line-through">' :  '<tr class="bg-white">' ?>
                        

                        <td class="text-center"><b><?= h($resource->name) ?></b></td>
                        
                        
                        <td class="text-center"><?= h($resource->picture) ?></td>
                        
                        
                        <td class="text-center"><?= $resource->has('domain') ? $this->Html->link($resource->domain->name, ['controller' => 'Domains', 'action' => 'view', $resource->domain->id]) : '' ?></td>

                         <td class="text-center"><?= $resource->max_duration > 0 ?  $resource->max_duration . ' jour(s)' : 'illimitée' ?></td>
                        
                        <td class="text-center"><?= $resource->archive ? 'Oui' : 'Non' ?></td>

                        <td class="text-center"><input type="color" value="<?= $resource->color ?>" disabled></td>
                        
                        
                        <td class="actions d-flex justify-content-center">
                            <div class="dropdown">
                                <button  class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                    <?=__('Actions') ?>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><?= $this->Html->link(__('View'), ['action' => 'view', $resource->id],['class' => 'dropdown-item']) ?></li>
                                    
                                    <li><?= $this->Html->link(__('Edit'), ['action' => 'edit', $resource->id],['class' => 'dropdown-item']) ?></li>
                                    <li>
                                       <?= $resource->archive ? $this->Form->postLink(__('Désarchiver'), ['action' => 'unArchive', $resource->id],['class' => 'dropdown-item']) : $this->Form->postLink(__('Archiver'), ['action' => 'archive', $resource->id],['class' => 'dropdown-item']) ?>
                                    </li>
                                    <!-- Button trigger DeleteResourceModal -->
                                    <li>
                                        <button type="button" class="btn btn-danger text-danger dropdown-item" data-bs-toggle="modal" data-bs-target="<?= '#deleteResourceModal' . $resource->id ?>">
                                          <?= __('Supprimer'); ?>
                                        </button>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>

                    <!-- DeleteResourceModal -->
                    <div class="modal fade" id="<?= 'deleteResourceModal' . $resource->id ?>" tabindex="-1" aria-labelledby="deleteResourceModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h1 class="modal-title fs-5" id="deleteResourceModalLabel"><?= 'Suppression de la ressource ' . $resource->name ?> </h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                            Attention, si vous supprimez cette ressource, <b>toutes les réservations associées et fichiers seront définitivement supprimés.</b> Si vous souhaitez que cette ressource ne soit plus disponible mais garder les anciennes réservations et fichiers, considérez  d'utiliser l'option "archiver" à la place.
                          </div>
                          <div class="modal-footer">  
                            <?= $this->Form->postLink(__('Supprimer'), ['action' => 'delete', $resource->id], ['class' => 'btn btn-danger', 'confirm' => 'Supprimer '.$resource->name.' ?']) ?>    

                            <?php
                                if($resource->archive)
                                    echo $this->Form->postLink(__('Désarchiver'), ['action' => 'unArchive', $resource->id], ['class' => 'btn btn-warning', $resource->id]);
                                else
                                    echo $this->Form->postLink(__('Archiver'), ['action' => 'archive', $resource->id], ['class' => 'btn btn-warning', $resource->id]);
                            ?>

                           
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                          </div>
                        </div>
                      </div>
                    </div>

                <?php 
                        
                    endforeach; 

                ?>
            </tbody>
        </table>
        </div>
        <div class="paginator">
            <ul class="pagination pagination-sm d-flex justify-content-center ">        
                <?= $this->Paginator->prev('<') ?>
                <?= $this->Paginator->numbers() ?>
                <?= $this->Paginator->next('>') ?>
            </ul>
           <p class="d-flex justify-content-center"><?= $this->Paginator->counter(__('Page {{page}} sur {{pages}}, {{current}} entrée(s) affiché(s) sur un total de {{count}}')) ?></p>
        </div>


    </div>
</div>




