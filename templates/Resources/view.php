<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Resource $resource
 */
?>
<?php
    use Cake\I18n\FrozenDate;
?>

<?php $this->assign('title', 'CREST - Ressources'); ?>

    <div class="row mt-2">

        <div class = "col-8 px-5 pt-1 pb-4 mx-auto bg-white rounded text-center">

            <div class='d-flex justify-content-between align-items-center'>
                <i onclick="history.back();" class="backButton fa-solid fa-left-long fa-xl"></i>
                <h3 class="text-center mb-2"><?= h($resource->name) ?></h3>
                <div></div>
            </div>


                <table class="table table-bordered table-hover table-sm table-responsive table-light ">
                    <tr>
                        <th><?= __('Nom') ?></th>
                        <td><?= h($resource->name) ?></td>
                    </tr>
                    <tr>
                        <th><?= __('Image') ?></th>
                        <td><?= $this->Html->image('resources/'.$resource->picture_path,['class'=>'img-fluid']) ?> </td>
                    </tr>
                    <tr>
                        <th><?= __('Domaine') ?></th>
                        <td><?= $resource->has('domain') ? $resource->domain->name : 'Aucun' ?></td>
                    </tr>
                    <tr>
                        <th><?= __('Durée de réservation max') ?></th>
                        <td><?= $resource->max_duration > 0 ? $resource->max_duration . " jour(s)" : "Illimitée"?></td>
                    </tr>
                    <?php 
                        if($this->getRequest()->getAttribute('identity')->get('admin')):
                     ?>
                    <tr>
                        <th><?= __('Archivée') ?></th>
                        <td><?= $resource->archive ? __('Oui') : __('Non'); ?></td>
                    </tr>
                    <?php
                        endif;
                    ?>
                </table>

                <?php
                    if($resource->description):
                ?>
                    <div class="text">
                        <strong><?= __('Description') ?></strong>
                        <blockquote>
                            <div id="description">
                               <?= $resource->description ?>
                            </div>
                        </blockquote>
                    </div>
                <?php
                    endif;
                ?>
                <div class="related  text-start">                      
                    <?php if (!empty($resource->files)) : ?>
                            <h4 class="text-center"><?= __('Fichiers associés') ?></h4>
                            <ul>
                                <?php foreach ($resource->files as $files) : ?>
                                   <li> <?= $this->Html->link($files->name,[ 'controller' => 'Files','action' => 'download',$files->id, ],['target' => '_blank']) ?>
                                  
                                   </li>
                                <?php endforeach; ?>
                            </ul>                       
                    <?php endif; ?>
                </div>

                <?php
                    if($this->getRequest()->getAttribute('identity')->get('admin')) :
                ?>
                        <div class="related">
                            <h4><?= __('Réservations en cours') ?></h4>

                            <?php if (!empty($resource->reservations)) : ?>

                                <table class="table table-bordered table-hover table-sm table-responsive table-light">
                                    <tr>
                                        <th><?= __('Utilisateur') ?></th>
                                        <th><?= __('Date de début') ?></th>
                                        <th><?= __('Date de fin') ?></th>
                                        <th class="actions"><?= __('Actions') ?></th>                                                                                                      
                                    </tr>
                                        
                                    <?php foreach ($resource->reservations as $reservation) : 

                                        if(!$reservation->is_back) :

                                    ?>

                                            <?php
                                                if($reservation->end_date <= FrozenDate::now() && !$reservation->is_back)
                                                    echo '<tr class = "bg-danger bg-opacity-50 unbackResa">';
                                                else if ($reservation->is_back)
                                                    echo '<tr class = "bg-secondary bg-opacity-50 text-decoration-line-through">';
                                                else
                                                    echo '<tr class="bg-white">';
                                            ?>
                                                   
                                                    <td><?= h($reservation->user->firstname).' '.h($reservation->user->lastname).' ('.h($reservation->user->username).')' ?></td>
                                                    <td><?= h($reservation->start_date) ?></td>
                                                    <td><?= h($reservation->end_date) ?></td>

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
                                                                    if($reservation->end_date < FrozenDate::now() && !$reservation->is_back):
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
                                                                <?= $this->Form->postLink(__('Supprimer'), ['controller' => 'Reservations' , 'action' => 'delete', $reservation->id], ['class' => 'btn btn-danger', 'confirm' => 'Supprimer '.$reservation->name.' ?']) ?>    

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

                                        <?php 
                                                endif;
                                            endforeach; 
                                        ?>

                                </table>

                                <?php else : ?>
                                    <i>Aucune réservation en cours</i>
                                <?php endif; ?>
                        </div>

                <?php
                    endif;
                ?>
              

                <div class="text-center mt-3">
                     <?php 
                        if($this->getRequest()->getAttribute('identity')->get('admin')):
                     ?>

                     <?= $this->Html->link("Réserver", ['controller' => 'Reservations', 'action' => 'addForUser', $resource->id],['class' => 'btn btn-secondary']) ?>
                     <?= $this->Html->link(__('Editer'), ['action' => 'edit', $resource->id], ['class' => 'btn btn-secondary']) ?> 

                    <?php 
                        if($resource->archive) :
                            echo $this->Form->postLink(__('Désarchiver'), ['action' => 'unArchive', $resource->id], ['class' => 'btn btn-warning', $resource->id]); 
                        else :
                            echo $this->Form->postLink(__('Archiver'), ['action' => 'archive', $resource->id], ['class' => 'btn btn-warning', $resource->id]); 
                        endif;
                    ?>

                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="<?= '#deleteResourceModal' ?>"><?= __('Supprimer'); ?> 
                    </button>
                </div>

                    <!-- DeleteResourceModal -->
                    <div class="modal fade" id="<?= 'deleteResourceModal' ?>" tabindex="-1" aria-labelledby="deleteResourceModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="deleteResourceModalLabel"><?= 'Suppression de la ressource ' . $resource->name ?> </h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                            Attention, si vous supprimez cette ressource, <b>toutes les réservations associées et fichiers seront définitivement supprimés.</b> Si vous souhaitez que cette ressource ne soit plus disponible mais garder les anciennes réservations et fichiers, considérez  d'utiliser l'option "archiver" à la place.
                                </div>
                                <div class="modal-footer">  
                                    <?= $this->Form->postLink(__('Supprimer'), ['action' => 'delete', $resource->id], ['class' => 'btn btn-danger', 'confirm' => 'Supprimer '.$resource->name.' ?']) ?>
                                    <?= $this->Form->postLink(__('Archiver'), ['action' => 'archive', $resource->id], ['class' => 'btn btn-warning', $resource->id]) ?>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php
                        else:
                    ?>
                        <?= $this->Html->link("Réserver", ['controller' => 'Reservations', 'action' => 'add', $resource->id],['class' => 'btn btn-secondary']) ?>
                </div>

                    <?php
                        endif;
                    ?>
        </div>                    
    </div>

