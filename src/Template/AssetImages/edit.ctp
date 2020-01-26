<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\AssetImage $assetImage
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $assetImage->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $assetImage->id)]
            )
        ?></li>
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
        <legend><?= __('Edit Asset Image') ?></legend>
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
