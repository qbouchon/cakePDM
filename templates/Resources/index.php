<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Resource> $resources
 */
?>
<div class="container">
    <div class="resources index content">
            <?= $this->Html->link(__('New Resource'), ['action' => 'add'], ['class' => 'button float-right']) ?>
            <h3 class="text-center font-weight-bold"><?= __('Resources') ?></h3>
        <div>
            <table class="table table-bordered table-hover table-sm table-responsive">
                <thead>
                    <tr>
                                                     <th scope="col" class="text-center"><?= $this->Paginator->sort('id') ?></th>
                                                     <th scope="col" class="text-center"><?= $this->Paginator->sort('name') ?></th>
                                                     <th scope="col" class="text-center"><?= $this->Paginator->sort('picture') ?></th>
                                                     <th scope="col" class="text-center"><?= $this->Paginator->sort('domain_id') ?></th>
                                                     <th scope="col" class="text-center"><?= $this->Paginator->sort('archive') ?></th>
                        
                        <th class="actions text-center" scope="col"><?= __('Actions') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($resources as $resource): ?>
                    <tr>
                                    
                                                                                                                    
                                                                                                <td class="text-center"><?= $this->Number->format($resource->id) ?></td>
                                                                                
                                                                                                                    
                                                                                                <td class="text-center"><?= h($resource->name) ?></td>
                                                                                
                                                                                                                    
                                                                                                <td class="text-center"><?= h($resource->picture) ?></td>
                                                                                
                                                                                                        
                                <td class="text-center"><?= $resource->has('domain') ? $this->Html->link($resource->domain->name, ['controller' => 'Domains', 'action' => 'view', $resource->domain->id]) : '' ?></td>
                                                                        
                                                        
                                                                                                                    
                                                                                                <td class="text-center"><?= h($resource->archive) ?></td>
                                                                                                    <td class="actions d-flex justify-content-center">
                            <div class="dropdown">
                                <button  class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                    <?=__('Actions') ?>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><?= $this->Html->link(__('View'), ['action' => 'view', $resource->id],['class' => 'dropdown-item']) ?></li>
                                    
                                    <li><?= $this->Html->link(__('Edit'), ['action' => 'edit', $resource->id],['class' => 'dropdown-item']) ?></li>
                                    
                                    <li><?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $resource->id], ['class' => 'dropdown-item','confirm' => __('Are you sure you want to delete # {0}?', $resource->id)]) ?></li>  
                                </ul>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="paginator  ">
                <ul class="pagination pagination-sm d-flex justify-content-center ">        
                                        <?= $this->Paginator->prev('<') ?>
                    <?= $this->Paginator->numbers() ?>
                    <?= $this->Paginator->next('>') ?>
                                    </ul>
                <p class="d-flex justify-content-center"><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
        </div>
    </div>
</div>