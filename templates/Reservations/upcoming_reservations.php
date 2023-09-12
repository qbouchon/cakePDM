<?= $this->Html->script('../fullcalendar/index.global.min.js');?>
<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Reservation> $reservations
 */
?>

<?= $this->Html->script('reservations_calendar'); ?>

<?php
    echo $this->Html->scriptBlock(sprintf(
    'var csrfToken = %s;',
    json_encode($this->request->getAttribute('csrfToken'))
));
?>

<div class="container bg-white">
    <div class="reservations index content">

        <h3 class="text-center font-weight-bold"><?= __('Réservations à venir') ?></h3>

        <div class='row mt-4'>
           
            <!--  <div class="col-6">
                <div id='resume'>
                    <h4 class='mb-2 text-center'>Résumé pour cette semaine</h4>

                    <table class="table table-bordered table-hover table-sm table-responsive table-light">
                        <tr>
                            <th></th>
                            <th class="text-center">Départ</th>
                            <th class="text-center">Arrivées</th>
                        </tr>
                        <tr>
                                            <th>Lundi </th>
                                            <td></td>
                                            <td></td>
                        </tr>
                        <tr>
                                            <th>Mardi </th>
                                            <td></td>
                                            <td></td>
                        </tr>
                        <tr>
                                            <th>Mercredi </th>
                                            <td></td>
                                            <td></td>
                        </tr>
                        <tr>
                                            <th>Jeudi </th>
                                            <td></td>
                                            <td></td>
                        </tr>
                        <tr>
                                            <th>Vendredi </th>
                                            <td></td>
                                            <td></td>
                        </tr>


                    </table>

                </div>

                
            </div> -->
            <div class="col-2">
            </div>
            <div class="col-8">
                <!-- <h4 class='mb-2 text-center'>Calendrier</h4> -->
                <div id='fullCalendar'></div>
            </div>
            <div class="col-2">
            </div>
        </div>

        <div id='eventModals'>
        </div>

    </div>
</div>