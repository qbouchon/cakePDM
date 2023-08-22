<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Reservation $reservation
 * @var \Cake\Collection\CollectionInterface|string[] $resources
 * @var \Cake\Collection\CollectionInterface|string[] $users
 */
    use Cake\I18n\FrozenDate;
?>


<!-- js pour la gestion du datepicker -->
<?= $this->Html->script('reservation'); ?>

<div class="container">   

           <div class="row mt-2">


                    <?= $this->Html->link(__('retour'), $this->request->referer()) ?>

                    <?= $this->Form->create($reservation) ?>
                    <fieldset>

                        <div class = "col-8 px-5 pt-1 pb-4 mx-auto bg-white rounded">


                                    <h3 class="text-center"><?= __('Créer une réservation pour un utilisateur') ?></h3>
                             
                                      
                                    <?php
                                        //echo $this->Form->control('is_back');
                                        echo $this->Form->control('resource_id', ['options' => $resources, 'value' => $selected_resource_id, 'id'=>'resourceInput']);
                                        echo $this->Form->control('user_id', ['options' => $users]);
                                    ?>

                                    <div class='mb-5' id='picker-container'>
                                    <input class="invisible" id="picker" type="text" readonly='readonly'/>
                                    </div>

                              

                                       <?=  $this->Form->control('start_date',['id'=>'start_date', 'class'=>'font-italic', 'label'=>'Date de début','readonly'=>'']); ?>   
                                            <em id='sd_error' class='text-danger font-italic'></em>

                                        <?=  $this->Form->control('end_date',['id'=>'end_date',  'class'=>'font-italic', 'label'=>'Date de fin', 'readonly'=>'']); ?>   
                                            <em id='ed_error' class='text-danger font-italic'></em>
                                   


                                    <div class="text-center">
                                        <?= $this->Form->button(__('Créer')) ?>
                                        <?= $this->Form->end() ?>
                                    </div>

                        </div>
                    
                        
                    </fieldset>
            
            </div>
</div>