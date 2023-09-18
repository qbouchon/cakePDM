<!-- Menu utilisateur -->
                         <div class="text-white sb-sidenav-menu-heading">Menu Utilisateur</div>

                         <?= $this->Html->link('<div class="sb-nav-link-icon"><i class="fa-solid fa-house"></i></div>Accueil', ['controller'=>'pages','action' => 'display'], ['class' => 'nav-link', 'escape' => false]) ?>
                          <?= $this->Html->link('<div class="sb-nav-link-icon"><i class="fa-solid fa-book-open"></i></div>Catalogue', ['controller'=>'pages','action' => 'catalogue'], ['class' => 'nav-link', 'escape' => false]) ?>
                        <?= $this->Html->link('<div class="sb-nav-link-icon"><i class="fa-regular fa-calendar-check"></i></div>Réservations', ['controller'=>'Reservations','action' => 'indexUser'], ['class' => 'nav-link', 'escape' => false]) ?>
