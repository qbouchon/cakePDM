
<!-- User element on navbar -->
<ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-lg"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><div class="flex" align="center"><h4><?= $this->getRequest()->getAttribute('identity')->get('username'); ?></h4></div></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><div class="flex text-center"><?= $this->Html->link('Deconnexion', ['controller'=>'Users','action' => 'logout'], ['class' => 'dropdown-item text-danger']) ?></div></li>
                    </ul>
                </li>
</ul> 