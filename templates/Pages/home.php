<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Domain> $domains
 */
?>

<div class="container">
        <?= $this->Html->image('home/'.$configuration->home_picture_path,['class'=>'img-fluid mb-4 mt-2']); ?>


    <?= $configuration->home_text; ?>
</div>

        <div class="container h-100 d-flex flex-column">          
            <div class = "row card-spacing card-deck">


                <?php foreach ($domains as $domain): ?>

                    


                    <!-- Affichage des tuiles des domaines.-->      
                    
                    <div class="col-lg-3 col-md-6 col-sm-12">  
                        <div class='card'>

                                    <div class='tile-content'>
                                        <span class='title-wrapper'>
                                            <h4><?= $domain->name ?></h4>
                                        </span>                                         
                                    </div>
                                     <div class='card-body rounded-top p-1'>
                                           
                                    </div>
                                    <?= $this->Html->image('domains/'.$domain->picture_path,['class'=>'card-img-top rounded-bottom']) ?>
                            <?= $this->Html->link("", ['controller'=>'domains', 'action' => 'viewResources', $domain->id], ['class' => 'stretched-link']); ?>
                         </div>
                    </div>

                        

                        
                    <?php  endforeach; ?>   
                    <!-- fin tuiles -->

                    

                </div>
        </div>

    </div>
</div>