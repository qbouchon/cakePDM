<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\File> $files
 */
?>
<div class="container">
    <div class="files index content">
            <?= $this->Html->link(__('New File'), ['action' => 'add'], ['class' => 'button float-right']) ?>
            <h3 class="text-center font-weight-bold"><?= __('Files') ?></h3>
        <div>
            <table class="table table-bordered table-hover table-sm table-responsive">
                <thead>
                    <tr>
                                                     <th scope="col" class="text-center"><?= $this->Paginator->sort('id') ?></th>
                                                     <th scope="col" class="text-center"><?= $this->Paginator->sort('name') ?></th>
                                                     <th scope="col" class="text-center"><?= $this->Paginator->sort('resource_id') ?></th>
                        
                        <th class="actions text-center" scope="col"><?= __('Actions') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($files as $file): ?>
                    <tr>
                                    
                                                                                                                    
                                                                                                <td class="text-center"><?= $this->Number->format($file->id) ?></td>
                                                                                
                                                                                                                    
                                                                                                <td class="text-center"><?= h($file->name) ?></td>
                                                                                
                                                                                                        
                                <td class="text-center"><?= $file->has('resource') ? $this->Html->link($file->resource->name, ['controller' => 'Resources', 'action' => 'view', $file->resource->id]) : '' ?></td>
                                                                        
                                                                            <td class="actions d-flex justify-content-center">
                            <div class="dropdown">
                                <button  class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                    <?=__('Actions') ?>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><?= $this->Html->link(__('View'), ['action' => 'view', $file->id],['class' => 'dropdown-item']) ?></li>
                                    
                                    <li><?= $this->Html->link(__('Edit'), ['action' => 'edit', $file->id],['class' => 'dropdown-item']) ?></li>
                                    
                                    <li><?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $file->id], ['class' => 'dropdown-item','confirm' => __('Are you sure you want to delete # {0}?', $file->id)]) ?></li>  
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