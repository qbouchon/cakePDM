<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Domain $domain
 */
?>
<div class="row">
    
    <div class="column-responsive column-80">
        <div class="domains view content">
            <h3 class="text-center"><?= 'Liste des ressources du domaine '.h($domain->name) ?></h3>
         
            <div class="related ">
                <div class="container h-100 d-flex flex-column">          
                    <div class = "row card-spacing">

                <!-- liste des resources non archivées du domaine -->

                <?php 
                    if (!empty($domain->resources)) :

                        foreach ($domain->resources as $resource) :

                            if(!$resource->archive):

                 ?>


                






                    <div class="col-lg-4 col-md-6 col-sm-12">              
                        <?= $this->Html->link('                     
                            <div class="card h-100 ">' .
                            $this->Html->image('resources/'.$resource->picture_path,['class'=>'resource-card-img-top'])  . 
                            '<div class="card-body">'
                            .$resource->description.
                            '<div class="tile-content"><span class="title-wrapper"><h4> ' .
                            $resource->name . 
                            '</h4></span></div>
                            </div>
                            </div>', ['controller' => 'Resources', 'action' => 'view', $resource->id], ['escape' => false]) ?>
                    </div>

                <?php
                            endif;
                        endforeach;
                    endif;
                ?>


            </div>        
        </div>
    </div>
</div>

    <aside class="column">
     <div class="text-center">
        <?= $this->Html->link(__('List Domains'), ['action' => 'index'], ['class' => 'side-nav-item']) ?> 
        <?= $this->Html->link(__('Edit Domain'), ['action' => 'edit', $domain->id], ['class' => '']) ?> 
        <?= $this->Form->postLink(__('Delete Domain'), ['action' => 'delete', $domain->id], ['confirm' => __('Are you sure you want to delete # {0}?', $domain->id), 'class' => 'text-danger']) ?>
    </div>
</aside>
</div>
