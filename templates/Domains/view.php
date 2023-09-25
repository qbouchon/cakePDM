<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Domain $domain
 */
?>

<div class="row mt-2">

    <div class = "col-8 px-5 pt-1 pb-4 mx-auto bg-white rounded text-center">

        <h3 class="text-center"><?= h($domain->name) ?></h3>

            <table class="table table-bordered table-hover table-sm table-responsive table-light ">
                <tr>
                    <th><?= __('Nom') ?></th>
                    <td><?= h($domain->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Image') ?></th>
                    <td><?= $this->Html->image('domains/'.$domain->picture_path,['class'=>'img-fluid','style' => 'max-width: 200px; max-height: 200px;'])   ?></td>
                </tr>
                <tr>
                    <th><?= __('Description') ?></th>
                    <td><?= $domain->description ?></td>
                </tr>
            </table>

        <div class="related">
            <h4><?= __('Resources du domaine') ?></h4>

            <?php if (!empty($domain->resources)) : ?>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-sm table-responsive table-light">
                            <tr class="bg-white">
                                <th><?= __('Nom') ?></th>
                                <th><?= __('Description') ?></th>
                                <th><?= __('Archivée') ?></th>
                                <th class="actions"><?= __('Actions') ?></th>
                            </tr>

                            <?php foreach ($domain->resources as $resource) : ?>
                                <tr class="bg-white">
                                    <td><?= h($resource->name) ?></td>
                                    <td><?= $resource->description ?></td>
                                    <td><?= $resource->archive ? 'Oui' : 'Non' ?></td>
                                    <td class="actions d-flex justify-content-center">
                                        <div class="dropdown">
                                            <button  class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                                <?=__('Actions') ?>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><?= $this->Html->link(__('View'), ['controller' => 'Resources', 'action' => 'view', $resource->id],['class' => 'dropdown-item']) ?></li>
                                                
                                                <li><?= $this->Html->link(__('Edit'), ['controller' => 'Resources', 'action' => 'edit', $resource->id],['class' => 'dropdown-item']) ?></li>
                                                <li>
                                                   <?= $resource->archive ? $this->Form->postLink(__('Désarchiver'), ['controller' => 'Resources', 'action' => 'unArchive', $resource->id],['class' => 'dropdown-item']) : $this->Form->postLink(__('Archiver'), ['controller' => 'Resources', 'action' => 'archive', $resource->id],['class' => 'dropdown-item']) ?>
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
                                                <?= $this->Form->postLink(__('Supprimer'), ['controller' => 'Resources','action' => 'delete', $resource->id], ['class' => 'btn btn-danger', 'confirm' => 'Supprimer '.$resource->name.' ?']) ?>    

                                                <?php
                                                    if($resource->archive)
                                                        echo $this->Form->postLink(__('Désarchiver'), ['controller' => 'Resources','action' => 'unArchive', $resource->id], ['class' => 'btn btn-warning', $resource->id]);
                                                    else
                                                        echo $this->Form->postLink(__('Archiver'), ['controller' => 'Resources','action' => 'archive', $resource->id], ['class' => 'btn btn-warning', $resource->id]);
                                                ?>

                                           
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            <?php endforeach; ?>
                        </table>
                    </div>
            <?php endif; ?>
        </div>

        <div class="text-center mt-3">
            <?= $this->Html->link(__('Editer'), ['action' => 'edit', $domain->id], ['class' => 'btn btn-secondary']) ?>               
            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="<?= '#deleteDomainModal'.$domain->id ?>"><?= __('Supprimer'); ?> </button>
        </div>



    </div>

    <!-- DeleteDomainModal -->
    <div class="modal fade" id="<?= 'deleteDomainModal' . $domain->id ?>" tabindex="-1" aria-labelledby="deleteDomainModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="deleteDomainModalLabel"><?= 'Suppression du domaine ' . $domain->name ?> </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?php   if($domain->resources):?>

                                En supprimant ce domaine, <b>toutes les ressources ci dessous deviendrons orphelines : </b>
                                <ul>
                                    <?php 

                                        foreach ($domain->resources as $resource)
                                        {
                                            echo '<li>'.$resource->name.'</li>';
                                        }

                                    ?>
                                </ul>
                    <?php 
                            else:
                                echo 'Voulez-vous supprimer le domaine '.  $domain->name .' ?';
                            endif;
                    ?>
                </div>
            <div class="modal-footer">  
                <?= $this->Form->postLink(__('Supprimer'), ['controller' =>'domains','action' => 'delete', $domain->id], ['class' => 'btn btn-danger', 'confirm' => 'Supprimer '.$domain->name.' ?']) ?>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
            </div>
        </div>
      </div>
    </div>
    
</div>


