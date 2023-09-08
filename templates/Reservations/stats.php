<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Resource $resource
 */
?>


<?= $this->Html->script('stats'); ?>


<div class="container bg-white">
    <div class="reservations index content">

        <h3 class="text-center font-weight-bold"><?= __('Statistiques') ?></h3>

                <div class='d-flex'>
                        <div class="mx-2">Du</div>
                        <input id='start' type='date'></input>
                        <div class="mx-2"> au </div>
                        <input id='end' type='date'></input>
                </div> 

                <div>
                        <canvas id="myChart"></canvas>
                </div>
    </div>
</div>