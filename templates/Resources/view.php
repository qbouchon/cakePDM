<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Resource $resource
 */
?>
<div class="container">

        <div class="row mt-2">

                <div class = "col-8 px-5 pt-1 pb-4 mx-auto bg-white rounded text-center">

                                    <h3 class="text-center"><?= h($resource->name) ?></h3>
                                    <table class="table table-bordered table-hover table-sm table-responsive table-light ">
                                        <tr>
                                            <th><?= __('Name') ?></th>
                                            <td><?= h($resource->name) ?></td>
                                        </tr>
                                        <tr>
                                            <th><?= __('Picture') ?></th>
                                            <td><?= $this->Html->image('resources/'.$resource->picture_path,['class'=>'img-fluid']) ?> </td>
                                        </tr>
                                        <tr>
                                            <th><?= __('Domain') ?></th>
                                            <td><?= $resource->has('domain') ? $this->Html->link($resource->domain->name, ['controller' => 'Domains', 'action' => 'view', $resource->domain->id]) : '' ?></td>
                                        </tr>
                                        <tr>
                                            <th><?= __('Id') ?></th>
                                            <td><?= $this->Number->format($resource->id) ?></td>
                                        </tr>
                                        <tr>
                                            <th><?= __('Durée de réservation max') ?></th>
                                            <td><?= $resource->max_duration > 0 ? $resource->max_duration . " jour(s)" : "Illimitée"?></td>
                                        </tr>
                                        <tr>
                                            <th><?= __('Archive') ?></th>
                                            <td><?= $resource->archive ? __('Yes') : __('No'); ?></td>
                                        </tr>
                                    </table>
                                    <div class="text">
                                        <strong><?= __('Description') ?></strong>
                                        <blockquote>
                                            <div id="description">
                                               <?= $resource->description ?>
                                            </div>
                                        </blockquote>
                                    </div>
                                    <div class="related  text-start">
                                        <h4 class="text-center"><?= __('Fichiers associés') ?></h4>
                                        <?php if (!empty($resource->files)) : ?>

                                                <ul>
                                                    <?php foreach ($resource->files as $files) : ?>
                                                      <li> <?= $this->Html->link($files->name,[ 'controller' => 'Files','action' => 'download',$files->id, ],['target' => '_blank']) ?>
                                                       <?= $this->Form->postLink(__('Delete'), ['controller' => 'Files', 'action' => 'delete', $files->id], ["class"=>"text-danger",'confirm' => __('Are you sure you want to delete # {0}?', $files->id)]) ?>
                                                      </li>
                                                    <?php endforeach; ?>
                                                </ul>
                                            
                                        <?php endif; ?>
                                    </div>
                                    <div class="related">
                                        <h4><?= __('Réservations en cours') ?></h4>
                                        <?php if (!empty($resource->reservations)) : ?>
    
                                                <table class="table table-bordered table-hover table-sm table-responsive table-light">
                                                    <tr>
                                                        <th><?= __('Date de début') ?></th>
                                                        <th><?= __('Date de fin') ?></th>
                                                        <th><?= __('Utilisateur') ?></th>
                                                        <th class="actions"><?= __('Actions') ?></th>
                                                    </tr>
                                                    <?php foreach ($resource->reservations as $reservations) : 
                                                            if(!$reservations->is_back) :

                                                    ?>
                                                        <tr>
                                                            <td><?= h($reservations->start_date) ?></td>
                                                            <td><?= h($reservations->end_date) ?></td>
                                                            <td><?= h($reservations->user->firstname).' '.h($reservations->user->lastname).' ('.h($reservations->user->username).')' ?></td>
                                                            <td class="actions">
                                                                <?= $this->Html->link(__('View'), ['controller' => 'Reservations', 'action' => 'view', $reservations->id]) ?>
                                                            </td>
                                                        </tr>
                                                    <?php 
                                                            endif;
                                                        endforeach; 
                                                    ?>
                                                </table>

                                        <?php endif; ?>
                                    </div>
                              
                           

                            
                             <div class="text-center mt-3">
                                <?= $this->Html->link(__('Liste Resources'), ['action' => 'index'], ['class' => 'btn btn-secondary']) ?> 
                                <?= $this->Html->link(__('Edit Resource'), ['action' => 'edit', $resource->id], ['class' => 'btn btn-secondary']) ?> 
                                <?php 
                                    if($resource->archive) :
                                        echo $this->Form->postLink(__('Désarchiver'), ['action' => 'unArchive', $resource->id], ['class' => 'btn btn-warning', $resource->id]); 
                                    else :
                                        echo $this->Form->postLink(__('Archiver'), ['action' => 'archive', $resource->id], ['class' => 'btn btn-warning', $resource->id]); 
                                    endif;
                                ?>

                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="<?= '#deleteResourceModal' ?>"><?= __('Supprimer'); ?> 
                                </button>
                            </div>

                                    <!-- DeleteResourceModal -->
                                    <div class="modal fade" id="<?= 'deleteResourceModal' ?>" tabindex="-1" aria-labelledby="deleteResourceModalLabel" aria-hidden="true">
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
                                                    <?= $this->Form->postLink(__('Archiver'), ['action' => 'archive', $resource->id], ['class' => 'btn btn-warning', $resource->id]) ?>

                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                </div>                    
        </div>
</div>
