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
                    <?= $this->Html->link('Retour à la liste des domaines', ['controller' => 'Pages', 'action' => 'catalogue']); ?>          
                    <div class = "row card-spacing">

                <!-- liste des resources non archivées du domaine -->

                <?php 
                    if (!empty($domain->resources)) :

                        foreach ($domain->resources as $resource) :

                            if(!$resource->archive):

                                $relatedFilesContent = '';


                            

                                //création de la liste des fichiers associés à la resource
                                if(!empty($resource->files)):

                                    $relatedFilesContent .= '<div> Fichiers : </div><ul>';

                                    foreach($resource->files as $file):

                                        $relatedFilesContent .= '<li>'.$this->Html->link($file->name,[ 'controller' => 'Files','action' => 'download',$file->id, ],['target' => '_blank']).'</li>';

                                    endforeach;

                                        $relatedFilesContent .= '</ul>';

                                    endif;
                ?>






                                <!-- Affichage des tuiles des resources.-->      
                                
                                <div class="col-lg-12 col-md-12 col-sm-12">  
                                    <div class='card resources-card'>
                                         <?= $this->Html->image('resources/'.$resource->picture_path,['class'=>'resources-card-img-top  ']) ?>
                                                <div class='tile-content resources-tile-content'>
                                                    <span class='title-wrapper'>
                                                        <h4 class='resources-card-title'><?= $resource->name ?></h4>
                                                    </span>                                         
                                                </div>
                                                 <div class='card-body p-1 resources-card-body'>
                                                       <?=  $relatedFilesContent ?>
                                                </div>
                                               
                                          <!-- $this->Html->link("", ['controller'=>'resources', 'action' => 'view', $resource->id], ['class' => 'stretched-link']);  -->
                                     </div>
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
</aside>
</div>
