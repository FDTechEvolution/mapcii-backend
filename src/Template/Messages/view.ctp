<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Message $message
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Message'), ['action' => 'edit', $message->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Message'), ['action' => 'delete', $message->id], ['confirm' => __('Are you sure you want to delete # {0}?', $message->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Messages'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Message'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Assets'), ['controller' => 'Assets', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Asset'), ['controller' => 'Assets', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="messages view large-9 medium-8 columns content">
    <h3><?= h($message->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= h($message->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Type') ?></th>
            <td><?= h($message->type) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Msg') ?></th>
            <td><?= h($message->msg) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Status') ?></th>
            <td><?= h($message->status) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('To') ?></th>
            <td><?= h($message->to) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('To User') ?></th>
            <td><?= h($message->to_user) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('From User') ?></th>
            <td><?= h($message->from_user) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Asset') ?></th>
            <td><?= $message->has('asset') ? $this->Html->link($message->asset->name, ['controller' => 'Assets', 'action' => 'view', $message->asset->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($message->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($message->modified) ?></td>
        </tr>
    </table>
</div>
