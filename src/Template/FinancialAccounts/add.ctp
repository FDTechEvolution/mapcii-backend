<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\FinancialAccount $financialAccount
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Financial Accounts'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Payments'), ['controller' => 'Payments', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Payment'), ['controller' => 'Payments', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="financialAccounts form large-9 medium-8 columns content">
    <?= $this->Form->create($financialAccount) ?>
    <fieldset>
        <legend><?= __('Add Financial Account') ?></legend>
        <?php
            echo $this->Form->control('name');
            echo $this->Form->control('type');
            echo $this->Form->control('accountno');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
