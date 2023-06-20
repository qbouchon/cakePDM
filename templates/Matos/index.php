<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Mato> $matos
 */
?>
<div class="matos index content">
    <?= $this->Html->link(__('New Mato'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Matos') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('name') ?></th>
                    <th><?= $this->Paginator->sort('type') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($matos as $mato): ?>
                <tr>
                    <td><?= $this->Number->format($mato->id) ?></td>
                    <td><?= h($mato->name) ?></td>
                    <td><?= h($mato->type) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $mato->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $mato->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $mato->id], ['confirm' => __('Are you sure you want to delete # {0}?', $mato->id)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>
