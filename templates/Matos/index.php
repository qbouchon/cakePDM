<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Mato> $matos
 */
?>
<div class="container">
    <div class="matos index content">
            <?= $this->Html->link(__('New Mato'), ['action' => 'add'], ['class' => 'button float-right']) ?>
            <h3 class="text-center font-weight-bold"><?= __('Matos') ?></h3>
        <div>
            <table class="table table-bordered table-hover table-sm table-responsive">
                <thead>
                    <tr>
                                                     <th scope="col" class="text-center"><?= $this->Paginator->sort('id') ?></th>
                                                     <th scope="col" class="text-center"><?= $this->Paginator->sort('name') ?></th>
                                                     <th scope="col" class="text-center"><?= $this->Paginator->sort('type') ?></th>
                        
                        <th class="actions text-center" scope="col"><?= __('Actions') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($matos as $mato): ?>
                    <tr>
                                    
                    
                                                                                                <td class="text-center"><?= $this->Number->format($mato->id) ?></td>
                                                                                
                    
                                                                                                <td class="text-center"><?= h($mato->name) ?></td>
                                                                                
                    
                                                                                                <td class="text-center"><?= h($mato->type) ?></td>
                                                                                                    <td class="actions d-flex justify-content-center">
                            <div class="dropdown">
                                <button  class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                    <?=__('Actions') ?>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><?= $this->Html->link(__('View'), ['action' => 'view', $mato->id],['class' => 'dropdown-item']) ?></li>
                                    
                                    <li><?= $this->Html->link(__('Edit'), ['action' => 'edit', $mato->id],['class' => 'dropdown-item']) ?></li>
                                    
                                    <li><?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $mato->id], ['class' => 'dropdown-item','confirm' => __('Are you sure you want to delete # {0}?', $mato->id)]) ?></li>  
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