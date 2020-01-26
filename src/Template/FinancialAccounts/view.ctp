<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\FinancialAccount $financialAccount
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Financial Account'), ['action' => 'edit', $financialAccount->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Financial Account'), ['action' => 'delete', $financialAccount->id], ['confirm' => __('Are you sure you want to delete # {0}?', $financialAccount->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Financial Accounts'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Financial Account'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Payments'), ['controller' => 'Payments', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Payment'), ['controller' => 'Payments', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="financialAccounts view large-9 medium-8 columns content">
    <h3><?= h($financialAccount->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= h($financialAccount->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($financialAccount->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Type') ?></th>
            <td><?= h($financialAccount->type) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Accountno') ?></th>
            <td><?= h($financialAccount->accountno) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($financialAccount->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($financialAccount->modified) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Payments') ?></h4>
        <?php if (!empty($financialAccount->payments)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Documentno') ?></th>
                <th scope="col"><?= __('Paymentdate') ?></th>
                <th scope="col"><?= __('Payment Method') ?></th>
                <th scope="col"><?= __('Amount') ?></th>
                <th scope="col"><?= __('Status') ?></th>
                <th scope="col"><?= __('Isapproved') ?></th>
                <th scope="col"><?= __('Financial Account Id') ?></th>
                <th scope="col"><?= __('Payment Slip') ?></th>
                <th scope="col"><?= __('Description') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($financialAccount->payments as $payments): ?>
            <tr>
                <td><?= h($payments->id) ?></td>
                <td><?= h($payments->documentno) ?></td>
                <td><?= h($payments->paymentdate) ?></td>
                <td><?= h($payments->payment_method) ?></td>
                <td><?= h($payments->amount) ?></td>
                <td><?= h($payments->status) ?></td>
                <td><?= h($payments->isapproved) ?></td>
                <td><?= h($payments->financial_account_id) ?></td>
                <td><?= h($payments->payment_slip) ?></td>
                <td><?= h($payments->description) ?></td>
                <td><?= h($payments->created) ?></td>
                <td><?= h($payments->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Payments', 'action' => 'view', $payments->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Payments', 'action' => 'edit', $payments->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Payments', 'action' => 'delete', $payments->id], ['confirm' => __('Are you sure you want to delete # {0}?', $payments->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
