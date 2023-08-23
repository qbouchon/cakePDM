<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Resource> $resources
 */

?>

<?= $this->Html->script('resources'); ?>

<div class="container">
    <div class="resources index content">

        <div class="d-flex justify-content-beetwen align-items-center">

            <h3 class=" font-weight-bold mx-auto"><?= __('Ressources') ?></h3>

        </div>

        <?= $this->Html->link('<i class=" text-center fas fa-plus fa-xl"></i>' , ['action'=>'add' ],[ 'class' => 'text-center  btn addButton','data-toggle'=>'tooltip', 'data-placement'=>'top', 'title'=>'Créer une ressource','escape' =>false]); ?>
        


         <!-- Resources non archivées  -->


        <div>
            <table id="unArchivedResources" class="table table-bordered table-hover table-sm  table-light table-responsive  align-middle">
                <thead>
                    <tr class="bg-white">
                       <th>Nom</th>
                       <th>Image</th>
                       <th> Domaine</th>
                       <th> Archive</th>
                       
                       <th class="actions text-center" scope="col"><?= __('Actions') ?></th>
                   </tr>
               </thead>
               <tbody>
                    <?php 

                            foreach ($unArchivedResources as $resource): 

                               

                    ?>
                        <?= $resource->archive ? '<tr class = "bg-secondary bg-opacity-50 text-decoration-line-through">' :  '<tr class="bg-white">' ?>
                            

                            <td class="text-center"><?= h($resource->name) ?></td>
                            
                            
                            <td class="text-center"><?= h($resource->picture) ?></td>
                            
                            
                            <td class="text-center"><?= $resource->has('domain') ? $this->Html->link($resource->domain->name, ['controller' => 'Domains', 'action' => 'view', $resource->domain->id]) : '' ?></td>
                            
                            <td class="text-center"><?= $resource->archive ? 'Oui' : 'Non' ?></td>
                            
                            
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

            <!-- Resources archivées  -->

        
        <div class="d-flex justify-content-beetwen align-items-center">

            <h3 class=" font-weight-bold mx-auto"><?= __('Ressources archivées') ?></h3>

        </div>

        <div>
            <table id="archivedResources" class="table table-bordered table-hover table-sm  table-light table-responsive  align-middle">
                <thead>
                    <tr class="bg-secondary bg-opacity-50">
                       <th>Nom</th>
                       <th>Image</th>
                       <th> Domaine</th>
                       <th> Archive</th>
                       
                       <th class="actions text-center" scope="col"><?= __('Actions') ?></th>
                   </tr>
               </thead>
               <tbody>
                <?php 

                        foreach ($archivedResources as $resource): 

                           

                ?>
                    <tr class="bg-secondary bg-opacity-50">
                        

                        <td class="text-center"><?= h($resource->name) ?></td>
                        
                        
                        <td class="text-center"><?= h($resource->picture) ?></td>
                        
                        
                        <td class="text-center"><?= $resource->has('domain') ? $this->Html->link($resource->domain->name, ['controller' => 'Domains', 'action' => 'view', $resource->domain->id]) : '' ?></td>
                        
                        <td class="text-center"><?= $resource->archive ? 'Oui' : 'Non' ?></td>
                        
                        
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


    </div>
</div>




