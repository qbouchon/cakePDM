<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Configuration $configuration
 */
?>

<?php $this->assign('title', 'CREST - Configuration'); ?>


<div class="container">   

    <div class="row mt-2">   
 
        <h3 class="text-center font-weight-bold mb-3"><?= __('Configuration') ?></h3>

        <?= $this->Form->create($configuration, ['type' => 'file']) ?>
       
        <fieldset>

            <div class = "col-8 px-5 pt-1 pb-4 mx-auto bg-white rounded">

                <div class='d-flex justify-content-between align-items-center'>
                        <h4 class="font-weight-bold mt-3"><?= __('Personnaliser le mail de relance') ?></h4>
                        <i class="fa-solid helpMailButton fa-circle-question fa-xl mt-3"></i>
                </div>  

                <div class="mt-1">
                    <?= $this->Form->control('reminder_mail_object',['label'=>'Objet du mail']); ?>
                </div>

                <div class="mt-4">
                    <?= $this->Form->control('reminder_mail_text',['label'=>false]); ?>
                </div>
                <h4 class="font-weight-bold"><?= __('Envois de mails automatiques') ?></h4>

                <div class="d-flex justify-content-between align-items-center">
                    <?= $this->Form->control('send_mail_resa_admin',['label'=>'Envoyer un mail aux administrateurs à chaque nouvelle réservation d\'un utilisateur']); ?>
                    <i id='display_edit_send_mail_resa_admin' class="fa-solid fa-pen-to-square fa-lg editMailButton mb-3"></i>
                </div>
                <div id='edit_send_mail_resa_admin' class='displaynone'>
                    <?= $this->Form->control('send_mail_resa_admin_object',['label'=>'Objet du mail']); ?>
                    <?= $this->Form->control('send_mail_resa_admin_text',['label'=>false]); ?>
                </div>

                <div class="d-flex justify-content-between align-items-center">
                    <?= $this->Form->control('send_mail_edit_resa_admin',['label'=>'Envoyer un mail aux administrateurs à chaque modification de réservation']); ?>
                    <i id='display_edit_send_mail_edit_resa_admin' class="fa-solid fa-pen-to-square fa-lg editMailButton  mb-3"></i>
                </div>
                <div id='edit_send_mail_edit_resa_admin' class='displaynone'>
                    <?= $this->Form->control('send_mail_edit_resa_admin_object',['label'=>'Objet du mail']); ?>
                    <?= $this->Form->control('send_mail_edit_resa_admin_text',['label'=>false]); ?>
                </div>

                <div class="d-flex justify-content-between align-items-center">
                    <?= $this->Form->control('send_mail_delete_resa_admin',['label'=>'Envoyer un mail aux administrateurs à chaque suppression de  réservation']); ?>
                    <i id='display_edit_send_mail_delete_resa_admin' class="fa-solid fa-pen-to-square fa-lg editMailButton  mb-3"></i>
                </div>
                <div id='edit_send_mail_delete_resa_admin' class='displaynone'>
                    <?= $this->Form->control('send_mail_delete_resa_admin_object',['label'=>'Objet du mail']); ?>
                    <?= $this->Form->control('send_mail_delete_resa_admin_text',['label'=>false]); ?>
                </div>

                <div class="d-flex justify-content-between align-items-center">
                    <?= $this->Form->control('send_mail_resa_user',['label'=>'Envoyer un mail de confirmation à l\'utilisateur lors d\'une demande de réservation']); ?>
                    <i id='display_edit_send_mail_resa_user' class="fa-solid fa-pen-to-square fa-lg editMailButton  mb-3"></i>
                </div>
                <div id='edit_send_mail_resa_user' class='displaynone'>
                    <?= $this->Form->control('send_mail_resa_user_object',['label'=>'Objet du mail']); ?>
                    <?= $this->Form->control('send_mail_resa_user_text',['label'=>false]); ?>
                </div>

                <div class="d-flex justify-content-between align-items-center">
                    <?= $this->Form->control('send_mail_edit_resa_user',['label'=>'Envoyer un mail de confirmation à l\'utilisateur lors de la modification d\'une de ses réservation']); ?>
                    <i id='display_edit_send_mail_edit_resa_user' class="fa-solid fa-pen-to-square fa-lg editMailButton  mb-3"></i>
                </div>
                <div id='edit_send_mail_edit_resa_user' class='displaynone'>
                    <?= $this->Form->control('send_mail_edit_resa_user_object',['label'=>'Objet du mail']); ?>
                    <?= $this->Form->control('send_mail_edit_resa_user_text',['label'=>false]); ?>
                </div>

                <div class="d-flex justify-content-between align-items-center">
                    <?= $this->Form->control('send_mail_delete_resa_user',['label'=>'Envoyer un mail de confirmation à l\'utilisateur lors de la suppression d\'une de ses réservation']); ?>
                    <i id='display_edit_send_mail_delete_resa_user' class="fa-solid fa-pen-to-square fa-lg editMailButton  mb-3"></i>
                </div>
                <div id='edit_send_mail_delete_resa_user' class='displaynone'>
                    <?= $this->Form->control('send_mail_delete_resa_user_object',['label'=>'Objet du mail']); ?>
                    <?= $this->Form->control('send_mail_delete_resa_user_text',['label'=>false]); ?>
                </div>

                <div class="d-flex justify-content-between align-items-center">
                    <?= $this->Form->control('send_mail_back_resa_user',['label'=>'Envoyer un mail de confirmation à l\'utilisateur lorsqu\'une de ses réservation a été marquée comme rendue (ou non rendue)']); ?>
                    <i id='display_edit_send_mail_back_resa_user' class="fa-solid fa-pen-to-square fa-lg editMailButton mb-3"></i>
                </div>
                <div id='edit_send_mail_back_resa_user' class='displaynone'>
                    <?= $this->Form->control('send_mail_back_resa_user_object',['label'=>'Objet du mail']); ?>
                    <?= $this->Form->control('send_mail_back_resa_user_text',['label'=>false]); ?>
                </div>

                <div class="text-center mt-10">
                    <?= $this->Form->button(__('Enregistrer')) ?>
                    <?= $this->Form->end() ?>
                </div>

               


            </div>

        </fieldset>
           
    </div>
</div>


