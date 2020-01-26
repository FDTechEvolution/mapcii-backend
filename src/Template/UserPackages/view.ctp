<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\UserPackage $userPackage
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit User Package'), ['action' => 'edit', $userPackage->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete User Package'), ['action' => 'delete', $userPackage->id], ['confirm' => __('Are you sure you want to delete # {0}?', $userPackage->id)]) ?> </li>
        <li><?= $this->Html->link(__('List User Packages'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User Package'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Packages'), ['controller' => 'Packages', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Package'), ['controller' => 'Packages', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="userPackages view large-9 medium-8 columns content">
    <h3><?= h($userPackage->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= h($userPackage->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $userPackage->has('user') ? $this->Html->link($userPackage->user->title, ['controller' => 'Users', 'action' => 'view', $userPackage->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Package') ?></th>
            <td><?= $userPackage->has('package') ? $this->Html->link($userPackage->package->name, ['controller' => 'Packages', 'action' => 'view', $userPackage->package->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Plant') ?></th>
            <td><?= h($userPackage->plant) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Isexpire') ?></th>
            <td><?= h($userPackage->isexpire) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Ispaid') ?></th>
            <td><?= h($userPackage->ispaid) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Description') ?></th>
            <td><?= h($userPackage->description) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Start Date') ?></th>
            <td><?= h($userPackage->start_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('End Date') ?></th>
            <td><?= h($userPackage->end_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($userPackage->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($userPackage->modified) ?></td>
        </tr>
    </table>
</div>
