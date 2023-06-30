<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Domain> $domains
 */
?>
<div class="container">
    <div class="domains index content">
            <?= $this->Html->link(__('Créer un Domaine'), ['action' => 'add'], ['class' => 'button float-right']) ?>
            <h3 class="text-center font-weight-bold"><?= __('Domaines') ?></h3>
    <div>
</div>

<div class="container h-100 d-flex flex-column">          
    <div class = "row card-spacing">

        <!-- Affichage des tuiles de domaines. Pas super fier de ça. -->
        <?php   
                // $count = 1;
                foreach ($domains as $domain):
                    
                    // if($count>6):
                    //     $count = 1;
        ?>
                        <!-- </div> -->
                        <!-- <div class="row card-spacing"> -->

        <?php       
                    // endif; 
        ?>
                    <div class="col-lg-3 col-md-6 col-sm-12">
                    
                    <?= $this->Html->link('                     
                        <div class="card h-100 ">' .
                            $this->Html->image('./domains/'.$domain->picture,['class'=>'card-img-top'])  . 
                                '<div class="card-body">
                                    <div class="tile-content"><span class="title-wrapper"><h4> ' .
                                        $domain->name . 
                                    '</h4></span></div>
                                </div>
                        </div>', ['action' => 'view', $domain->id], ['escape' => false]) ?>

                    </div>
               
        <?php   
                    // $count++;   
                    endforeach;
        ?>   
        <!-- fin tuiles -->

  

    </div>

</div>