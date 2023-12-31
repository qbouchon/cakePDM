<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\User> $users
 */
?>
<?= $this->Html->script('search'); ?>

<?php $this->assign('title', 'CREST - Utilisateurs'); ?>

<div class="container">
    <div class="users index content">
            <h3 class="text-center font-weight-bold"><?= __('Users') ?></h3>

            <div class="d-flex align-items-center justify-content-between mb-1">
                        <div >
                            <?= $this->Html->link('<i class=" text-center fas fa-plus fa-xl"></i>' , ['action'=>'add' ],[ 'class' => 'text-center  btn userAddButton','data-toggle'=>'tooltip', 'data-placement'=>'top', 'title'=>'Créer une ressource','escape' =>false]); ?>
                        </div>
                              <!-- Search bar -->
                <div>
                    <fieldset>
                            <?= $this->Form->create(null, ['url' => ['action' => 'index'], 'type' => 'get']); ?>

                            <div class="input-group">                        
                                    <?= $this->Form->input('searchField', ['type' => 'text', 'class' => 'form-control border-right-0', 'id' => 'searchBox', 'onkeyup' => 'search()', 'placeholder' => 'Rechercher', 'value' => $this->request->getQuery('searchField')]); ?>

                                    <?= $this->Html->link('<i class="fa-solid fa-xmark displaynone" id="resetSearch"></i>' , ['action'=>'index','?'=>  array_merge($this->request->getQuery(), ['searchField' => ''])],['escape' =>false]); ?>

                                    <span class="input-group-text bg-white border-left-0">
                                        <!-- <i class="fa fa-search"></i> -->
                                         <?= $this->Form->button('<i class="fa fa-search"></i>', ['escapeTitle' =>false, 'class' => 'searchButton']); ?>                                       
                                    </span>
                            </div>
                            <?= $this->Form->end() ?>
                    </fieldset>               
                </div>
            </div>


        <div>
            <table id="searchTable" class="table table-bordered table-hover table-sm table-responsive">
                <thead>
                    <tr class="bg-white">
                                                     <th scope="col" class="text-center"><?= $this->Paginator->sort('id') ?></th>
                                                     <th scope="col" class="text-center"><?= $this->Paginator->sort('firstname','Prénom') ?></th>
                                                     <th scope="col" class="text-center"><?= $this->Paginator->sort('lastname','Nom') ?></th>
                                                     <th scope="col" class="text-center"><?= $this->Paginator->sort('username','Login') ?></th>
                                                     <th scope="col" class="text-center"><?= $this->Paginator->sort('email') ?></th>
                                                     <th scope="col" class="text-center"><?= $this->Paginator->sort('active') ?></th>
                                                     <th scope="col" class="text-center"><?= $this->Paginator->sort('admin') ?></th>
                        
                        <th class="actions text-center" scope="col"><?= __('Actions') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                    <tr class="bg-white">
                                    
                    
                                                                                                <td class="text-center"><?= $this->Number->format($user->id) ?></td>
                                                                                
                    
                                                                                                <td class="text-center"><?= h($user->firstname) ?></td>
                                                                                
                    
                                                                                                <td class="text-center"><?= h($user->lastname) ?></td>
                                                                                
                    
                                                                                                <td class="text-center"><?= h($user->username) ?></td>
                                                                                
                    
                                                                                                <td class="text-center"><?= h($user->email) ?></td>
                                                                                
                    
                                                                                                <td class="text-center"><?= $user->active ? 'Oui' : 'Non' ?></td>
                                                                                
                    
                                                                                                <td class="text-center"><?= $user->admin ? 'Oui' : 'Non' ?></td>
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