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

    <!-- tippy.js tooltip library https://atomiks.github.io/tippyjs/ -->
    <?= $this->Html->script('../tippy.js/dist/tippy-bundle.umd');?>
    <?= $this->Html->css('../tippy.js/dist/tippy');?>

    

    <!-- tinyMCE, wysiwyg editor https://www.tiny.cloud/-->
    <?= $this->Html->script('../tinymce/tinymce.js'); ?>

    <!-- fecha.js manipulation et formattage dates https://github.com/taylorhakes/fecha -->
    <?= $this->Html->script('../fecha/dist/fecha.min');?> 

    <!-- benitolopez datepicker https://github.com/benitolopez/hotel-datepicker -->
    <!-- hotel-datepicker modifié pour les besoins -->
    <?= $this->Html->script('../hotel-datepicker/dist/js/uga-datepicker');?>
    <?= $this->Html->css('../hotel-datepicker/dist/css/hotel-datepicker');?> 


    <!-- pour le js, trouver une meilleure pratique -->
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
            
            <?= $this->getRequest()->getAttribute('identity') ? $this->element('user_navbar') : ''; ?>
            
     
        </nav>
        

        <!-- side menu -->
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                        <?php 
                        
                                $user = $this->getRequest()->getAttribute('identity');

                                if($user)
                                {
                                    echo $this->element('user_menu');
                                    
                                    if($user->get('admin'))
                                            echo $this->element('admin_menu'); 
                                }
                                
                                   
                         ?>

                        </div>
                    </div>
                                
                    <div class="sb-sidenav-footer">
                         <?= $this->Html->image("logo_UI_blanc3.png", ['class' => 'img-fluid']); ?>
                         <!-- <div id="signature" class="small text-center">cakePDM@ptitbouchon 2023</div> -->
                    </div>

                </nav>
            </div>

                        <div id="layoutSidenav_content" class = "">
                            <main>
                                <div class="container-fluid">                                    
                                    
                                    <div class="row">
                                        <div class="col">
                                            <?= $this->Flash->render(); ?>
                                            <div class="mt-3">
                                                <?= $this->fetch('content'); ?>
                                            </div>
                                             
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
