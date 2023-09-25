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
                            if (!empty($domain->resources)):

                                foreach ($domain->resources as $resource):

                                    if(!$resource->archive):

                                        $relatedFilesContent = '';

                                        //création de la liste des fichiers associés à la resource
                                        if(!empty($resource->files)):

                                                $relatedFilesContent .= '<div> <b>Fichiers : </b></div><ul>';

                                                foreach($resource->files as $file):

                                                    $relatedFilesContent .= '<li>'.$this->Html->link($file->name,[ 'controller' => 'Files','action' => 'download',$file->id, ],['target' => '_blank']).'</li>';

                                                endforeach;

                                                    $relatedFilesContent .= '</ul>';

                                        endif;
                        ?>






                                        <!-- Affichage des tuiles des resources.-->      
                                        
                                        <div class="col-lg-6 col-md-6 col-sm-1">  
                                            <div class='card resources-card'>

                                                <span class='title-wrapper'>
                                                        <h3 class='resources-card-title text-center mt-2 mb-3 mx-2'><?= $resource->name ?></h3>
                                                </span>  

                                                 <?= $this->Html->image('resources/'.$resource->picture_path,['class'=>'resources-card-img-top mx-auto']) ?>

                                                <div class='tile-content resources-tile-content'>   
                                                </div>
                                                        
                                                <div class='card-body p-1 resources-card-body mt-2 ms-3'>

                                                    <?= $resource->max_duration > 0 ? '<i>Durée max de réservation : </i>' . $resource->max_duration . ' jour(s).' : ''; ?> 

                                                    <?=  $relatedFilesContent ?>

                                                    <div class="text-center">

                                                        <?php 
                                                      
                                                            echo $this->Html->link("Détails", ['controller' => 'Resources', 'action' => 'view', $resource->id],['class' => 'btn btn-secondary mt-3 mx-auto me-1 mb-1']);

                                                            if($this->getRequest()->getAttribute('identity')->get('admin'))
                                                            {
                                                                echo $this->Html->link("Réserver", ['controller' => 'Reservations', 'action' => 'addForUser', $resource->id],['class' => 'btn btn-secondary mt-3 mx-auto mb-1']);
                                                            }
                                                            else
                                                                echo $this->Html->link("Réserver", ['controller' => 'Reservations', 'action' => 'add', $resource->id],['class' => 'btn btn-secondary mt-3 mx-auto mb-1']);
                                                        ?>

                                                    </div>

                                                </div>                                                        
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
    </div>
</div>
