<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Resource $resource
 */
?>


<?= $this->Html->script('stats'); ?>
<?php $this->assign('title', 'CREST - Stats'); ?>


<div class="container">
        <div class="reservations index content">

                <h3 class="text-center font-weight-bold mb-3"><?= __('Statistiques') ?></h3>
                 <div class="bg-white">       
                        <div class='row'>

                                <div class='col-4'>
                                        <div class='d-flex align-item-center mt-3'>
                                                <div class="mx-2 mt-2">Du</div>
                                                <input id='start' class="form-control" type='date'></input>
                                                <div class="mx-2 mt-2"> au </div>
                                                <input id='end' class="form-control" type='date'></input>
                                                <!-- <i class="fa-solid fa-magnifying-glass fa-xl ms-2 mt-2 "></i> -->
                                                <!-- <div id="statDatesBtn" class='btn btn-secondary ms-2'>Valider</div> -->
                                        </div> 
                                </div>

                                <div class='col-6'>
                                </div>
                                
                        </div>

                        <div class='row'>
                                <canvas id="myChart"></canvas>
                        </div>
                </div>
        </div>
</div>