<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Payment $payment
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $payment->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $payment->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Payments'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Financial Accounts'), ['controller' => 'FinancialAccounts', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Financial Account'), ['controller' => 'FinancialAccounts', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="payments form large-9 medium-8 columns content">
    <?= $this->Form->create($payment) ?>
    <fieldset>
        <legend><?= __('Edit Payment') ?></legend>
        <?php
            echo $this->Form->control('documentno');
            echo $this->Form->control('paymentdate');
            echo $this->Form->control('payment_method');
            echo $this->Form->control('user_id', ['options' => $users]);
            echo $this->Form->control('amount');
            echo $this->Form->control('status');
            echo $this->Form->control('isapproved');
            echo $this->Form->control('financial_account_id', ['options' => $financialAccounts]);
            echo $this->Form->control('payment_slip');
            echo $this->Form->control('description');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
