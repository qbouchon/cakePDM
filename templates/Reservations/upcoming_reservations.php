<?= $this->Html->script('../fullcalendar/index.global.min.js');?>
<?= $this->Html->script('../fullcalendar/daygrid/index.global.min.js');?>
<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Reservation> $reservations
 */
?>

<?= $this->Html->script('week_calendar'); ?>
<?= $this->Html->script('month_calendar'); ?>



<div class="container bg-white">
    <div class="reservations index content">

        <h3 class="text-center font-weight-bold"><?= __('Reservations à venir') ?></h3>

        <div class="text-center mb-3">
            <a href="#" id="previousWeek">Semaine précédente</a> |
            <a href="#" id="nextWeek">Semaine suivante</a>
        </div>
       <!--  <a href="#" id="monthLink">Month</a>
        <div class="text-center mb-3">
            <a href="#" id="previousMonth">Mois précédent</a> |
            <div id="month"></div>
            <a href="#" id="nextMonth">Mois suivant</a>
        </div>

 -->


 <a href="#" id="monthLink">Month</a>
 
        <table id="Calendar" class="table table-calendar">
                <thead>
                    <tr id="headerRow" class="bg-white"></tr>
               </thead id="tbody">
               <tbody>
      
               </tbody>
        </table>

        <div id='fullCalendar'></div>


 <!--        <table id="events" class="table table-bordered table-hover table-sm table-responsive table-light ">

               <tbody>
      
               </tbody>
        </table> -->


        <!-- <div id="calendar" class="container ">
            <div id="headerRow" class="row">
            </div>
            <div id="tbody">
            </div>
        </div> -->

    </div>
</div>