<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\UserAddress $userAddress
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit User Address'), ['action' => 'edit', $userAddress->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete User Address'), ['action' => 'delete', $userAddress->id], ['confirm' => __('Are you sure you want to delete # {0}?', $userAddress->id)]) ?> </li>
        <li><?= $this->Html->link(__('List User Addresses'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User Address'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Addresses'), ['controller' => 'Addresses', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Address'), ['controller' => 'Addresses', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="userAddresses view large-9 medium-8 columns content">
    <h3><?= h($userAddress->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= h($userAddress->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $userAddress->has('user') ? $this->Html->link($userAddress->user->title, ['controller' => 'Users', 'action' => 'view', $userAddress->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Address') ?></th>
            <td><?= $userAddress->has('address') ? $this->Html->link($userAddress->address->id, ['controller' => 'Addresses', 'action' => 'view', $userAddress->address->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($userAddress->created) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Description') ?></h4>
        <?= $this->Text->autoParagraph(h($userAddress->description)); ?>
    </div>
</div>
