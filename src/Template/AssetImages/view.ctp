<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\AssetImage $assetImage
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Asset Image'), ['action' => 'edit', $assetImage->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Asset Image'), ['action' => 'delete', $assetImage->id], ['confirm' => __('Are you sure you want to delete # {0}?', $assetImage->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Asset Images'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Asset Image'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Assets'), ['controller' => 'Assets', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Asset'), ['controller' => 'Assets', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Images'), ['controller' => 'Images', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Image'), ['controller' => 'Images', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="assetImages view large-9 medium-8 columns content">
    <h3><?= h($assetImage->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= h($assetImage->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Asset') ?></th>
            <td><?= $assetImage->has('asset') ? $this->Html->link($assetImage->asset->name, ['controller' => 'Assets', 'action' => 'view', $assetImage->asset->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Image') ?></th>
            <td><?= $assetImage->has('image') ? $this->Html->link($assetImage->image->name, ['controller' => 'Images', 'action' => 'view', $assetImage->image->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Isdefault') ?></th>
            <td><?= h($assetImage->isdefault) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Seq') ?></th>
            <td><?= $this->Number->format($assetImage->seq) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($assetImage->created) ?></td>
        </tr>
    </table>
</div>
