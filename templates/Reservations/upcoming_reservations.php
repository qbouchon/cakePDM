<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Reservation> $reservations
 */
?>

<?= $this->Html->script('search'); ?>

<div class="container">
    <div class="reservations index content">

        <h3 class="text-center font-weight-bold"><?= __('Reservations à venir') ?></h3>

        <?php
    foreach ($reservations as $reservation) {
        $content = $this->Html->link($reservation->id, ['action' => 'view', $reservation->id]);
        $this->Calendar->addRow($reservation->start_date, $content, ['class' => 'event']);
    }

    echo $this->Calendar->render();
?>

<?php if (!$this->Calendar->isCurrentMonth()) { ?>
    <?php echo $this->Html->link(__('Jump to the current month') . '...', ['action' => 'index'])?>
<?php } ?>
         
    </div>
</div>