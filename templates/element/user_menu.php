<!-- Menu utilisateur -->
<div class="text-white sb-sidenav-menu-heading">Menu Utilisateur</div>

<?= $this->Html->link('<div class="sb-nav-link-icon"><i class="fa-solid fa-house"></i></div>Accueil', ['controller'=>'pages','action' => 'display'], ['class' => 'nav-link', 'escape' => false]) ?>
<?= $this->Html->link('<div class="sb-nav-link-icon"><i class="fa-solid fa-book-open"></i></div>Catalogue', ['controller'=>'pages','action' => 'catalogue'], ['class' => 'nav-link', 'escape' => false]) ?>

<a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseUserReservations" aria-expanded="false" aria-controls="collapseUserReservations">
    <div class="sb-nav-link-icon"><i class="fa-regular fa-calendar-check"></i></i></div>
    <div class="nav-item">Réservations</div>
    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
</a>
<div class="collapse" id="collapseUserReservations" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
    <nav class="sb-sidenav-menu-nested nav">       
        <?= $this->Html->link(__('Mes réservations'), ['controller'=>'Reservations','action' => 'indexUser'], ['class' => 'nav-link']) ?>
        <?= $this->Html->link(__('Créer une réservation'), ['controller'=>'Reservations','action' => 'add'], ['class' => 'nav-link']) ?>
    </nav>
</div>
