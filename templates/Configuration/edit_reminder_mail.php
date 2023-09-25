<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Configuration $configuration
 */
?>
<div class="container">   

    <div class="row mt-2">   
 
        <h3 class="text-center font-weight-bold mb-3"><?= __('Configuration') ?></h3>

        <?= $this->Form->create($configuration, ['type' => 'file']) ?>
       
        <fieldset>

            <div class = "col-8 px-5 pt-1 pb-4 mx-auto bg-white rounded">

                <h4 class="font-weight-bold mt-3"><?= __('Personnaliser le mail de relance') ?></h4>
                
                <div class="mt-4">
                    <?= $this->Form->control('reminder_mail_object',['label'=>'Objet du mail']); ?>
                </div>

                <div class="mt-4">
                    <?= $this->Form->control('reminder_mail_text',['label'=>false]); ?>
                </div>
                
                <div class="text-center">
                    <?= $this->Form->button(__('Enregistrer')) ?>
                    <?= $this->Form->end() ?>
                </div>

                <i>
                    Variables disponibles
                    <br/>
                    <b>$firstname :</b> prénom de l'utilisateur
                    <br/>
                    <b>$lastname :</b> nom de l'utilisateur
                    <br/>
                    <b>$login :</b> login de l'utilisateur
                    <br/>
                    <b>$resource :</b> nom de la ressource
                    <br/>
                    <b>$start :</b> Date de début de réservation
                    <br/>
                    <b>$end :</b> Date de fin de réservation
                    <br/>
                <i>

            </div>

        </fieldset>
           
    </div>
</div>


