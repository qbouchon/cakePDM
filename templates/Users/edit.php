<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>

<?php $this->assign('title', 'CREST - Utilisateurs'); ?>


<div class="container">   
        <div class="row mt-2">
                <div class = "col-8 px-5 pt-1 pb-4 mx-auto bg-white rounded">  
                        <?= $this->Form->create($user) ?>
                        <fieldset>
                            
                            <div class='d-flex justify-content-between align-items-center'>
                                <i onclick="history.back();" class="backButton fa-solid fa-left-long fa-xl"></i>
                                <h3 class="text-center"><?= __('Modifier un utilisateur') ?></h3>
                                <div></div>
                            </div>
                            <?php
                                echo $this->Form->control('firstname');
                                echo $this->Form->control('lastname');
                                echo $this->Form->control('username');
                                echo $this->Form->control('email');
                                echo $this->Form->control('admin');
                            ?>
                        </fieldset>
                        <?= $this->Form->button(__('Submit')) ?>
                        <?= $this->Form->end() ?>
                </div>
        </div>
</div>
