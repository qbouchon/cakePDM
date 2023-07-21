<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?= $this->fetch('title') ?>
    </title>
   
    <!-- favicons  www.univ-grenoble-alpes.fr -->
    <?= $this->Html->meta('icon', 'https://favicon-ksup.univ-grenoble-alpes.fr/SITEUI/favicon-16x16.png', ['type' => 'image/png', 'sizes' => '16x16']) ?>
    <?= $this->Html->meta('icon', 'https://favicon-ksup.univ-grenoble-alpes.fr/SITEUI/favicon-32x32.png', ['type' => 'image/png', 'sizes' => '32x32']) ?>
    <?= $this->Html->meta('icon', 'https://favicon-ksup.univ-grenoble-alpes.fr/SITEUI/favicon-96x96.png', ['type' => 'image/png', 'sizes' => '96x96']) ?>
    <?= $this->Html->meta('icon', 'https://favicon-ksup.univ-grenoble-alpes.fr/SITEUI/android-icon-192x192.png', ['type' => 'image/png', 'sizes' => '192x192']) ?>

    <?= $this->Html->meta('apple-touch-icon', 'https://favicon-ksup.univ-grenoble-alpes.fr/SITEUI/apple-icon-57x57.png', ['sizes' => '57x57']) ?>
    <?= $this->Html->meta('apple-touch-icon', 'https://favicon-ksup.univ-grenoble-alpes.fr/SITEUI/apple-icon-60x60.png', ['sizes' => '60x60']) ?>
    <?= $this->Html->meta('apple-touch-icon', 'https://favicon-ksup.univ-grenoble-alpes.fr/SITEUI/apple-icon-72x72.png', ['sizes' => '72x72']) ?>
    <?= $this->Html->meta('apple-touch-icon', 'https://favicon-ksup.univ-grenoble-alpes.fr/SITEUI/apple-icon-76x76.png', ['sizes' => '76x76']) ?>
    <?= $this->Html->meta('apple-touch-icon', 'https://favicon-ksup.univ-grenoble-alpes.fr/SITEUI/apple-icon-114x114.png', ['sizes' => '114x114']) ?>
    <?= $this->Html->meta('apple-touch-icon', 'https://favicon-ksup.univ-grenoble-alpes.fr/SITEUI/apple-icon-120x120.png', ['sizes' => '120x120']) ?>
    <?= $this->Html->meta('apple-touch-icon', 'https://favicon-ksup.univ-grenoble-alpes.fr/SITEUI/apple-icon-144x144.png', ['sizes' => '144x144']) ?>
    <?= $this->Html->meta('apple-touch-icon', 'https://favicon-ksup.univ-grenoble-alpes.fr/SITEUI/apple-icon-152x152.png', ['sizes' => '152x152']) ?>
    <?= $this->Html->meta('apple-touch-icon', 'https://favicon-ksup.univ-grenoble-alpes.fr/SITEUI/apple-icon-180x180.png', ['sizes' => '180x180']) ?>



    <!-- jquery -->
    <?= $this->Html->script('../Jquery/js/jquery.min'); ?>

    <!-- Bootstrap -->
    <?= $this->Html->css('BootstrapUI.bootstrap.min'); ?>
    <?= $this->Html->css(['BootstrapUI./font/bootstrap-icons', 'BootstrapUI./font/bootstrap-icon-sizes']); ?>
    <?= $this->Html->script(['BootstrapUI.popper.min', 'BootstrapUI.bootstrap.min']); ?>



    <!-- fontAwesome-->
    <?= $this->Html->script('../Fontawesome/js/all'); ?>
    <?= $this->Html->css('../Fontawesome./css/all'); ?>


    <!-- tinyMCE -->
    <?= $this->Html->script('../tinymce/tinymce.js'); ?>

    <!-- benitolopez datepicker https://github.com/benitolopez/hotel-datepicker -->
    <!-- fecha.js https://github.com/taylorhakes/fecha -->
    <?= $this->Html->script('../fecha/dist/fecha.min');?> 
    <!-- hotel-datepicker modifié pour les besoins -->
    <?= $this->Html->script('../hotel-datepicker/dist/js/uga-datepicker');?>
    <?= $this->Html->css('../hotel-datepicker/dist/css/hotel-datepicker');?> 


    <script>
        var webrootUrl = "<?php echo $this->Url->build('/', ['fullBase' => true]); ?>";
    </script>

    <!-- Css et Js pour les navbars -->
    <?= $this->Html->script('nav'); ?>
    <?= $this->Html->css('nav'); ?>

    <!-- css et js globaux de l'application -->
    <?= $this->Html->script('app'); ?>
    <?= $this->Html->css('app'); ?>



    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
    



</head>
<body>

    <!--  template menu (à déplacer, créer un élément ?) -->
    <div class="sb-nav-fixed">
        
        <nav class="sb-topnav navbar navbar-expand navbar-dark navbar-uga bg-uga">
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 ms-2 me-4 me-lg-0 text-white" id="sidebarToggle" href="#!"><i class="flex icon fas fa-bars fa-2x "></i></button>
            <!-- Navbar Brand-->
            <!-- <a class="ps-2 h3 text-white text-decoration-none " href="/">CREST</a> -->
            <?= $this->Html->Link('CREST', ['controller'=>'pages','action'=>'display'],['class'=>'ps-2 h3 text-white text-decoration-none font-weight-bold']); ?>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0 invisible">
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
                        <!-- <li><a class="dropdown-item" href="#!">Settings</a></li>
                        <li><a class="dropdown-item" href="#!">Activity Log</a></li> -->
                        

                        <li><div class="flex" align="center"><b><?= $user->username ?></b></div></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li>
                            <!-- <div class="flex"  align="center">Rôle(s) :
                                <div> Administrateur</div>
                                <div> Utilisateur </div>
                            </div> -->
                        </li>
                        <!-- <li><div class="flex" align="center"><a class="dropdown-item text-danger" href="">Deconnexion</a></div></li> -->
                        <li><div class="flex" align="center"></div><?= $this->Html->link('Deconnexion', ['controller'=>'Users','action' => 'logout'], ['class' => 'dropdown-item text-danger']) ?></li>
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

                         <?= $this->Html->link('<div class="sb-nav-link-icon"><i class="fa-solid fa-house"></i></div>Accueil', ['controller'=>'pages','action' => 'display'], ['class' => 'nav-link', 'escape' => false]) ?>
                          <?= $this->Html->link('<div class="sb-nav-link-icon"><i class="fa-solid fa-book-open"></i></div>Catalogue', ['controller'=>'pages','action' => 'catalogue'], ['class' => 'nav-link', 'escape' => false]) ?>

                         <a class="nav-link" href="">
                            <div class="sb-nav-link-icon"><i class="fa-regular fa-calendar-check"></i></div>
                            Réservation
                        </a>

                        <!-- Sous menu -->
                        <div class=" text-white sb-sidenav-menu-heading">Administration</div>

                        <div class="collapseOver">
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseReservations" aria-expanded="false" aria-controls="collapseReservations">
                               <div class="sb-nav-link-icon"><i class="fa-regular fa-calendar-check"></i></i></div>
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
                                                       <div class="sb-nav-link-icon"><i class="fa-solid fa-suitcase-rolling"></i></i></div>
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
                                                       
                                                        <?= $this->Html->link(__('Liste des Domaines'), ['controller'=>'Domains','action' => 'index'], ['class' => 'nav-link']) ?>
                                                    
                                                        
                                                    </nav>
                                                </div>
                                            </div>

                                            <div class="collapseOver">
                                                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseUtilisateurs" aria-expanded="false" aria-controls="collapseUtilisateurs">
                                                   <div class="sb-nav-link-icon"><i class="fa-solid fa-user-group"></i></i></div>
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


                                             <?= $this->Html->link('<div class="sb-nav-link-icon"><i class="fa-solid fa-gear"></i></div>Configuration', ['controller'=>'configuration','action' => 'edit'], ['class' => 'nav-link', 'escape' => false]) ?>

                                    </div>
                                </div>
                                
                                <div class="sb-sidenav-footer">
                                    <?= $this->Html->image("logo_UI_blanc3.png", ['class' => 'img-fluid']); ?>
                                    <div id="signature" class="small text-center">cakePDM@ptitbouchon 2023</div>
                                </div>

                            </nav>
                        </div>
                        <div id="layoutSidenav_content" class = "">
                            <main>
                                <div class="container-fluid">                                    
                                    
                                    <div class="row">
                                        <div class="col">
                                            <?= $this->Flash->render(); ?>
                                            <?= $this->fetch('content'); ?> 
                                            <div class="mb-5"></div>
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
                    <div id ="signature" class=" text-center">cakePDM@ptitbouchon 2023</div>
                </div>
            </div>
        </footer>




</body>
</html>
