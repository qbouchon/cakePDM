<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Domain> $domains
 */
?>
<?= $this->Html->script('search'); ?>

<div class="container">
    <div class="domains index content">

        <h3 class="text-center font-weight-bold"><?= __('Domaines') ?></h3>

            <div class="d-flex align-items-center justify-content-between mb-1">

                <div >
                    <?= $this->Html->link('<i class=" text-center fas fa-plus fa-xl"></i>' , ['action'=>'add' ],[ 'class' => 'text-center  btn domainAddButton','data-toggle'=>'tooltip', 'data-placement'=>'top', 'title'=>'Créer une ressource','escape' =>false]); ?>
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
            <table id="searchTable" class="table table-bordered table-hover table-sm table-responsive table-light">

                <thead>
                    <tr class="bg-white">             
                       <th scope="col" class="text-center"><?= $this->Paginator->sort('name', 'Nom') ?></th>
                       <th scope="col" class="text-center"><?= $this->Paginator->sort('picture', 'Image') ?></th>
                       <th scope="col" class="text-center"><?= $this->Paginator->sort('description', 'Description') ?></th>
                       <th class="actions text-center" scope="col"><?= __('Actions') ?></th>
                   </tr>
                </thead>

                <tbody>
                    <?php foreach ($domains as $domain): ?>

                    <tr class="bg-white">
                                                
                        <td class="text-center"><?= h($domain->name) ?></td>                                              
                        <td class="text-center"><?= h($domain->picture) ?></td>
                        <td class="text-center"><?= $domain->description ?></td>
                        <td class="actions d-flex justify-content-center">
                            <div class="dropdown">
                                <button  class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                    <?=__('Actions') ?>
                                </button>
                                <ul class="dropdown-menu">
                                    <li>
                                        <?= $this->Html->link(__('Détails'), ['controller' =>'domains','action' => 'view', $domain->id],['class' => 'dropdown-item']) ?>
                                    </li>
                                    
                                    <li>
                                        <?= $this->Html->link(__('Editer'), ['controller' =>'domains','action' => 'edit', $domain->id],['class' => 'dropdown-item']) ?>
                                    </li>
                                    
                                    <!-- Button trigger DeleteResourceModal -->
                                    <li>
                                        <button type="button" class="btn btn-danger text-danger dropdown-item" data-bs-toggle="modal" data-bs-target="<?= '#deleteDomainModal' . $domain->id ?>">
                                          <?= __('Supprimer'); ?>
                                        </button>
                                    </li>
                                </ul>
                            </div>
                        </td>

                    </tr>

                    <!-- DeleteDomainModal -->
                    <div class="modal fade" id="<?= 'deleteDomainModal' . $domain->id ?>" tabindex="-1" aria-labelledby="deleteDomainModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="deleteDomainModalLabel"><?= 'Suppression du domaine ' . $domain->name ?> </h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">

                                    <?php 
                                        if($domain->resources):
                                    ?>
                                            En supprimant ce domaine, <b>toutes les ressources ci dessous deviendrons orphelines : </b>
                                            <ul>
                                                <?php 

                                                    foreach ($domain->resources as $resource):

                                                        echo '<li>'.$resource->name.'</li>';

                                                    endforeach; 
                                                ?>
                                            </ul>
                                    <?php 
                                        else:
                                                echo 'Voulez-vous supprimer le domaine '.  $domain->name .' ?';
                                        endif;
                                    ?>

                                </div>
                                <div class="modal-footer">

                                        <?= $this->Form->postLink(__('Supprimer'), ['controller' =>'domains','action' => 'delete', $domain->id], ['class' => 'btn btn-danger', 'confirm' => 'Supprimer '.$domain->name.' ?']) ?> <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>

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