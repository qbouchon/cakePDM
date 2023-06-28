<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Reservation $reservation
 */
?>
<div class="row">
    
    <div class="column-responsive column-80">
        <div class="reservations view content">
            <h3 class="text-center"><?= h($reservation->id) ?></h3>
            <table class="table table-bordered table-hover table-sm table-responsive">
                <tr>
                    <th><?= __('User') ?></th>
                    <td><?= $reservation->has('user') ? $this->Html->link($reservation->user->id, ['controller' => 'Users', 'action' => 'view', $reservation->user->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($reservation->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Resource Id') ?></th>
                    <td><?= $this->Number->format($reservation->resource_id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Start Date') ?></th>
                    <td><?= h($reservation->start_date) ?></td>
                </tr>
                <tr>
                    <th><?= __('End Date') ?></th>
                    <td><?= h($reservation->end_date) ?></td>
                </tr>
                <tr>
                    <th><?= __('Is Back') ?></th>
                    <td><?= $reservation->is_back ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
        </div>
    </div>

    <aside class="column">
       <div class="text-center">
        <?= $this->Html->link(__('List Reservations'), ['action' => 'index'], ['class' => 'side-nav-item']) ?> 
        <?= $this->Html->link(__('Edit Reservation'), ['action' => 'edit', $reservation->id], ['class' => '']) ?> 
        <?= $this->Form->postLink(__('Delete Reservation'), ['action' => 'delete', $reservation->id], ['confirm' => __('Are you sure you want to delete # {0}?', $reservation->id), 'class' => 'text-danger']) ?>
    </div>
</aside>
</div>
