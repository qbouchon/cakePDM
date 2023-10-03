<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Domain> $domains
 */
?>
<?php $this->assign('title', 'CREST - Accueil'); ?>

<div class="container">
    <div class = row>
        <div class = 'col-12 px-2 pt-1 pb-4 mx-auto bg-white rounded home-content'>
            <?= $this->Html->image('home/'.$configuration->home_picture_path,['class'=>'img-fluid mb-4 mt-2']); ?>

            <?= $configuration->home_text; ?>

            <div class="container h-100 d-flex flex-column home-content ">          
                <div class = "row card-spacing card-deck">

                    <?php foreach ($domains as $domain): ?>
                       
                        <!-- Affichage des tuiles des domaines.-->      
                        
                        <div class="col-xxl-3 col-lg-3 col-md-6 col-sm-12"> 
                            <div class='card domain-card'>
                                <div class='tile-content domain-tile-content'>
                                    <span class='title-wrapper domain-title-wrapper'>
                                        <div><?= $domain->name ?></div>
                                    </span>                                         
                                </div>
                                 <div class='card-body domain-card-body rounded-top p-1'>
                                       
                                </div>
                                <?= $this->Html->image('domains/'.$domain->picture_path,['class'=>'card-img-top domain-card-img-top rounded-bottom']) ?>
                                <?= $this->Html->link("", ['controller'=>'domains', 'action' => 'resources', $domain->id], ['class' => 'stretched-link']); ?>
                             </div>
                        </div>
                                                
                    <?php  endforeach; ?>   

                </div>
            </div>
        </div>
    </div>   
</div>