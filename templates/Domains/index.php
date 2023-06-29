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
    <div class = "row">

        <?php   
                $count = 1;
                foreach ($domains as $domain):
                    
                    if($count>6):
                        $count = 1;
        ?>
                        </div>
                        <div class="row">

        <?php       
                    endif; 
        ?>
 
                     <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="card h-100">
                          <?= $this->Html->image('./domains/'.$domain->picture,['class'=>'card-img-top']) ?>

                          <div class="card-body">
                            <div class="tile-content">
                              <h4 class="card-title"><?= $domain->name ?></h4>
                            </div>
                          </div>
                        </div>
                      </div>
        <?php   
                    $count++;   
                    endforeach;
        ?>   


  

    </div>

</div>