<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Domain> $domains
 */
?>
<div class="container">
    <div class="domains index content">

        <h3 class="text-center font-weight-bold"><?= __('Catalogue') ?></h3>
    <div>
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
                             <?= $this->Html->link("", ['controller'=>'domains', 'action' => 'resources', $domain->id], ['class' => 'stretched-link']); ?>
                         </div>
                    </div>

                        

                        
                    <?php  endforeach; ?>   
                    <!-- fin tuiles -->

                    

            </div>

        </div>