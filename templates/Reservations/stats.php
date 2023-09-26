<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Resource $resource
 */
?>


<?= $this->Html->script('stats'); ?>
<?php $this->assign('title', 'CREST - Stats'); ?>


<div class="container bg-white">
        <div class="reservations index content">

                <h3 class="text-center font-weight-bold"><?= __('Statistiques') ?></h3>

                <div class='row'>

                        <div class='col-4'>
                                <div class='d-flex align-item-center'>
                                        <div class="mx-2">Du</div>
                                        <input id='start' class="form-control" type='date'></input>
                                        <div class="mx-2"> au </div>
                                        <input id='end' class="form-control" type='date'></input>
                                </div> 
                        </div>

                        <div class='col-6'>
                        </div>
                        
                </div>

                <div>
                        <canvas id="myChart"></canvas>
                </div>
        </div>
</div>