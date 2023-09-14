<!-- Sous menu -->
                        <div class=" text-white sb-sidenav-menu-heading">Administration</div>
                           
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseReservations" aria-expanded="false" aria-controls="collapseReservations">
                               <div class="sb-nav-link-icon"><i class="fa-regular fa-calendar-check"></i></i></div>
                               <div class="nav-item">Réservations</div>
                               <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                           </a>
                           <div class="collapse" id="collapseReservations" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                    <nav class="sb-sidenav-menu-nested nav">       
                                            <?= $this->Html->link(__('Liste des réservations'), ['controller'=>'Reservations','action' => 'index'], ['class' => 'nav-link']) ?>
                                            <?= $this->Html->link(__('Statistiques'), ['controller'=>'Reservations','action' => 'stats'], ['class' => 'nav-link']) ?>
                                    </nav>
                            </div>
                        

                                                
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseRessources" aria-expanded="false" aria-controls="collapseRessources">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-suitcase-rolling"></i></i></div>
                                                       Ressources & Domaines
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                           <div class="collapse" id="collapseRessources" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                    <nav class="sb-sidenav-menu-nested nav">
                                            <?= $this->Html->link(__('Liste des Ressources'), ['controller'=>'Resources','action' => 'index'], ['class' => 'nav-link']) ?>
                                            <?= $this->Html->link(__('Liste des Domaines'), ['controller'=>'Domains','action' => 'index'], ['class' => 'nav-link']) ?>               
                                    </nav>
                            </div>
                                     
                         
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseUtilisateurs" aria-expanded="false" aria-controls="collapseUtilisateurs">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-user-group"></i></i></div>
                                                   Utilisateurs
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseUtilisateurs" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                    <nav class="sb-sidenav-menu-nested nav">
                                            <?= $this->Html->link(__('Liste des Utilisateurs'), ['controller'=>'Users','action' => 'index'], ['class' => 'nav-link']) ?>
                                    </nav>

                                               
                        </div>




                           <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseConfiguration" aria-expanded="false" aria-controls="collapseConfiguration">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-gear"></i></i></div>
                                                   Configuration
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseConfiguration" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                    <nav class="sb-sidenav-menu-nested nav">
                                            <?= $this->Html->link(__('Ecran d\'accueil'), ['controller'=>'configuration','action' => 'edit'], ['class' => 'nav-link']) ?>
                                    </nav>
                                     <nav class="sb-sidenav-menu-nested nav">
                                            <?= $this->Html->link(__('Dates de fermeture'), ['controller'=>'ClosingDates','action' => 'index'], ['class' => 'nav-link']) ?>
                                    </nav>

                                               
                        </div>