<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Reservation $reservation
 * @var \Cake\Collection\CollectionInterface|string[] $resources
 * @var \Cake\Collection\CollectionInterface|string[] $users
 */
    use Cake\I18n\FrozenDate;
?>

    <script>
        var reservationId = "<?php echo $reservation->id ?>";
    </script>
<!-- js pour la gestion du datepicker -->
<?= $this->Html->script('reservation_edit'); ?>


<div class="container">   

           <div class="row mt-2">


                    <?= $this->Form->create($reservation) ?>
                    <fieldset>

                        <div class = "col-8 px-5 pt-1 pb-4 mx-auto bg-white rounded">


                                    <h3 class="text-center"><?= __('Editer une réservation') ?></h3>
                             
                                      
                                    <?php
                                        echo $this->Form->control('resource_id', ['options' => $resources, 'id'=>'resourceInput']);
                                        echo $this->Form->control('user_id', ['options' => $users]);
                                    ?>
                                    <div id='maxDurationInfo' class='fst-italic'></div>
                                    <div class='mb-5' id='picker-container'>
                                        <input class="invisible" id="picker" type="text" readonly='readonly'/>
                                    </div>

                              

                                        <?=  $this->Form->control('start_date',['id'=>'start_date', 'class'=>'font-italic', 'label'=>'Date de début','readonly'=>'']); ?>   

                                        <?=  $this->Form->control('end_date',['id'=>'end_date',  'class'=>'font-italic', 'label'=>'Date de fin', 'readonly'=>'']); ?>   
                                           
                                   
                                        <?= $this->Form->control('is_back',['label' => 'Ressource retournée']) ?>

                                    <div class="text-center">
                                        <?= $this->Form->button(__('Modifier'),['class' => ' mt-3']) ?>
                                        <?= $this->Form->end() ?>
                                    </div>

                        </div>
                    
                        
                    </fieldset>
            
            </div>
</div>