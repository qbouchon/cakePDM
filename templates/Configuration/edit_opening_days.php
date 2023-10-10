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

                        
                        <div class="d-flex justify-content-between align-items-center">
                            <?= $this->Form->control('open_monday',['label'=>'Lundi']); ?>
                            <?= $this->Form->control('start_hour_monday',['label'=>'Ouverture']); ?>
                            <?= $this->Form->control('end_hour_monday',['label'=>'Fermeture']); ?>
                        </div>

                        <div class="d-flex justify-content-between align-items-center">
                            <?= $this->Form->control('open_tuesday', ['label' => 'Mardi']); ?>
                            <?= $this->Form->control('start_hour_tuesday', ['label' => 'Ouverture']); ?>
                            <?= $this->Form->control('end_hour_tuesday', ['label' => 'Fermeture']); ?>
                        </div>

                        <div class="d-flex justify-content-between align-items-center">
                            <?= $this->Form->control('open_wednesday', ['label' => 'Mercredi']); ?>
                            <?= $this->Form->control('start_hour_wednesday', ['label' => 'Ouverture']); ?>
                            <?= $this->Form->control('end_hour_wednesday', ['label' => 'Fermeture']); ?>
                        </div>

                        <div class="d-flex justify-content-between align-items-center">
                            <?= $this->Form->control('open_thursday', ['label' => 'Jeudi']); ?>
                            <?= $this->Form->control('start_hour_thursday', ['label' => 'Ouverture']); ?>
                            <?= $this->Form->control('end_hour_thursday', ['label' => 'Fermeture']); ?>
                        </div>

                        <div class="d-flex justify-content-between align-items-center">
                            <?= $this->Form->control('open_friday', ['label' => 'Vendredi']); ?>
                            <?= $this->Form->control('start_hour_friday', ['label' => 'Ouverture']); ?>
                            <?= $this->Form->control('end_hour_friday', ['label' => 'Fermeture']); ?>
                        </div>
                     

                        <div class="text-center">
                            <?= $this->Form->button(__('Enregistrer')) ?>
                            <?= $this->Form->end() ?>
                        </div>
                </div>

            </fieldset>
           
    </div>



