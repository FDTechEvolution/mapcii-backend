<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\District $district
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $district->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $district->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Districts'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Provinces'), ['controller' => 'Provinces', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Province'), ['controller' => 'Provinces', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Addresses'), ['controller' => 'Addresses', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Address'), ['controller' => 'Addresses', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Subdistricts'), ['controller' => 'Subdistricts', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Subdistrict'), ['controller' => 'Subdistricts', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="districts form large-9 medium-8 columns content">
    <?= $this->Form->create($district) ?>
    <fieldset>
        <legend><?= __('Edit District') ?></legend>
        <?php
            echo $this->Form->control('code');
            echo $this->Form->control('name');
            echo $this->Form->control('postcode');
            echo $this->Form->control('geoid');
            echo $this->Form->control('province_id', ['options' => $provinces, 'empty' => true]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
