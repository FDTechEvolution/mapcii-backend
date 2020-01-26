<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\AssetOption[]|\Cake\Collection\CollectionInterface $assetOptions
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Asset Option'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Assets'), ['controller' => 'Assets', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Asset'), ['controller' => 'Assets', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Options'), ['controller' => 'Options', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Option'), ['controller' => 'Options', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="assetOptions index large-9 medium-8 columns content">
    <h3><?= __('Asset Options') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('asset_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('option_id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($assetOptions as $assetOption): ?>
            <tr>
                <td><?= h($assetOption->id) ?></td>
                <td><?= $assetOption->has('asset') ? $this->Html->link($assetOption->asset->name, ['controller' => 'Assets', 'action' => 'view', $assetOption->asset->id]) : '' ?></td>
                <td><?= $assetOption->has('option') ? $this->Html->link($assetOption->option->name, ['controller' => 'Options', 'action' => 'view', $assetOption->option->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $assetOption->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $assetOption->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $assetOption->id], ['confirm' => __('Are you sure you want to delete # {0}?', $assetOption->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
