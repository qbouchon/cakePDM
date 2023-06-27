<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\File $file
 */
?>
<div class="row">
    
    <div class="column-responsive column-80">
        <div class="files view content">
            <h3 class="text-center"><?= h($file->id) ?></h3>
            <table class="table table-bordered table-hover table-sm table-responsive">
                <tr>
                    <th><?= __('Link') ?></th>
                    <td><?= h($file->link) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($file->id) ?></td>
                </tr>
            </table>
        </div>
    </div>

    <aside class="column">
       <div class="text-center">
        <?= $this->Html->link(__('List Files'), ['action' => 'index'], ['class' => 'side-nav-item']) ?> 
        <?= $this->Html->link(__('Edit File'), ['action' => 'edit', $file->id], ['class' => '']) ?> 
        <?= $this->Form->postLink(__('Delete File'), ['action' => 'delete', $file->id], ['confirm' => __('Are you sure you want to delete # {0}?', $file->id), 'class' => 'text-danger']) ?>
    </div>
</aside>
</div>