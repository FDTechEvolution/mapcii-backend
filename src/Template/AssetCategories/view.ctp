<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\AssetCategory $assetCategory
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Asset Category'), ['action' => 'edit', $assetCategory->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Asset Category'), ['action' => 'delete', $assetCategory->id], ['confirm' => __('Are you sure you want to delete # {0}?', $assetCategory->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Asset Categories'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Asset Category'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Asset Types'), ['controller' => 'AssetTypes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Asset Type'), ['controller' => 'AssetTypes', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="assetCategories view large-9 medium-8 columns content">
    <h3><?= h($assetCategory->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= h($assetCategory->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($assetCategory->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Seq') ?></th>
            <td><?= $this->Number->format($assetCategory->seq) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($assetCategory->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($assetCategory->modified) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Asset Types') ?></h4>
        <?php if (!empty($assetCategory->asset_types)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col"><?= __('Image Id') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col"><?= __('Seq') ?></th>
                <th scope="col"><?= __('Asset Category Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($assetCategory->asset_types as $assetTypes): ?>
            <tr>
                <td><?= h($assetTypes->id) ?></td>
                <td><?= h($assetTypes->name) ?></td>
                <td><?= h($assetTypes->image_id) ?></td>
                <td><?= h($assetTypes->created) ?></td>
                <td><?= h($assetTypes->modified) ?></td>
                <td><?= h($assetTypes->seq) ?></td>
                <td><?= h($assetTypes->asset_category_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'AssetTypes', 'action' => 'view', $assetTypes->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'AssetTypes', 'action' => 'edit', $assetTypes->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'AssetTypes', 'action' => 'delete', $assetTypes->id], ['confirm' => __('Are you sure you want to delete # {0}?', $assetTypes->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
