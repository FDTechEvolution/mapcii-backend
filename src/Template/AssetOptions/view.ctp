<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\AssetOption $assetOption
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Asset Option'), ['action' => 'edit', $assetOption->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Asset Option'), ['action' => 'delete', $assetOption->id], ['confirm' => __('Are you sure you want to delete # {0}?', $assetOption->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Asset Options'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Asset Option'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Assets'), ['controller' => 'Assets', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Asset'), ['controller' => 'Assets', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Options'), ['controller' => 'Options', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Option'), ['controller' => 'Options', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="assetOptions view large-9 medium-8 columns content">
    <h3><?= h($assetOption->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= h($assetOption->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Asset') ?></th>
            <td><?= $assetOption->has('asset') ? $this->Html->link($assetOption->asset->name, ['controller' => 'Assets', 'action' => 'view', $assetOption->asset->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Option') ?></th>
            <td><?= $assetOption->has('option') ? $this->Html->link($assetOption->option->name, ['controller' => 'Options', 'action' => 'view', $assetOption->option->id]) : '' ?></td>
        </tr>
    </table>
</div>
