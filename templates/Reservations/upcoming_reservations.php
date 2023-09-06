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

        <h3 class="text-center font-weight-bold"><?= __('Reservations à venir') ?></h3>


        <div id='fullCalendar'></div>


        <div id='eventModals'>
        </div>

    </div>
</div>