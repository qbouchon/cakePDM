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
                                    ?>
                                    <div id='maxDurationInfo' class='fst-italic'></div>
                                   <div id="loadingAnimaion" class="text-center"><i class="fa-solid fa-spinner fa-spin fa-2xl mt-5" ></i></div>

                                    <div class='mb-5' id='picker-container'>
                                        <input class="displaynone" id="picker" type="text" readonly='readonly'/>
                                    </div>

                              

                                        <?=  $this->Form->control('start_date',['id'=>'start_date', 'class'=>'font-italic', 'label'=>'Date de début','readonly'=>'']); ?>
                                         <div id="startDateFeedback" class="invalid-feedback">
                                         
                                        </div>     

                                        <?=  $this->Form->control('end_date',['id'=>'end_date',  'class'=>'font-italic', 'label'=>'Date de fin', 'readonly'=>'']); ?> 
                                         <div id="endDateFeedback" class="invalid-feedback">
                                         
                                        </div>  
                                           
                                    <div class="text-center">
                                        <?= $this->Form->button(__('Modifier'),['class' => ' mt-3']) ?>
                                        <?= $this->Form->end() ?>
                                    </div>

                        </div>
                    
                        
                    </fieldset>
            
            </div>
</div>