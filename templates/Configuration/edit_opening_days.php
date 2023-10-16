<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Configuration $configuration
 */
?>

<?php $this->assign('title', 'CREST - Configuration'); ?>



     <div class="row mt-2">   
        
            <h3 class="text-center font-weight-bold mb-3"><?= __('Configuration') ?></h3>

            <?= $this->Form->create($configuration) ?>
           
            <fieldset>

                <div class = "col-8 px-5 pt-1 pb-4 mx-auto bg-white rounded">
                        <h4 class="font-weight-bold mt-3"><?= __('Définir les jours d\'ouverture') ?></h4>

                <div class="container">
                    <div class="row">
                        <div class="col-8">
                        
                            <table class="table mt-3">
                                <tr>
                                    <th></th>
                                    <td>Ouverture</td>
                                    <td >Fermeture</td>
                                </tr>
                                <tr >
                                    <th><?= $this->Form->control('open_monday',['label'=>'Lundi']); ?></th>
                                    <td> <?= $this->Form->control('start_hour_monday',['label'=>false,'class'=>'tiny-input']); ?></td>
                                    <td><?= $this->Form->control('end_hour_monday',['label'=>false,'class'=>'tiny-input ']); ?></td>
                                </tr>

                                <tr>
                                    <th><?= $this->Form->control('open_tuesday', ['label' => 'Mardi']); ?></th>
                                    <td><?= $this->Form->control('start_hour_tuesday',['label'=>false,'class'=>'tiny-input']); ?></td>
                                    <td><?= $this->Form->control('end_hour_tuesday', ['label'=>false,'class'=>'tiny-input']); ?></td>
                                </tr>

                                <tr>
                                    <th><?= $this->Form->control('open_wednesday', ['label' => 'Mercredi']); ?></th>
                                    <td><?= $this->Form->control('start_hour_wednesday', ['label'=>false,'class'=>'tiny-input ']); ?></td>
                                    <td><?= $this->Form->control('end_hour_wednesday', ['label'=>false,'class'=>'tiny-input']); ?></td>
                                </tr>

                                <tr>
                                    <th><?= $this->Form->control('open_thursday', ['label' => 'Jeudi']); ?></th>
                                    <td><?= $this->Form->control('start_hour_thursday',['label'=>false,'class'=>'tiny-input ']); ?></td>
                                    <td><?= $this->Form->control('end_hour_thursday', ['label'=>false,'class'=>'tiny-input']); ?></td>
                                </tr>

                                <tr>
                                    <th><?= $this->Form->control('open_friday', ['label' => 'Vendredi']); ?></th>
                                    <td><?= $this->Form->control('start_hour_friday', ['label'=>false,'class'=>'tiny-input']); ?></td>
                                    <td><?= $this->Form->control('end_hour_friday', ['label'=>false,'class'=>'tiny-input']); ?></td>
                                </tr>
                            </table>
                            
                            
                        </div>

                        <div class="col-4">
                        </div>
                    </div>
                </div>

                        <div class="text-center">
                            <?= $this->Form->button(__('Enregistrer')) ?>
                            <?= $this->Form->end() ?>
                        </div>
                </div>

            </fieldset>
           
    </div>



