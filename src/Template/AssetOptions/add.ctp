<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\AssetOption $assetOption
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Asset Options'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Assets'), ['controller' => 'Assets', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Asset'), ['controller' => 'Assets', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Options'), ['controller' => 'Options', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Option'), ['controller' => 'Options', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="assetOptions form large-9 medium-8 columns content">
    <?= $this->Form->create($assetOption) ?>
    <fieldset>
        <legend><?= __('Add Asset Option') ?></legend>
        <?php
            echo $this->Form->control('asset_id', ['options' => $assets]);
            echo $this->Form->control('option_id', ['options' => $options]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
