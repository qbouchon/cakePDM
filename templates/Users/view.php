<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
use Cake\I18n\FrozenDate;
?>

<?php $this->assign('title', 'CREST - Utilisateurs'); ?>

<div class="container">

        <div class="row mt-2">

                <div class = "col-8 px-5 pt-1 pb-4 mx-auto bg-white rounded text-center">
                            <h3 class="text-center mb-2"><?= h($user->firstname.' ' . $user->lastname . ' (' . $user->username) . ')' ?></h3>
                                        <table class="table table-bordered table-hover table-sm table-responsive table-light ">
                                            <tr>
                                                <th><?= __('Firstname') ?></th>
                                                <td><?= h($user->firstname) ?></td>
                                            </tr>
                                            <tr>
                                                <th><?= __('Lastname') ?></th>
                                                <td><?= h($user->lastname) ?></td>
                                            </tr>
                                            <tr>
                                                <th><?= __('Username') ?></th>
                                                <td><?= h($user->username) ?></td>
                                            </tr>
                                            <tr>
                                                <th><?= __('Email') ?></th>
                                                <td><?= h($user->email) ?></td>
                                            </tr>
                                            <tr>
                                                <th><?= __('admin') ?></th>
                                                <td><?= h($user->admin) ?></td>
                                            </tr>
                                            <tr>
                                                <th><?= __('Id') ?></th>
                                                <td><?= $this->Number->format($user->id) ?></td>
                                            </tr>
                                            <tr>
                                                <th><?= __('Active') ?></th>
                                                <td><?= $user->active ? __('Yes') : __('No'); ?></td>
                                            </tr>
                                        </table>

                            <div class="related">
                                <h4><?= __('Réservations en cours') ?></h4>
                                <?php if (!empty($user->reservations)) : ?>
                                <div class="table-responsive ">
                                    <table class="table table-bordered table-hover table-sm table-responsive table-light">
                                        <tr>
                                            <th><?= __('N°') ?></th>
                                            <th><?= __('Ressource') ?></th>
                                            <th><?= __('Date de début') ?></th>
                                            <th><?= __('Date de fin') ?></th>     
                                            <th class="actions"><?= __('Actions') ?></th>
                                        </tr>
                                        <?php foreach ($user->reservations as $reservation) : ?>


                                            <?php
                                                if($reservation->end_date <= FrozenDate::now() && !$reservation->is_back)
                                                    echo '<tr class = "bg-danger bg-opacity-50 unbackResa">';
                                                else if ($reservation->is_back)
                                                    echo '<tr class = "bg-secondary bg-opacity-50 text-decoration-line-through">';
                                                else
                                                    echo '<tr class="bg-white">';
                                            ?>
                                        
                                            <td class="text-center"><?= $reservation->id ?></td>
                                            <td class="text-center"><?= $reservation->has('resource') ? $this->Html->link($reservation->resource->name, ['controller' => 'Resources', 'action' => 'view', $reservation->resource->id]) : '' ?></td>
                        
                        
                        
                        
                        
                                            <td class="text-center"><?= h($reservation->start_date) ?></td>
                                                            
                                                            
                                                            <td class="text-center"><?= h($reservation->end_date) ?></td>
                                                            
                                                            

                                                            

                                                            <td class="actions d-flex justify-content-center">
                                                                <div class="dropdown">
                                                                    <button  class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                                                        <?=__('Actions') ?>
                                                                    </button>
                                                                    <ul class="dropdown-menu">  
                                                                        <?php 
                                                                            if($reservation->start_date > FrozenDate::now()): 
                                                                        ?>                            
                                                                        <li><?= $this->Html->link(__('Edit'), ['controller' => 'Reservations' , 'action' => 'editForUser', $reservation->id],['class' => 'dropdown-item']) ?></li>
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
                                                                           <?= $reservation->is_back ? $this->Form->postLink(__('Définir comme non rendue'), ['controller' => 'Reservations' , 'action' => 'unSetBack', $reservation->id],['class' => 'dropdown-item']) : $this->Form->postLink(__('Définir comme rendue'), ['controller' => 'Reservations' , 'action' => 'setBack', $reservation->id],['class' => 'dropdown-item']) ?>
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
                                                                <?= $this->Form->postLink(__('Supprimer'), ['action' => 'delete', $reservation->id], ['controller' => 'Reservations' , 'class' => 'btn btn-danger', 'confirm' => 'Supprimer '.$reservation->name.' ?']) ?>    

                                                                <?php
                                                                    if($reservation->is_back)
                                                                        echo $this->Form->postLink(__('Définir comme non rendue'), ['controller' => 'Reservations' , 'action' => 'unSetBack', $reservation->id], ['class' => 'btn btn-warning', $reservation->id]);
                                                                    else
                                                                        echo $this->Form->postLink(__('Définir comme rendue'), ['controller' => 'Reservations' , 'action' => 'setBack', $reservation->id], ['class' => 'btn btn-warning', $reservation->id]);
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

                                                            <div class="modal fade modal-wide" id="<?= 'reminderMailModal' . $reservation->id ?>" tabindex="-1" aria-labelledby="reminderMailModalLabel" aria-hidden="true">
                                                              <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                  <div class="modal-header">
                                                                    <h1 class="modal-title fs-5" id="reminderMailModalLabel"> Envoi d'un mail de relance </h1>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                  </div>
                                                                  <div class="modal-body">
                                                                        <?= $this->Form->create(null, ['url' => ['controller' => 'Reservations', 'action' => 'reminderMail', $reservation->id]]) ?>
                                                                         <?= $this->Form->control('mailObject',['label'=> 'Objet :', 'value' => $configuration->formatReminderMailObject($reservation)]); ?>
                                                                        <?= $this->Form->textarea('mail',['label'=> false, 'value' => $configuration->formatReminderMailText($reservation)]); ?>

                                                                  </div>
                                                                  <div class="modal-footer">  
                                                                    <?= $this->Form->submit('Envoyer le mail', ['class' => 'btn btn-secondary']) ?>
                                                                    <?= $this->Form->end() ?>
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                                                  </div>
                                                                </div>
                                                              </div>
                                                            </div>
                                                            <?php
                                                                endif;
                                                            ?>


                                        <?php endforeach; ?>
                                    </table>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                </div>
    </div>               

