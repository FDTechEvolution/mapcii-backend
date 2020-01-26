<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Appsetting $appsetting
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Appsetting'), ['action' => 'edit', $appsetting->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Appsetting'), ['action' => 'delete', $appsetting->id], ['confirm' => __('Are you sure you want to delete # {0}?', $appsetting->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Appsettings'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Appsetting'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="appsettings view large-9 medium-8 columns content">
    <h3><?= h($appsetting->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= h($appsetting->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Email Receiver Contact') ?></th>
            <td><?= h($appsetting->email_receiver_contact) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Email Receiver Seller') ?></th>
            <td><?= h($appsetting->email_receiver_seller) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Email Receiver Purchase') ?></th>
            <td><?= h($appsetting->email_receiver_purchase) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($appsetting->created) ?></td>
        </tr>
    </table>
</div>
