<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\AssetImage[]|\Cake\Collection\CollectionInterface $assetImages
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Asset Image'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Assets'), ['controller' => 'Assets', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Asset'), ['controller' => 'Assets', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Images'), ['controller' => 'Images', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Image'), ['controller' => 'Images', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="assetImages index large-9 medium-8 columns content">
    <h3><?= __('Asset Images') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('asset_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('image_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('isdefault') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('seq') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($assetImages as $assetImage): ?>
            <tr>
                <td><?= h($assetImage->id) ?></td>
                <td><?= $assetImage->has('asset') ? $this->Html->link($assetImage->asset->name, ['controller' => 'Assets', 'action' => 'view', $assetImage->asset->id]) : '' ?></td>
                <td><?= $assetImage->has('image') ? $this->Html->link($assetImage->image->name, ['controller' => 'Images', 'action' => 'view', $assetImage->image->id]) : '' ?></td>
                <td><?= h($assetImage->isdefault) ?></td>
                <td><?= h($assetImage->created) ?></td>
                <td><?= $this->Number->format($assetImage->seq) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $assetImage->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $assetImage->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $assetImage->id], ['confirm' => __('Are you sure you want to delete # {0}?', $assetImage->id)]) ?>
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
