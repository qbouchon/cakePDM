<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Reservation $reservation
 * @var \Cake\Collection\CollectionInterface|string[] $resources
 * @var \Cake\Collection\CollectionInterface|string[] $users
 */

?>
<!-- js pour la gestion du datepicker -->
<?= $this->Html->script('reservation'); ?>

<div class="container">   

           <div class="row mt-2">


                    <?= $this->Html->link(__('retour'), $this->request->referer()) ?>

                    <?= $this->Form->create($reservation) ?>
                    <fieldset>

                        <div class = "col-8 px-5 pt-1 pb-4 mx-auto bg-white rounded">


                                    <h3 class="text-center"><?= __('Créer une réservation') ?></h3>
                                   
                                    
                                      
                                    <?php
                                        //echo $this->Form->control('is_back');
                                        echo $this->Form->control('resource_id', ['options' => $resources, 'value' => $selected_resource_id, 'id'=>'resourceInput']);
                                        echo $this->Form->control('user_id', ['options' => $users]);
                                    ?>

                                    <!-- datepicker -->
                                    <div id="picker" class="text-center">
                                        <input class='' id="checkin">
                                        <input class='' id="checkout">
                                    </div>

                                    <div class="text-center">
                                        <?= $this->Form->button(__('Créer')) ?>
                                        <?= $this->Form->end() ?>
                                    </div>
                        </div>
                        
                    </fieldset>
            
            </div>
</div>

