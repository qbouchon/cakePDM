<?= $this->Html->script('../fullcalendar/index.global.min.js');?>
<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Reservation> $reservations
 */
use Cake\I18n\FrozenDate;
?>

<?php
    echo $this->Html->scriptBlock(sprintf(
    'var csrfToken = %s;',
    json_encode($this->request->getAttribute('csrfToken'))
));
?>

<?= $this->Html->script('search'); ?>
<?= $this->Html->script('reservations_index'); ?>

<div class="container">
    <div class="reservations index content">

        <h3 class="text-center font-weight-bold"><?= __('Reservations') ?></h3>

           <div id='calendarView' class='displaynone'>
                    <?= $this->Html->link('<i class=" text-center fas fa-plus fa-xl"></i>' , ['action'=>'addForUser' ],[ 'class' => 'text-center  btn reservationAddButton','data-toggle'=>'tooltip', 'data-placement'=>'top', 'title'=>'Créer une réservation','escape' =>false]); ?>
                    <a id='toggleList' class='btn listViewButton '><i class="fa-solid fa-table-list fa-xl "></i></a>

                   
                    <div id='fullCalendar'>
                    </div>

                    <div id='eventModals'>
                    </div>
                </div>



            <div id='listView' class='displaynone'>


                             <div class="d-flex align-items-center justify-content-between mb-1">
                                <div >
                                    <?= $this->Html->link('<i class=" text-center fas fa-plus fa-xl"></i>' , ['action'=>'addForUser' ],[ 'class' => 'text-center  btn reservationAddButton','data-toggle'=>'tooltip', 'data-placement'=>'top', 'title'=>'Créer une réservation','escape' =>false]); ?>
                                    <a id='toggleCalendar' class='btn calendarViewButton'><i class="text-center fa-regular fa-calendar-days fa-xl "></i></a>
                                    <a id='displayBack' class='btn viewbackButton '><i class="fa-solid fa-eye"></i></a>
                                    <a id='hideBack' class='btn hidebackButton '><i class="fa-solid fa-eye-slash"></i></a>

                                   
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
                                            <th scope="col" class="text-center"><?= $this->Paginator->sort('resource_id','Ressource') ?></th>
                                           <th scope="col" class="text-center"><?= $this->Paginator->sort('user_id', 'Utilisateur') ?></th>
                                           <th scope="col" class="text-center"><?= $this->Paginator->sort('start_date', 'Date de début') ?></th>
                                           <th scope="col" class="text-center"><?= $this->Paginator->sort('end_date', 'Date de fin') ?></th>                       
                                           
                                           <th scope="col" class="text-center"><?= $this->Paginator->sort('is_back','Retournée') ?></th>
                                           <th scope="col" class="text-center"><?= $this->Paginator->sort('back_date', 'Date de retour') ?></th>
                                           
                                           <th class="actions text-center" scope="col"><?= __('Actions') ?></th>
                                       </tr>
                                   </thead>
                                   <tbody>
                                    <?php foreach ($reservations as $reservation): ?>

                                        <?php
                                            if($reservation->end_date <= FrozenDate::now() && !$reservation->is_back)
                                                echo '<tr class = "bg-danger bg-opacity-50 unbackResa">';
                                            else if ($reservation->is_back)
                                                echo '<tr class = "bg-secondary bg-opacity-50 text-decoration-line-through isBack displaynone">';
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
                                                            if($reservation->start_date > FrozenDate::now()): 
                                                        ?>                            
                                                        <li><?= $this->Html->link(__('Edit'), ['action' => 'editForUser', $reservation->id],['class' => 'dropdown-item']) ?></li>
                                                        <?php
                                                            endif;
                                                        ?>



                                                        <?php
                                                            if($reservation->end_date <= FrozenDate::now() && !$reservation->is_back):
                                                        ?>
                                                                <button type="button" class="btn btn-danger dropdown-item" data-bs-toggle="modal" data-bs-target="<?= '#reminderMailModal' . $reservation->id ?>">
                                                                    Envoyer un mail de relance
                                                                </button>
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

                                        <!-- DeleteReservationModal -->
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


                                        <!-- reminderMailModal -->
                                        <?php
                                             if($reservation->end_date <= FrozenDate::now() && !$reservation->is_back):
                                        ?>

                                        <div class="modal fade" id="<?= 'reminderMailModal' . $reservation->id ?>" tabindex="-1" aria-labelledby="reminderMailModalLabel" aria-hidden="true">
                                          <div class="modal-dialog">
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="reminderMailModalLabel"> Envoi d'un mail de relance </h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                              </div>
                                              <div class="modal-body">
                                                    <?= $this->Form->textarea('Mail',['label'=> false, 'value' => $configuration->formatReminderMailText($reservation)]); ?>

                                              </div>
                                              <div class="modal-footer">  
                                               <?=  $this->Html->link('Envoyer le mail', ['controller' => 'Reservations', 'action' => 'reminderMail', $reservation->id],['class' => 'btn btn-secondary'])  ?>
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                        <?php
                                            endif;
                                        ?>



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
                           
                        </div>

        </div>
</div>
</div>