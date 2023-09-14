<?= $this->Html->script('../fullcalendar/index.global.min.js');?>
<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Reservation> $reservations
 */

use Cake\I18n\FrozenTime;
?>

<?php
    echo $this->Html->scriptBlock(sprintf(
    'var csrfToken = %s;',
    json_encode($this->request->getAttribute('csrfToken'))
));
?>

<?= $this->Html->script('search'); ?>
<?= $this->Html->script('reservations_calendar_user'); ?>



<div class="container">
    <div class="reservations index content">

        <h3 class="text-center font-weight-bold"><?= __('Mes Réservations') ?></h3>

                <div id='calendarView'>
                    <?= $this->Html->link('<i class=" text-center fas fa-plus fa-xl"></i>' , ['action'=>'add' ],[ 'class' => 'text-center  btn reservationAddButton','data-toggle'=>'tooltip', 'data-placement'=>'top', 'title'=>'Créer une réservation','escape' =>false]); ?>
                    <a id='toggleList' class='btn listViewButton '><i class="fa-solid fa-table-list fa-xl "></i></a>
                   
                    <div id='fullCalendar'>
                    </div>

                    <div id='eventModals'>
                    </div>
                </div>




            <div id='listView'>



                                                     <div class="d-flex align-items-center justify-content-between mb-1">
                                                        <div >
                                                            
                                                            <?= $this->Html->link('<i class=" text-center fas fa-plus fa-xl"></i>' , ['action'=>'add' ],[ 'class' => 'text-center  btn reservationAddButton','data-toggle'=>'tooltip', 'data-placement'=>'top', 'title'=>'Créer une réservation','escape' =>false]); ?>
                                                            <a id='toggleCalendar' class='btn calendarViewButton'><i class="text-center fa-regular fa-calendar-days fa-xl "></i></a>
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
                                                                   <th scope="col" class="text-center"><?= $this->Paginator->sort('start_date') ?></th>
                                                                   <th scope="col" class="text-center"><?= $this->Paginator->sort('end_date') ?></th> 
                                                                   
                                                                   <th class="actions text-center" scope="col"><?= __('Actions') ?></th>
                                                               </tr>
                                                           </thead>
                                                           <tbody>
                                                            <?php foreach ($reservations as $reservation):
                                                                    if(!$reservation->is_back): 

                                                            ?>

                                                            <?php
                                                                    if($reservation->end_date <= FrozenTime::now() && !$reservation->is_back)
                                                                        echo '<tr class = "bg-danger bg-opacity-50 unbackResaUser">';
                                                                    else
                                                                        echo '<tr class="bg-white">';
                                                            ?>
                                                                
                                                                    
                                                                    
                                                                    
                                                                     <td class="text-center"><?= $reservation->has('resource') ? $this->Html->link($reservation->resource->name, ['controller' => 'Resources', 'action' => 'view', $reservation->resource->id]) : '' ?></td>
                                                                    
                                                                    <td class="text-center"><?= h($reservation->start_date) ?></td>
                                                                    
                                                                    
                                                                    <td class="text-center"><?= h($reservation->end_date) ?></td>

                                                                    <!-- à remettre au propre -->
                                                                    <?php 
                                                                        if($reservation->start_date > FrozenTime::now() || $this->getRequest()->getAttribute('identity')->get('admin')):
                                                                    ?>
                                                                            <td class="actions d-flex justify-content-center">
                                                                                <div class="dropdown">
                                                                                    <button  class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                                                                        <?=__('Actions') ?>
                                                                                    </button>
                                                                                    <ul class="dropdown-menu">                               
                                                                                        <li>
                                                                                            <?php

                                                                                                if($this->getRequest()->getAttribute('identity')->get('admin'))
                                                                                                {
                                                                                                    if($reservation->start_date > FrozenTime::now())
                                                                                                        echo $this->Html->link(__('Edit'), ['action' => 'editForUser', $reservation->id],['class' => 'dropdown-item']);
                                                                                                }
                                                                                                else
                                                                                                    echo $this->Html->link(__('Edit'), ['action' => 'edit', $reservation->id],['class' => 'dropdown-item']);

                                                                                            ?>

                                                                                         </li>
                                                                                    
                                                                                        <li>
                                                                                             <button type="button" class="btn btn-danger text-danger dropdown-item" data-bs-toggle="modal" data-bs-target="<?= '#deleteReservationModal' . $reservation->id ?>">
                                                                                                  <?= __('Supprimer'); ?>
                                                                                            </button>
                                                                                        </li>
                                                                                    </ul>
                                                                                </div>
                                                                            </td>
                                                                    <?php
                                                                        else:
                                                                    ?>
                                                                         <td class="text-center"><i>Réservation en cours</i></td>
                                                                    <?php
                                                                        endif;
                                                                    ?>

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
                                                                        Supprimer cette reservation ?
                                                                      </div>
                                                                      <div class="modal-footer">  
                                                                        <?= $this->Form->postLink(__('Supprimer'), ['action' => 'delete', $reservation->id], ['class' => 'btn btn-danger']) ?>    
                                                                       
                                                                      
                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                                                      </div>
                                                                    </div>
                                                                  </div>
                                                                </div>




                                                            <?php 
                                                                     endif;
                                                                endforeach; 
                                                            ?>
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
</div>