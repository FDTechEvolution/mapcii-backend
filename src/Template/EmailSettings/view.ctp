<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\EmailSetting $emailSetting
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Email Setting'), ['action' => 'edit', $emailSetting->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Email Setting'), ['action' => 'delete', $emailSetting->id], ['confirm' => __('Are you sure you want to delete # {0}?', $emailSetting->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Email Settings'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Email Setting'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="emailSettings view large-9 medium-8 columns content">
    <h3><?= h($emailSetting->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Email Isenable') ?></th>
            <td><?= h($emailSetting->email_isenable) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Email Server') ?></th>
            <td><?= h($emailSetting->email_server) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Email Port') ?></th>
            <td><?= h($emailSetting->email_port) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Email Username') ?></th>
            <td><?= h($emailSetting->email_username) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Email Password') ?></th>
            <td><?= h($emailSetting->email_password) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Email Address') ?></th>
            <td><?= h($emailSetting->email_address) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Email Title') ?></th>
            <td><?= h($emailSetting->email_title) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($emailSetting->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($emailSetting->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Updated') ?></th>
            <td><?= h($emailSetting->updated) ?></td>
        </tr>
    </table>
</div>
