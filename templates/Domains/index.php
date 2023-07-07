<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Domain> $domains
 */
?>
<div class="container">
    <div class="domains index content">

        <h3 class="text-center font-weight-bold"><?= __('Domaines') ?></h3>
        <div>
        </div>

        <div class="container h-100 d-flex flex-column">          
            <div class = "row card-spacing">





                <?php foreach ($domains as $domain):

                    $dropdown = '<div class="dropdown">
                                <button  class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                   tets
                                </button>
                                <ul class="dropdown-menu">
                                    <li>'.$this->Html->link(__('View'), ['action' => 'view', $domain->id],['class' => 'dropdown-item']).'</li>
                                    
                                    <li>'.$this->Html->link(__('Edit'), ['action' => 'edit', $domain->id],['class' => 'dropdown-item']).'</li>  
                                </ul>
                            </div>';
                ?>

                    <!-- Affichage des tuiles des domaines.-->      
                    <div class="col-lg-3 col-md-6 col-sm-12">              
                        <?= $this->Html->link('                     
                            <div class="card h-100 ">' .
                            $this->Html->image('domains/'.$domain->picture_path,['class'=>'card-img-top'])  . 
                            '<div class="card-body">
                            <div class="tile-content">'.$dropdown.'<span class="title-wrapper"><h4> ' .
                            $domain->name . 
                            '</h4></span></div>
                            </div>
                            </div>', ['action' => 'viewResources', $domain->id], ['escape' => false]) ?>
                        </div>
                        
                    <?php  endforeach; ?>   
                    <!-- fin tuiles -->

                    

                </div>

            </div>