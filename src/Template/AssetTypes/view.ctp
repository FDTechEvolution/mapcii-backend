<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\AssetType $assetType
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Asset Type'), ['action' => 'edit', $assetType->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Asset Type'), ['action' => 'delete', $assetType->id], ['confirm' => __('Are you sure you want to delete # {0}?', $assetType->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Asset Types'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Asset Type'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Images'), ['controller' => 'Images', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Image'), ['controller' => 'Images', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Asset Categories'), ['controller' => 'AssetCategories', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Asset Category'), ['controller' => 'AssetCategories', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Assets'), ['controller' => 'Assets', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Asset'), ['controller' => 'Assets', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="assetTypes view large-9 medium-8 columns content">
    <h3><?= h($assetType->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= h($assetType->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($assetType->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Image') ?></th>
            <td><?= $assetType->has('image') ? $this->Html->link($assetType->image->name, ['controller' => 'Images', 'action' => 'view', $assetType->image->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Asset Category') ?></th>
            <td><?= $assetType->has('asset_category') ? $this->Html->link($assetType->asset_category->name, ['controller' => 'AssetCategories', 'action' => 'view', $assetType->asset_category->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Seq') ?></th>
            <td><?= $this->Number->format($assetType->seq) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($assetType->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($assetType->modified) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Assets') ?></h4>
        <?php if (!empty($assetType->assets)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Code') ?></th>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col"><?= __('Asset Type Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Floor') ?></th>
                <th scope="col"><?= __('Bedroom') ?></th>
                <th scope="col"><?= __('Bathroom') ?></th>
                <th scope="col"><?= __('Kitchenroom') ?></th>
                <th scope="col"><?= __('Receptionroom') ?></th>
                <th scope="col"><?= __('Diningroom') ?></th>
                <th scope="col"><?= __('Maidroom') ?></th>
                <th scope="col"><?= __('Parking') ?></th>
                <th scope="col"><?= __('Description') ?></th>
                <th scope="col"><?= __('Address Id') ?></th>
                <th scope="col"><?= __('Isactive') ?></th>
                <th scope="col"><?= __('Issale') ?></th>
                <th scope="col"><?= __('Isrent') ?></th>
                <th scope="col"><?= __('Expire Date') ?></th>
                <th scope="col"><?= __('Price Sales') ?></th>
                <th scope="col"><?= __('Price Rent') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col"><?= __('Landsize') ?></th>
                <th scope="col"><?= __('Usefulspace') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($assetType->assets as $assets): ?>
            <tr>
                <td><?= h($assets->id) ?></td>
                <td><?= h($assets->code) ?></td>
                <td><?= h($assets->name) ?></td>
                <td><?= h($assets->asset_type_id) ?></td>
                <td><?= h($assets->user_id) ?></td>
                <td><?= h($assets->floor) ?></td>
                <td><?= h($assets->bedroom) ?></td>
                <td><?= h($assets->bathroom) ?></td>
                <td><?= h($assets->kitchenroom) ?></td>
                <td><?= h($assets->receptionroom) ?></td>
                <td><?= h($assets->diningroom) ?></td>
                <td><?= h($assets->maidroom) ?></td>
                <td><?= h($assets->parking) ?></td>
                <td><?= h($assets->description) ?></td>
                <td><?= h($assets->address_id) ?></td>
                <td><?= h($assets->isactive) ?></td>
                <td><?= h($assets->issale) ?></td>
                <td><?= h($assets->isrent) ?></td>
                <td><?= h($assets->expire_date) ?></td>
                <td><?= h($assets->price_sales) ?></td>
                <td><?= h($assets->price_rent) ?></td>
                <td><?= h($assets->created) ?></td>
                <td><?= h($assets->modified) ?></td>
                <td><?= h($assets->landsize) ?></td>
                <td><?= h($assets->usefulspace) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Assets', 'action' => 'view', $assets->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Assets', 'action' => 'edit', $assets->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Assets', 'action' => 'delete', $assets->id], ['confirm' => __('Are you sure you want to delete # {0}?', $assets->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
