<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Appsetting $appsetting
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $appsetting->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $appsetting->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Appsettings'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="appsettings form large-9 medium-8 columns content">
    <?= $this->Form->create($appsetting) ?>
    <fieldset>
        <legend><?= __('Edit Appsetting') ?></legend>
        <?php
            echo $this->Form->control('email_receiver_contact');
            echo $this->Form->control('email_receiver_seller');
            echo $this->Form->control('email_receiver_purchase');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
