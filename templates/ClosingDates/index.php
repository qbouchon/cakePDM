<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\User> $users
 */
?>
<?= $this->Html->script('search'); ?>
<?php $this->assign('title', 'CREST - Dates de fermetures'); ?>


<div class="container">
    <div class="users index content">

        <h3 class="text-center font-weight-bold"><?= __('Dates de fermeture') ?></h3>

        <div class="d-flex align-items-center justify-content-between mb-1">
            <div >
                <?= $this->Html->link('<i class=" text-center fas fa-plus fa-xl"></i>' , ['action'=>'add' ],[ 'class' => 'text-center  btn closingDatesAddButton','data-toggle'=>'tooltip', 'data-placement'=>'top', 'title'=>'Créer des dates de fermeture','escape' =>false]); ?>
            </div>
            
            <!-- Search bar -->
            <div>
                <fieldset>
                        <?= $this->Form->create(null, ['url' => ['action' => 'index'], 'type' => 'get']); ?>

                        <div class="input-group">                        
                            <?= $this->Form->input('searchField', ['type' => 'text', 'class' => 'form-control border-right-0', 'id' => 'searchBox', 'onkeyup' => 'search()', 'placeholder' => 'Rechercher', 'value' => $this->request->getQuery('searchField')]); ?>

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
                        <th scope="col" class="text-center"><?= $this->Paginator->sort('name','Nom') ?></th>
                        <th scope="col" class="text-center"><?= $this->Paginator->sort('start_date','Date de début') ?></th>
                        <th scope="col" class="text-center"><?= $this->Paginator->sort('end_date', 'Date de fin' ) ?></th>
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
                                            
                                            <li><?= $this->Html->link(__('Edit'), ['action' => 'edit', $closingDate->id],['class' => 'dropdown-item']) ?></li>
                                            
                                            <button type="button" class="btn btn-danger text-danger dropdown-item" data-bs-toggle="modal" data-bs-target="<?= '#deleteClosingDateModal' . $closingDate->id ?>">
                                              <?= __('Supprimer'); ?>
                                            </button>
                                        </ul>
                                    </div>
                                </td>

                            </tr>

                            <!-- DeleteClosingDateModal -->
                            <div class="modal fade" id="<?= 'deleteClosingDateModal' . $closingDate->id ?>" tabindex="-1" aria-labelledby="deleteClosingDateModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="deleteClosingDateModalLabel"><?= 'Suppression de "' . $closingDate->name  .'"'?> </h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Etes-vous sûr de vouloir supprimer les dates de fermeture du <b> <?= $closingDate->start_date ?> </b> au <b> <?= $closingDate->end_date ?> </b>
                                        </div>
                                        <div class="modal-footer">  
                                            <?= $this->Form->postLink(__('Supprimer'), ['action' => 'delete', $closingDate->id], ['class' => 'btn btn-danger']) ?>    
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

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
            <p class="d-flex justify-content-center"><?= $this->Paginator->counter(__('Page {{page}} sur {{pages}}, {{current}} entrée(s) affiché(s) sur un total de {{count}}')) ?></p>
        </div>
        
    </div>
</div>