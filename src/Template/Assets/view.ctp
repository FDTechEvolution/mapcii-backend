<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Asset $asset
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Asset'), ['action' => 'edit', $asset->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Asset'), ['action' => 'delete', $asset->id], ['confirm' => __('Are you sure you want to delete # {0}?', $asset->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Assets'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Asset'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Asset Types'), ['controller' => 'AssetTypes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Asset Type'), ['controller' => 'AssetTypes', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Addresses'), ['controller' => 'Addresses', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Address'), ['controller' => 'Addresses', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Asset Images'), ['controller' => 'AssetImages', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Asset Image'), ['controller' => 'AssetImages', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Asset Options'), ['controller' => 'AssetOptions', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Asset Option'), ['controller' => 'AssetOptions', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="assets view large-9 medium-8 columns content">
    <h3><?= h($asset->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= h($asset->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Code') ?></th>
            <td><?= h($asset->code) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($asset->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Asset Type') ?></th>
            <td><?= $asset->has('asset_type') ? $this->Html->link($asset->asset_type->name, ['controller' => 'AssetTypes', 'action' => 'view', $asset->asset_type->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $asset->has('user') ? $this->Html->link($asset->user->title, ['controller' => 'Users', 'action' => 'view', $asset->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Address') ?></th>
            <td><?= $asset->has('address') ? $this->Html->link($asset->address->id, ['controller' => 'Addresses', 'action' => 'view', $asset->address->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Isactive') ?></th>
            <td><?= h($asset->isactive) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Issale') ?></th>
            <td><?= h($asset->issale) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Isrent') ?></th>
            <td><?= h($asset->isrent) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Floor') ?></th>
            <td><?= $this->Number->format($asset->floor) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Bedroom') ?></th>
            <td><?= $this->Number->format($asset->bedroom) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Bathroom') ?></th>
            <td><?= $this->Number->format($asset->bathroom) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Kitchenroom') ?></th>
            <td><?= $this->Number->format($asset->kitchenroom) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Receptionroom') ?></th>
            <td><?= $this->Number->format($asset->receptionroom) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Diningroom') ?></th>
            <td><?= $this->Number->format($asset->diningroom) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Maidroom') ?></th>
            <td><?= $this->Number->format($asset->maidroom) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Parking') ?></th>
            <td><?= $this->Number->format($asset->parking) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Price Sales') ?></th>
            <td><?= $this->Number->format($asset->price_sales) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Price Rent') ?></th>
            <td><?= $this->Number->format($asset->price_rent) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Landsize') ?></th>
            <td><?= $this->Number->format($asset->landsize) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Usefulspace') ?></th>
            <td><?= $this->Number->format($asset->usefulspace) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Expire Date') ?></th>
            <td><?= h($asset->expire_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($asset->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($asset->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Description') ?></h4>
        <?= $this->Text->autoParagraph(h($asset->description)); ?>
    </div>
    <div class="related">
        <h4><?= __('Related Asset Images') ?></h4>
        <?php if (!empty($asset->asset_images)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Asset Id') ?></th>
                <th scope="col"><?= __('Image Id') ?></th>
                <th scope="col"><?= __('Isdefault') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Seq') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($asset->asset_images as $assetImages): ?>
            <tr>
                <td><?= h($assetImages->id) ?></td>
                <td><?= h($assetImages->asset_id) ?></td>
                <td><?= h($assetImages->image_id) ?></td>
                <td><?= h($assetImages->isdefault) ?></td>
                <td><?= h($assetImages->created) ?></td>
                <td><?= h($assetImages->seq) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'AssetImages', 'action' => 'view', $assetImages->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'AssetImages', 'action' => 'edit', $assetImages->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'AssetImages', 'action' => 'delete', $assetImages->id], ['confirm' => __('Are you sure you want to delete # {0}?', $assetImages->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Asset Options') ?></h4>
        <?php if (!empty($asset->asset_options)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Asset Id') ?></th>
                <th scope="col"><?= __('Option Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($asset->asset_options as $assetOptions): ?>
            <tr>
                <td><?= h($assetOptions->id) ?></td>
                <td><?= h($assetOptions->asset_id) ?></td>
                <td><?= h($assetOptions->option_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'AssetOptions', 'action' => 'view', $assetOptions->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'AssetOptions', 'action' => 'edit', $assetOptions->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'AssetOptions', 'action' => 'delete', $assetOptions->id], ['confirm' => __('Are you sure you want to delete # {0}?', $assetOptions->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
