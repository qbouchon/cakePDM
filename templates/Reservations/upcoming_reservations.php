<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Reservation> $reservations
 */
?>

<?= $this->Html->script('calendar'); ?>

<div class="container">
    <div class="reservations index content">

        <h3 class="text-center font-weight-bold"><?= __('Reservations à venir') ?></h3>

        <div class="text-center mb-3">
            <a href="#" id="previousWeek">Semaine précédente</a> |
            <a href="#" id="nextWeek">Semaine suivante</a>
        </div>

    <!--     <table id="calendar" class="table table-bordered table-hover table-sm table-responsive table-light ">
                <thead>
                    <tr></tr>
               </thead>
               <tbody>
      
               </tbody>
        </table>


        <table id="events" class="table table-bordered table-hover table-sm table-responsive table-light ">

               <tbody>
      
               </tbody>
        </table> -->


        <div id="calendar" class="container">
            <div id="headerRow" class="row">
            </div>
            <div id="tbody">
            </div>
        </div>
         
    </div>
</div>