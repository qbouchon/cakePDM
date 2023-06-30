<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Domain $domain
 */
?>
<div class="row">
    
    <div class="column-responsive column-80">
        <div class="domains view content">
            <h3 class="text-center"><?= h($domain->name) ?></h3>
            <table class="table table-bordered table-hover table-sm table-responsive">
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($domain->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Picture') ?></th>
                    <td><?= h($domain->picture) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($domain->id) ?></td>
                </tr>
                 <tr>
                    <th><?= __('Description') ?></th>
                    <td><?= h($domain->description) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Resources') ?></h4>
                <?php if (!empty($domain->resources)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Name') ?></th>
                            <th><?= __('Picture') ?></th>
                            <th><?= __('Description') ?></th>
                            <th><?= __('Domain Id') ?></th>
                            <th><?= __('Archive') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($domain->resources as $resources) : ?>
                        <tr>
                            <td><?= h($resources->id) ?></td>
                            <td><?= h($resources->name) ?></td>
                            <td><?= h($resources->picture) ?></td>
                            <td><?= h($resources->description) ?></td>
                            <td><?= h($resources->domain_id) ?></td>
                            <td><?= h($resources->archive) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Resources', 'action' => 'view', $resources->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Resources', 'action' => 'edit', $resources->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Resources', 'action' => 'delete', $resources->id], ['confirm' => __('Are you sure you want to delete # {0}?', $resources->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <aside class="column">
       <div class="text-center">
        <?= $this->Html->link(__('List Domains'), ['action' => 'index'], ['class' => 'side-nav-item']) ?> 
        <?= $this->Html->link(__('Edit Domain'), ['action' => 'edit', $domain->id], ['class' => '']) ?> 
        <?= $this->Form->postLink(__('Delete Domain'), ['action' => 'delete', $domain->id], ['confirm' => __('Are you sure you want to delete # {0}?', $domain->id), 'class' => 'text-danger']) ?>
    </div>
</aside>
</div>
