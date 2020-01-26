<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Users'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Images'), ['controller' => 'Images', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Image'), ['controller' => 'Images', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Assets'), ['controller' => 'Assets', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Asset'), ['controller' => 'Assets', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List User Addresses'), ['controller' => 'UserAddresses', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User Address'), ['controller' => 'UserAddresses', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List User Packages'), ['controller' => 'UserPackages', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User Package'), ['controller' => 'UserPackages', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="users form large-9 medium-8 columns content">
    <?= $this->Form->create($user) ?>
    <fieldset>
        <legend><?= __('Add User') ?></legend>
        <?php
            echo $this->Form->control('usercode');
            echo $this->Form->control('title');
            echo $this->Form->control('firstname');
            echo $this->Form->control('lastname');
            echo $this->Form->control('username');
            echo $this->Form->control('password');
            echo $this->Form->control('email');
            echo $this->Form->control('phone');
            echo $this->Form->control('lineid');
            echo $this->Form->control('fax');
            echo $this->Form->control('isactive');
            echo $this->Form->control('isverify');
            echo $this->Form->control('islocked');
            echo $this->Form->control('iscustomer');
            echo $this->Form->control('isseller');
            echo $this->Form->control('gender');
            echo $this->Form->control('verifycode');
            echo $this->Form->control('position');
            echo $this->Form->control('image_id', ['options' => $images, 'empty' => true]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
