<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Mato $mato
 */
?>
<div class="row">
    
    <div class="column-responsive column-80">
        <div class="matos view content">
            <h3 class="text-center"><?= h($mato->name) ?></h3>
            <table class="table table-bordered table-hover table-sm table-responsive">
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($mato->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Type') ?></th>
                    <td><?= h($mato->type) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($mato->id) ?></td>
                </tr>
            </table>
        </div>
    </div>

    <aside class="column">
       <div class="text-center">
        <?= $this->Html->link(__('List Matos'), ['action' => 'index'], ['class' => 'side-nav-item']) ?> 
        <?= $this->Html->link(__('Edit Mato'), ['action' => 'edit', $mato->id], ['class' => '']) ?> 
        <?= $this->Form->postLink(__('Delete Mato'), ['action' => 'delete', $mato->id], ['confirm' => __('Are you sure you want to delete # {0}?', $mato->id), 'class' => 'text-danger']) ?>
    </div>
</aside>
</div>
