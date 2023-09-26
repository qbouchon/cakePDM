<?php
/**
 * @var \App\View\AppView $this
 */
?>

<?php $this->assign('title', 'CREST - Login'); ?>

<div class="container">                
          <div class="row mt-2">
                <div class = "col-8 px-5 pt-1 pb-4 mx-auto bg-white rounded"> 
                        <?= $this->Form->create() ?>
                        <fieldset>
                            <h3 class="text-center"><?= __('Authentification') ?></h3>
                            <?= $this->Form->control('username',['label'=>'Utilisateur']) ?>
                            <?= $this->Form->control('password',['label'=>'Mot de passe']) ?>
                        </fieldset>
                        <?= $this->Form->button(__('Login')); ?>
                        <?= $this->Form->end() ?>
                </div>
            </div>
</div>
