<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Resource $resource
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <!-- <h4 class="heading"><?= __('Actions') ?></h4> -->
            <?= $this->Html->link(__('Liste des Ressources'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>   
    <div class="column-responsive column-80">
        <div class="resources view content">
            <h3 class="text-center"><?= h($resource->name) ?></h3>
            <table class="table table-bordered table-hover table-sm table-responsive">
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($resource->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Picture') ?></th>
                    <td><?= h($resource->picture) ?> <?= $this->Html->image('resources/'.$resource->picture_path) ?> </td>
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
            <div class="related">
                <h4><?= __('Related Files') ?></h4>
                <?php if (!empty($resource->files)) : ?>
                    <div class="table-responsive">
                        <table>
                            <tr>
                                <th><?= __('Id') ?></th>
                                <th><?= __('Name') ?></th>
                                <th><?= __('Resource Id') ?></th>
                                <th class="actions"><?= __('Actions') ?></th>
                            </tr>
                            <?php foreach ($resource->files as $files) : ?>
                                <tr>
                                    <td><?= h($files->id) ?></td>
                                    <td><?= h($files->name) ?></td>
                                    <td><?= h($files->resource_id) ?></td>
                                    <td class="actions">
                                        <?= $this->Html->link(__('View'), ['controller' => 'Files', 'action' => 'view', $files->id]) ?>
                                        <?= $this->Html->link(__('Edit'), ['controller' => 'Files', 'action' => 'edit', $files->id]) ?>
                                        <?= $this->Form->postLink(__('Delete'), ['controller' => 'Files', 'action' => 'delete', $files->id], ['confirm' => __('Are you sure you want to delete # {0}?', $files->id)]) ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h4><?= __('Related Reservations') ?></h4>
                <?php if (!empty($resource->reservations)) : ?>
                    <div class="table-responsive">
                        <table>
                            <tr>
                                <th><?= __('Id') ?></th>
                                <th><?= __('Start Date') ?></th>
                                <th><?= __('End Date') ?></th>
                                <th><?= __('Is Back') ?></th>
                                <th><?= __('Resource Id') ?></th>
                                <th><?= __('User Id') ?></th>
                                <th class="actions"><?= __('Actions') ?></th>
                            </tr>
                            <?php foreach ($resource->reservations as $reservations) : ?>
                                <tr>
                                    <td><?= h($reservations->id) ?></td>
                                    <td><?= h($reservations->start_date) ?></td>
                                    <td><?= h($reservations->end_date) ?></td>
                                    <td><?= h($reservations->is_back) ?></td>
                                    <td><?= h($reservations->resource_id) ?></td>
                                    <td><?= h($reservations->user_id) ?></td>
                                    <td class="actions">
                                        <?= $this->Html->link(__('View'), ['controller' => 'Reservations', 'action' => 'view', $reservations->id]) ?>
                                        <?= $this->Html->link(__('Edit'), ['controller' => 'Reservations', 'action' => 'edit', $reservations->id]) ?>
                                        <?= $this->Form->postLink(__('Delete'), ['controller' => 'Reservations', 'action' => 'delete', $reservations->id], ['confirm' => __('Are you sure you want to delete # {0}?', $reservations->id)]) ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <aside class="column">
     <div class="text-center">
        <?= $this->Html->link(__('List Resources'), ['action' => 'index'], ['class' => 'btn btn-secondary']) ?> 
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
</aside>
</div>
