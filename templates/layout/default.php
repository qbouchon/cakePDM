<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <!-- jquery -->
    <?= $this->Html->script('../Jquery/js/jquery.min'); ?>

    <!-- Bootstrap -->
    <?= $this->Html->css('BootstrapUI.bootstrap.min'); ?>
    <?= $this->Html->css(['BootstrapUI./font/bootstrap-icons', 'BootstrapUI./font/bootstrap-icon-sizes']); ?>
    <?= $this->Html->script(['BootstrapUI.popper.min', 'BootstrapUI.bootstrap.min']); ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
    
    <!-- Css et Js pour le menu de gauche -->
    <?= $this->Html->script('sideNav'); ?>
    <?= $this->Html->css('sideNav'); ?>

    <!-- css pour l'affichage des domaines -->
    <?= $this->Html->css('domains'); ?>

    <!-- js global -->
    <?= $this->Html->script('global'); ?>


    <!-- fontAwesome (trouver une manière plus propre ?) -->
    <?= $this->Html->script('../Fontawesome/js/all'); ?>
    <?= $this->Html->css('../Fontawesome./css/all'); ?>

</head>
<body>

        <!--  template menu (à déplacer, créer un élément ?) -->
        <div class="sb-nav-fixed">
            
            <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
                <!-- Sidebar Toggle-->
                <button class="btn btn-link btn-sm order-1 order-lg-0 ms-2 me-4 me-lg-0 text-white" id="sidebarToggle" href="#!"><i class="flex icon fas fa-bars fa-2x "></i></button>
                <!-- Navbar Brand-->
                <a class="ps-2 h3 text-white text-decoration-none " href="">CakePDM</a>
                <!-- Navbar Search-->
                <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                    <div class="input-group">
                        <input class="form-control" type="text" placeholder="Rechercher..." aria-label="Rechercher..." aria-describedby="btnNavbarSearch" />
                        <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
                    </div>
                </form>
                <!-- Navbar-->
                <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#!">Settings</a></li>
                            <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                            

                            <li><div class="flex" align="center"><b>Username</b></div></li>
                            <li><hr class="dropdown-divider" /></li>
                            <li>
                            <!-- <div class="flex"  align="center">Rôle(s) :
                                <div> Administrateur</div>
                                <div> Utilisateur </div>
                            </div> -->
                            </li>
                            <li><div class="flex" align="center"><a class="dropdown-item" href="">Deconnexion</a></div></li>
                        </ul>
                    </li>
                </ul> 
            </nav>
            

            <!-- side menu -->
            <div id="layoutSidenav">
                <div id="layoutSidenav_nav">
                    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                        <div class="sb-sidenav-menu">
                            <div class="nav">

                               <!-- Sous menu -->
                                <div class="text-white sb-sidenav-menu-heading">Menu Utilisateur</div>


                                    <a class="nav-link" href="">
                                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                        Réservation
                                    </a>

                                <!-- Sous menu -->
                                <div class=" text-white sb-sidenav-menu-heading">Administration</div>

                                            <div class="collapseOver">
                                                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseReservations" aria-expanded="false" aria-controls="collapseReservations">
                                                 <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                                 <div class="nav-item">Réservations</div>
                                                 <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                                </a>
                                                <div class="collapse" id="collapseReservations" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                                    <nav class="sb-sidenav-menu-nested nav">
                                                        <!-- <a class="nav-link" href="">Liste des Réservations</a>
                                                        <a class="nav-link" href="">Créer une Réservation</a> -->
                                                        <?= $this->Html->link(__('Liste des Réservations'), ['controller'=>'Reservations','action' => 'index'], ['class' => 'nav-link']) ?>
                                                        <?= $this->Html->link(__('Créer une Réservation'), ['controller'=>'Reservations','action' => 'add'], ['class' => 'nav-link']) ?>
                                                    </nav>
                                                </div>
                                            </div>

                                            <div class="collapseOver">
                                                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseRessources" aria-expanded="false" aria-controls="collapseRessources">
                                                 <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                                 Ressources & Domaines
                                                 <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                                </a>
                                                <div class="collapse" id="collapseRessources" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                                    <nav class="sb-sidenav-menu-nested nav">
                                                       <!--  <a class="nav-link" href="">Liste des Ressources</a>
                                                        <a class="nav-link" href="">Créer une Ressource</a>
                                                        <a class="nav-link" href="">Liste des Domaines</a>
                                                        <a class="nav-link" href="">Créer un Domaine</a> -->
                                                        <?= $this->Html->link(__('Liste des Ressources'), ['controller'=>'Resources','action' => 'index'], ['class' => 'nav-link']) ?>
                                                        <?= $this->Html->link(__('Créer une Ressource'), ['controller'=>'Resources','action' => 'add'], ['class' => 'nav-link']) ?>
                                                        <?= $this->Html->link(__('Liste des Domaines'), ['controller'=>'Domains','action' => 'index'], ['class' => 'nav-link']) ?>
                                                        <?= $this->Html->link(__('Créer un Domaine'), ['controller'=>'Domains','action' => 'add'], ['class' => 'nav-link']) ?>
                                                        
                                                    </nav>
                                                </div>
                                            </div>

                                            <div class="collapseOver">
                                                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseUtilisateurs" aria-expanded="false" aria-controls="collapseUtilisateurs">
                                                 <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                                 Utilisateurs
                                                 <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                                </a>
                                                <div class="collapse" id="collapseUtilisateurs" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                                    <nav class="sb-sidenav-menu-nested nav">
                                                        <!-- <a class="nav-link" href="">Liste des Utilisateurs</a> -->
                                                        <?= $this->Html->link(__('Liste des Utilisateurs'), ['controller'=>'Users','action' => 'index'], ['class' => 'nav-link']) ?>
                                                    </nav>
                                                </div>
                                            </div>
                            </div>
                        </div>
                         
                        <div class="sb-sidenav-footer">
                            <!-- <img id="logoUga" src="{{ asset('img/uga.svg') }}"/> -->
                            <div id="signature" class="small text-center">cakePDM@ptitbouchon 2023</div>
                        </div>

                    </nav>
                </div>
                <div id="layoutSidenav_content">
                    <main>
                     <!--    <div class="container-fluid">
                            <div class="row">
                                <div class="col">
                        //$this->Html->image('Bandeau CREST.png', ['alt' => 'CREST UGA']); 
                              </div>
                              </div>  --> 
                             <div class="container-fluid">
                                <div class="row"> 
                                    <div class="col">
                                        <?= $this->Html->link(__('Retour'), $this->request->referer()) ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                    <?= $this->fetch('content'); ?> 
                                    </div>
                                </div>
                            </div>
                    </main>
                </div>
            </div>

        </div>

    <footer>
         <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div id ="signature" class="text-muted text-center">PDM@ptitbouchon 2023</div>
                        </div>
         </div>
    </footer>




</body>
</html>
