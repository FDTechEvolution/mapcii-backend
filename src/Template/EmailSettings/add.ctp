<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\EmailSetting $emailSetting
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Email Settings'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="emailSettings form large-9 medium-8 columns content">
    <?= $this->Form->create($emailSetting) ?>
    <fieldset>
        <legend><?= __('Add Email Setting') ?></legend>
        <?php
            echo $this->Form->control('email_isenable');
            echo $this->Form->control('email_server');
            echo $this->Form->control('email_port');
            echo $this->Form->control('email_username');
            echo $this->Form->control('email_password');
            echo $this->Form->control('email_address');
            echo $this->Form->control('email_title');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
