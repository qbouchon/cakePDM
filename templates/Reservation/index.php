<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Reservation> $reservation
 */
?>
<div class="container">
    <div class="reservation index content">
            <?= $this->Html->link(__('New Reservation'), ['action' => 'add'], ['class' => 'button float-right']) ?>
            <h3 align="center"><?= __('Reservation') ?></h3>
        <div class="">
            <table class="table table-bordered table-hover table-sm table-responsive">
                <thead>
                    <tr>
                                                     <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                                                     <th scope="col"><?= $this->Paginator->sort('start_date') ?></th>
                                                     <th scope="col"><?= $this->Paginator->sort('end_date') ?></th>
                                                     <th scope="col"><?= $this->Paginator->sort('id_matos') ?></th>
                                                     <th scope="col"><?= $this->Paginator->sort('id_users') ?></th>
                        
                        <th class="actions" scope="col"><?= __('Actions') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($reservation as $reservation): ?>
                    <tr>
                                    
                    
                                                                                                <td><?= $this->Number->format($reservation->id) ?></td>
                                                                                
                    
                                                                                                <td><?= h($reservation->start_date) ?></td>
                                                                                
                    
                                                                                                <td><?= h($reservation->end_date) ?></td>
                                                                                
                    
                                                                                                <td><?= $this->Number->format($reservation->id_matos) ?></td>
                                                                                
                    
                                                                                                <td><?= $this->Number->format($reservation->id_users) ?></td>
                                                                                                    <td class="actions">
                            <div class="dropdown">
                                <button  class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                    <?=__('Actions') ?>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><?= $this->Html->link(__('View'), ['action' => 'view', $reservation->id],['class' => 'dropdown-item']) ?></li>
                                    
                                    <li><?= $this->Html->link(__('Edit'), ['action' => 'edit', $reservation->id],['class' => 'dropdown-item']) ?></li>
                                    
                                    <li><?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $reservation->id], ['class' => 'dropdown-item','confirm' => __('Are you sure you want to delete # {0}?', $reservation->id)]) ?></li>  
                                </ul>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="paginator" align="center">
            <ul class="pagination" align="center"> 
                <?php var_dump($this->Paginator->first()) ?>
                <?= $this->Paginator->first('<< ' . __('first')) ?>
                <?= $this->Paginator->prev('< ' . __('previous')) ?>
                <?= $this->Paginator->numbers() ?>
                <?= $this->Paginator->next(__('next') . ' >') ?>
                <?= $this->Paginator->last(__('last') . ' >>') ?>
            </ul>
            <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
        </div>
    </div>
</div>