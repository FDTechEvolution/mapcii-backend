<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Address $address
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Addresses'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Subdistricts'), ['controller' => 'Subdistricts', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Subdistrict'), ['controller' => 'Subdistricts', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Districts'), ['controller' => 'Districts', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New District'), ['controller' => 'Districts', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Provinces'), ['controller' => 'Provinces', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Province'), ['controller' => 'Provinces', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Assets'), ['controller' => 'Assets', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Asset'), ['controller' => 'Assets', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List User Addresses'), ['controller' => 'UserAddresses', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User Address'), ['controller' => 'UserAddresses', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="addresses form large-9 medium-8 columns content">
    <?= $this->Form->create($address) ?>
    <fieldset>
        <legend><?= __('Add Address') ?></legend>
        <?php
            echo $this->Form->control('address1');
            echo $this->Form->control('address2');
            echo $this->Form->control('moo');
            echo $this->Form->control('soi');
            echo $this->Form->control('subdistrict_id', ['options' => $subdistricts, 'empty' => true]);
            echo $this->Form->control('district_id', ['options' => $districts, 'empty' => true]);
            echo $this->Form->control('province_id', ['options' => $provinces, 'empty' => true]);
            echo $this->Form->control('street');
            echo $this->Form->control('zipcode');
            echo $this->Form->control('description');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
