<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Mato $mato
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Mato'), ['action' => 'edit', $mato->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Mato'), ['action' => 'delete', $mato->id], ['confirm' => __('Are you sure you want to delete # {0}?', $mato->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Matos'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Mato'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="matos view content">
            <h3><?= h($mato->name) ?></h3>
            <table>
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
</div>
