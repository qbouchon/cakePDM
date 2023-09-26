<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Domain> $domains
 */
?>
<?php $this->assign('title', 'CREST - Catalogue'); ?>

<div class="container">
    <div class="domains index content">
        <h3 class="text-center font-weight-bold mb-4"><?= __('Catalogue') ?></h3>
    <div>
</div>
        
<div class="container h-100 d-flex flex-column">          
    <div class = "row card-spacing card-deck">

        <?php foreach ($domains as $domain): ?>

            <!-- Affichage des tuiles des domaines.-->      
            
            <div class="col-lg-3 col-md-6 col-sm-12">  
                <div class='card domain-card'>

                            <div class='tile-content domain-tile-content'>
                                <span class='title-wrapper domain-title-wrapper'>
                                    <h4><?= $domain->name ?></h4>
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