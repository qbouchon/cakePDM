<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\User> $users
 */
?>
<?= $this->Html->script('search'); ?>

<div class="container">
    <div class="users index content">
            <h3 class="text-center font-weight-bold"><?= __('Users') ?></h3>

            <div class="d-flex align-items-center justify-content-between mb-1">
                        <div >
                            <?= $this->Html->link('<i class=" text-center fas fa-plus fa-xl"></i>' , ['action'=>'add' ],[ 'class' => 'text-center  btn addButton','data-toggle'=>'tooltip', 'data-placement'=>'top', 'title'=>'Créer des dates de fermeture','escape' =>false]); ?>
                        </div>
                        <div>
                             <div class="input-group">                        
                                    <input type="text" class="form-control border-right-0" id="searchBox" onkeyup="search()" placeholder="Rechercher">   
                                     <span class="input-group-text bg-white border-left-0">
                                            <i class="fa fa-search"></i>
                                    </span>

                            </div>
                           
                        </div>
            </div>


        <div>
            <table id="searchTable" class="table table-bordered table-hover table-sm table-responsive">
                <thead>
                    <tr class="bg-white">
                                                     <th scope="col" class="text-center"><?= $this->Paginator->sort('name') ?></th>
                                                     <th scope="col" class="text-center"><?= $this->Paginator->sort('start_date') ?></th>
                                                     <th scope="col" class="text-center"><?= $this->Paginator->sort('last_date') ?></th>
                                                                   
                        <th class="actions text-center" scope="col"><?= __('Actions') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($closingDates as $closingDate): ?>
                    <tr class="bg-white">
                                    
                    
                                                                                                <td class="text-center"><?= h($closingDate->name) ?></td>
                                                                                
                    
                                                                                                <td class="text-center"><?= h($closingDate->start_date) ?></td>
                                                                                
                    
                                                                                                <td class="text-center"><?= h($closingDate->end_date) ?></td>
                                                                                
                        <td class="actions d-flex justify-content-center" >
                            <div class="dropdown">
                                <button  class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                    <?=__('Actions') ?>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><?= $this->Html->link(__('View'), ['action' => 'view', $closingDate->id],['class' => 'dropdown-item']) ?></li>
                                    
                                    <li><?= $this->Html->link(__('Edit'), ['action' => 'edit', $closingDate->id],['class' => 'dropdown-item']) ?></li>
                                    
                                    <li><?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $closingDate->id], ['class' => 'dropdown-item btn text-danger','confirm' => __('Are you sure you want to delete # {0}?', $closingDate->id)]) ?></li>  
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