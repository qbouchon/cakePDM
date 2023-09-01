<?= $this->Html->script('../fullcalendar/index.global.min.js');?>
<?= $this->Html->script('../fullcalendar/daygrid/index.global.min.js');?>
<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Reservation> $reservations
 */
?>

<?= $this->Html->script('reservations_calendar'); ?>


<div class="container bg-white">
    <div class="reservations index content">

        <h3 class="text-center font-weight-bold"><?= __('Reservations à venir') ?></h3>

        
     <!--    <div id='resourceView' class='invisible'>
                <div class="text-center mb-3">
                    <a href="#" id="previousWeek">Semaine précédente</a> |
                    <a href="#" id="nextWeek">Semaine suivante</a>
                </div>
                <table id="calendar" class="table table-calendar">
                        <thead>
                            <tr id="headerRow" class="bg-white"></tr>
                       </thead id="tbody">
                       <tbody>
              
                       </tbody>
                </table>
        </div> -->

        <div id='fullCalendar'></div>



    </div>
</div>