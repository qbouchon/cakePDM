<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ClosingDate $closingDate
 */
?>
<div class="row">
    
    <div class="column-responsive column-80">
        <div class="closingDates view content">
            <h3 class="text-center"><?= h($closingDate->name) ?></h3>
            <table class="table table-bordered table-hover table-sm table-responsive">
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($closingDate->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($closingDate->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Start Date') ?></th>
                    <td><?= h($closingDate->start_date) ?></td>
                </tr>
                <tr>
                    <th><?= __('End Date') ?></th>
                    <td><?= h($closingDate->end_date) ?></td>
                </tr>
            </table>
        </div>
    </div>

    <aside class="column">
       <div class="text-center">
        <?= $this->Html->link(__('List Closing Dates'), ['action' => 'index'], ['class' => 'side-nav-item']) ?> 
        <?= $this->Html->link(__('Edit Closing Date'), ['action' => 'edit', $closingDate->id], ['class' => '']) ?> 
        <?= $this->Form->postLink(__('Delete Closing Date'), ['action' => 'delete', $closingDate->id], ['confirm' => __('Are you sure you want to delete # {0}?', $closingDate->id), 'class' => 'text-danger']) ?>
    </div>
</aside>
</div>
