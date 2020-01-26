<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Banner $banner
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Banner'), ['action' => 'edit', $banner->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Banner'), ['action' => 'delete', $banner->id], ['confirm' => __('Are you sure you want to delete # {0}?', $banner->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Banners'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Banner'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Images'), ['controller' => 'Images', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Image'), ['controller' => 'Images', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="banners view large-9 medium-8 columns content">
    <h3><?= h($banner->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= h($banner->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Type') ?></th>
            <td><?= h($banner->type) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $banner->has('user') ? $this->Html->link($banner->user->title, ['controller' => 'Users', 'action' => 'view', $banner->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Image') ?></th>
            <td><?= $banner->has('image') ? $this->Html->link($banner->image->name, ['controller' => 'Images', 'action' => 'view', $banner->image->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Description') ?></th>
            <td><?= h($banner->description) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Position') ?></th>
            <td><?= h($banner->position) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Isactive') ?></th>
            <td><?= h($banner->isactive) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Isapproved') ?></th>
            <td><?= h($banner->isapproved) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Createdby') ?></th>
            <td><?= h($banner->createdby) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($banner->created) ?></td>
        </tr>
    </table>
</div>
