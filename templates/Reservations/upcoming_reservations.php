<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Reservation> $reservations
 */
?>

<?= $this->Html->script('calendar'); ?>


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
            <div id="headerRow" class="row px-0">
            </div>
            <div id="tbody">
            </div>
        </div>

        <div id="events" class="container">
            <div id="headerRow" class="row px-0">
            </div>
            <div id="tbody">
            </div>
        </div>

         <div id="events" class="container mt-10">
            <div id="headerRow" class="row">
                <div class='col-5 border'>Ressources
                </div>
                <div class='col-1 border'>Lundi
                </div>
                 <div class='col-1 border'>Mardi
                </div>
                 <div class='col-1 border'>Mercredi
                </div>
                 <div class='col-1 border'>Jeudi
                </div>
                 <div class='col-1 border'>Vendredi
                </div>
                 <div class='col-1 border'>Samedi
                </div>
                 <div class='col-1 border'>Dimanche
                </div>
            </div>
            <div id="tbody">
                <div class="row  position-relative">
                         <div class='col-5 border'>Ressource 1
                        </div>
                        <div id='11' class='col-1 border'>
                        </div>
                         <div id='12'class='col-1 border'>
                            <span class="badge bg-warning position-absolute days-2">Reservation 1</span>
                        </div>
                         <div id='13'class='col-1 border'>
                        </div>
                         <div id='14'class='col-1 border'>
                        </div>
                         <div id='15'class='col-1 border'>
                        </div>
                         <div id='16'class='col-1 border'>
                        </div>
                         <div id='17' class='col-1 border'>
                        </div>
                </div>
                <div class="row">
                         <div class='col-5 border'>Ressource 2
                        </div>
                        <div class='col-1 border'>
                        </div>
                         <div class='col-1 border'>
                        </div>
                         <div class='col-1 border'>
                        </div>
                         <div class='col-1 border'>
                        </div>
                         <div class='col-1 border'>
                        </div>
                         <div class='col-1 border'>
                        </div>
                         <div class='col-1 border'>
                        </div>
                </div>
                <div class="row">
                         <div class='col-5 border'>Ressource 3
                        </div>
                        <div class='col-1 border'>
                        </div>
                         <div class='col-1 border'>
                        </div>
                         <div class='col-1 border'>
                        </div>
                         <div class='col-1 border'>
                        </div>
                         <div class='col-1 border'>
                        </div>
                         <div class='col-1 border'>
                        </div>
                         <div class='col-1 border'>
                        </div>
                </div>

            </div>
        </div>
         
