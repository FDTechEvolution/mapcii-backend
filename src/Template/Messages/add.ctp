<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Message $message
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Messages'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Assets'), ['controller' => 'Assets', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Asset'), ['controller' => 'Assets', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="messages form large-9 medium-8 columns content">
    <?= $this->Form->create($message) ?>
    <fieldset>
        <legend><?= __('Add Message') ?></legend>
        <?php
            echo $this->Form->control('type');
            echo $this->Form->control('msg');
            echo $this->Form->control('status');
            echo $this->Form->control('to');
            echo $this->Form->control('to_user');
            echo $this->Form->control('from_user');
            echo $this->Form->control('asset_id', ['options' => $assets, 'empty' => true]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
