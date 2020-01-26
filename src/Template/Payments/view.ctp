<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Payment $payment
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Payment'), ['action' => 'edit', $payment->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Payment'), ['action' => 'delete', $payment->id], ['confirm' => __('Are you sure you want to delete # {0}?', $payment->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Payments'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Payment'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Financial Accounts'), ['controller' => 'FinancialAccounts', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Financial Account'), ['controller' => 'FinancialAccounts', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="payments view large-9 medium-8 columns content">
    <h3><?= h($payment->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= h($payment->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Documentno') ?></th>
            <td><?= h($payment->documentno) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Payment Method') ?></th>
            <td><?= h($payment->payment_method) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $payment->has('user') ? $this->Html->link($payment->user->title, ['controller' => 'Users', 'action' => 'view', $payment->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Status') ?></th>
            <td><?= h($payment->status) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Isapproved') ?></th>
            <td><?= h($payment->isapproved) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Financial Account') ?></th>
            <td><?= $payment->has('financial_account') ? $this->Html->link($payment->financial_account->name, ['controller' => 'FinancialAccounts', 'action' => 'view', $payment->financial_account->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Payment Slip') ?></th>
            <td><?= h($payment->payment_slip) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Amount') ?></th>
            <td><?= $this->Number->format($payment->amount) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Paymentdate') ?></th>
            <td><?= h($payment->paymentdate) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($payment->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($payment->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Description') ?></h4>
        <?= $this->Text->autoParagraph(h($payment->description)); ?>
    </div>
</div>
