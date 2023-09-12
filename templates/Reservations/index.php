<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Reservation> $reservations
 */
use Cake\I18n\FrozenTime;
?>

<?= $this->Html->script('search'); ?>

<div class="container">
    <div class="reservations index content">

        <h3 class="text-center font-weight-bold"><?= __('Reservations') ?></h3>

         <div class="d-flex align-items-center justify-content-between mb-1">
            <div >
                <?= $this->Html->link('<i class=" text-center fas fa-plus fa-xl"></i>' , ['action'=>'addForUser' ],[ 'class' => 'text-center  btn addButton','data-toggle'=>'tooltip', 'data-placement'=>'top', 'title'=>'Créer une réservation','escape' =>false]); ?>
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
                        <th scope="col" class="text-center"><?= $this->Paginator->sort('resource_id') ?></th>
                       <th scope="col" class="text-center"><?= $this->Paginator->sort('user_id') ?></th>
                       <th scope="col" class="text-center"><?= $this->Paginator->sort('start_date') ?></th>
                       <th scope="col" class="text-center"><?= $this->Paginator->sort('end_date') ?></th>                       
                       
                       <th scope="col" class="text-center"><?= $this->Paginator->sort('is_back') ?></th>
                       <th scope="col" class="text-center"><?= $this->Paginator->sort('back_date') ?></th>
                       
                       <th class="actions text-center" scope="col"><?= __('Actions') ?></th>
                   </tr>
               </thead>
               <tbody>
                <?php foreach ($reservations as $reservation): ?>

                    <?php
                        if($reservation->end_date <= FrozenTime::now() && !$reservation->is_back)
                            echo '<tr class = "bg-danger bg-opacity-50">';
                        else if ($reservation->is_back)
                            echo '<tr class = "bg-secondary bg-opacity-50 text-decoration-line-through">';
                        else
                            echo '<tr class="bg-white">';
                    ?>



                     
                        
                        
                        
                         <td class="text-center"><?= $reservation->has('resource') ? $this->Html->link($reservation->resource->name, ['controller' => 'Resources', 'action' => 'view', $reservation->resource->id]) : '' ?></td>
                        
                        
                        
                        <td class="text-center"><?= $reservation->has('user') ? $this->Html->link($reservation->user->firstname.' '.$reservation->user->lastname.' ('.$reservation->user->username.')', ['controller' => 'Users', 'action' => 'view', $reservation->user->id]) : '' ?></td>
                        
                        <td class="text-center"><?= h($reservation->start_date) ?></td>
                        
                        
                        <td class="text-center"><?= h($reservation->end_date) ?></td>
                        
                        
                        
                        
                        
                       
                        
                        <td class="text-center"><?= $reservation->is_back ? 'Oui' : 'Non' ?></td>

                        <td class="text-center"><?= $reservation->back_date ? $reservation->back_date : " Non définie " ?></td>

                        <td class="actions d-flex justify-content-center">
                            <div class="dropdown">
                                <button  class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                    <?=__('Actions') ?>
                                </button>
                                <ul class="dropdown-menu">  
                                    <?php 
                                        if($reservation->start_date > FrozenTime::now()): 
                                    ?>                            
                                    <li><?= $this->Html->link(__('Edit'), ['action' => 'editForUser', $reservation->id],['class' => 'dropdown-item']) ?></li>
                                    <?php
                                        endif;
                                    ?>

                                     <li>
                                       <?= $reservation->is_back ? $this->Form->postLink(__('Définir comme non rendue'), ['action' => 'unSetBack', $reservation->id],['class' => 'dropdown-item']) : $this->Form->postLink(__('Définir comme rendue'), ['action' => 'setBack', $reservation->id],['class' => 'dropdown-item']) ?>
                                    </li>
                                    <li>
                                         <button type="button" class="btn btn-danger text-danger dropdown-item" data-bs-toggle="modal" data-bs-target="<?= '#deleteReservationModal' . $reservation->id ?>">
                                              <?= __('Supprimer'); ?>
                                        </button>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>

                    <!-- DeleteResourceModal -->
                    <div class="modal fade" id="<?= 'deleteReservationModal' . $reservation->id ?>" tabindex="-1" aria-labelledby="deleteReservationModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h1 class="modal-title fs-5" id="deleteReservationModalLabel"><?= '<b> Suppression </b> de la reservation pour <b>' . $reservation->resource->name . '</b> du <b>' . $reservation->start_date . '</b> au <b>' . $reservation->end_date . '</b> par <b>' . $reservation->user->username . '</b>' ?> </h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                            Attention, ne supprimez cette réservation que si elle a été créee par erreur. Si l'emprunt a bien eu lieu et que la ressource a été rendue,  considérez  d'utiliser l'option "rendue" à la place.
                          </div>
                          <div class="modal-footer">  
                            <?= $this->Form->postLink(__('Supprimer'), ['action' => 'delete', $reservation->id], ['class' => 'btn btn-danger', 'confirm' => 'Supprimer '.$reservation->name.' ?']) ?>    

                            <?php
                                if($reservation->is_back)
                                    echo $this->Form->postLink(__('Définir comme non rendue'), ['action' => 'unSetBack', $reservation->id], ['class' => 'btn btn-warning', $reservation->id]);
                                else
                                    echo $this->Form->postLink(__('Définir comme rendue'), ['action' => 'setBack', $reservation->id], ['class' => 'btn btn-warning', $reservation->id]);
                            ?>
                          
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