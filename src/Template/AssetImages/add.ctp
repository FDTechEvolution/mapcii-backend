<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\AssetImage $assetImage
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Asset Images'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Assets'), ['controller' => 'Assets', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Asset'), ['controller' => 'Assets', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Images'), ['controller' => 'Images', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Image'), ['controller' => 'Images', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="assetImages form large-9 medium-8 columns content">
    <?= $this->Form->create($assetImage) ?>
    <fieldset>
        <legend><?= __('Add Asset Image') ?></legend>
        <?php
            echo $this->Form->control('asset_id', ['options' => $assets]);
            echo $this->Form->control('image_id', ['options' => $images]);
            echo $this->Form->control('isdefault');
            echo $this->Form->control('seq');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
