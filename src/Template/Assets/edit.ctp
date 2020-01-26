<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Asset $asset
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $asset->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $asset->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Assets'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Asset Types'), ['controller' => 'AssetTypes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Asset Type'), ['controller' => 'AssetTypes', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Addresses'), ['controller' => 'Addresses', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Address'), ['controller' => 'Addresses', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Asset Images'), ['controller' => 'AssetImages', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Asset Image'), ['controller' => 'AssetImages', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Asset Options'), ['controller' => 'AssetOptions', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Asset Option'), ['controller' => 'AssetOptions', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="assets form large-9 medium-8 columns content">
    <?= $this->Form->create($asset) ?>
    <fieldset>
        <legend><?= __('Edit Asset') ?></legend>
        <?php
            echo $this->Form->control('code');
            echo $this->Form->control('name');
            echo $this->Form->control('asset_type_id', ['options' => $assetTypes]);
            echo $this->Form->control('user_id', ['options' => $users]);
            echo $this->Form->control('floor');
            echo $this->Form->control('bedroom');
            echo $this->Form->control('bathroom');
            echo $this->Form->control('kitchenroom');
            echo $this->Form->control('receptionroom');
            echo $this->Form->control('diningroom');
            echo $this->Form->control('maidroom');
            echo $this->Form->control('parking');
            echo $this->Form->control('description');
            echo $this->Form->control('address_id', ['options' => $addresses, 'empty' => true]);
            echo $this->Form->control('isactive');
            echo $this->Form->control('issale');
            echo $this->Form->control('isrent');
            echo $this->Form->control('expire_date', ['empty' => true]);
            echo $this->Form->control('price_sales');
            echo $this->Form->control('price_rent');
            echo $this->Form->control('landsize');
            echo $this->Form->control('usefulspace');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
