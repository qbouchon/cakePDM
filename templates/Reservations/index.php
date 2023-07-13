<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Reservation> $reservations
 */
?>
<div class="container">
    <div class="reservations index content">
        <?= $this->Html->link(__('New Reservation'), ['action' => 'add'], ['class' => 'button float-right']) ?>
        <h3 class="text-center font-weight-bold"><?= __('Reservations') ?></h3>
        <div>
            <table class="table table-bordered table-hover table-sm table-responsive table-light">
                <thead>
                    <tr>
                       <th scope="col" class="text-center"><?= $this->Paginator->sort('id') ?></th>
                       <th scope="col" class="text-center"><?= $this->Paginator->sort('start_date') ?></th>
                       <th scope="col" class="text-center"><?= $this->Paginator->sort('end_date') ?></th>
                       <th scope="col" class="text-center"><?= $this->Paginator->sort('is_back') ?></th>
                       <th scope="col" class="text-center"><?= $this->Paginator->sort('resource_id') ?></th>
                       <th scope="col" class="text-center"><?= $this->Paginator->sort('user_id') ?></th>
                       
                       <th class="actions text-center" scope="col"><?= __('Actions') ?></th>
                   </tr>
               </thead>
               <tbody>
                <?php foreach ($reservations as $reservation): ?>
                    <tr>
                        
                        
                        <td class="text-center"><?= $this->Number->format($reservation->id) ?></td>
                        
                        
                        <td class="text-center"><?= h($reservation->start_date) ?></td>
                        
                        
                        <td class="text-center"><?= h($reservation->end_date) ?></td>
                        
                        
                        <td class="text-center"><?= h($reservation->is_back) ?></td>
                        
                        
                        <td class="text-center"><?= $reservation->has('resource') ? $this->Html->link($reservation->resource->name, ['controller' => 'Resources', 'action' => 'view', $reservation->resource->id]) : '' ?></td>
                        
                        
                        
                        <td class="text-center"><?= $reservation->has('user') ? $this->Html->link($reservation->user->id, ['controller' => 'Users', 'action' => 'view', $reservation->user->id]) : '' ?></td>
                        
                        <td class="actions d-flex justify-content-center">
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