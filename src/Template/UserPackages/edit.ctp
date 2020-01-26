<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\UserPackage $userPackage
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $userPackage->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $userPackage->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List User Packages'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Packages'), ['controller' => 'Packages', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Package'), ['controller' => 'Packages', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="userPackages form large-9 medium-8 columns content">
    <?= $this->Form->create($userPackage) ?>
    <fieldset>
        <legend><?= __('Edit User Package') ?></legend>
        <?php
            echo $this->Form->control('user_id', ['options' => $users]);
            echo $this->Form->control('package_id', ['options' => $packages]);
            echo $this->Form->control('plant');
            echo $this->Form->control('start_date');
            echo $this->Form->control('end_date');
            echo $this->Form->control('isexpire');
            echo $this->Form->control('ispaid');
            echo $this->Form->control('description');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
