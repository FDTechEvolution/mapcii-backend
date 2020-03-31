<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PackageType $packageType
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Package Types'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Packages'), ['controller' => 'Packages', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Package'), ['controller' => 'Packages', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="packageTypes form large-9 medium-8 columns content">
    <?= $this->Form->create($packageType) ?>
    <fieldset>
        <legend><?= __('Add Package Type') ?></legend>
        <?php
            echo $this->Form->control('name');
            echo $this->Form->control('isactive');
            echo $this->Form->control('description');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
