<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\User> $users
 */
?>
<div class="container">
    <div class="users index content">
            <?= $this->Html->link(__('New User'), ['action' => 'add'], ['class' => 'button float-right']) ?>
            <h3 class="text-center font-weight-bold"><?= __('Users') ?></h3>
        <div>
            <table class="table table-bordered table-hover table-sm table-responsive">
                <thead>
                    <tr>
                                                     <th scope="col" class="text-center"><?= $this->Paginator->sort('id') ?></th>
                                                     <th scope="col" class="text-center"><?= $this->Paginator->sort('firstname') ?></th>
                                                     <th scope="col" class="text-center"><?= $this->Paginator->sort('lastname') ?></th>
                                                     <th scope="col" class="text-center"><?= $this->Paginator->sort('login') ?></th>
                                                     <th scope="col" class="text-center"><?= $this->Paginator->sort('email') ?></th>
                                                     <th scope="col" class="text-center"><?= $this->Paginator->sort('active') ?></th>
                        
                        <th class="actions text-center" scope="col"><?= __('Actions') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                    <tr>
                                    
                    
                                                                                                <td class="text-center"><?= $this->Number->format($user->id) ?></td>
                                                                                
                    
                                                                                                <td class="text-center"><?= h($user->firstname) ?></td>
                                                                                
                    
                                                                                                <td class="text-center"><?= h($user->lastname) ?></td>
                                                                                
                    
                                                                                                <td class="text-center"><?= h($user->login) ?></td>
                                                                                
                    
                                                                                                <td class="text-center"><?= h($user->email) ?></td>
                                                                                
                    
                                                                                                <td class="text-center"><?= h($user->active) ?></td>
                                                                                                    <td class="actions d-flex justify-content-center">
                            <div class="dropdown">
                                <button  class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                    <?=__('Actions') ?>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><?= $this->Html->link(__('View'), ['action' => 'view', $user->id],['class' => 'dropdown-item']) ?></li>
                                    
                                    <li><?= $this->Html->link(__('Edit'), ['action' => 'edit', $user->id],['class' => 'dropdown-item']) ?></li>
                                    
                                    <li><?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $user->id], ['class' => 'dropdown-item','confirm' => __('Are you sure you want to delete # {0}?', $user->id)]) ?></li>  
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