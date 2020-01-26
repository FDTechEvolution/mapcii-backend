<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Message[]|\Cake\Collection\CollectionInterface $messages
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Message'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Assets'), ['controller' => 'Assets', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Asset'), ['controller' => 'Assets', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="messages index large-9 medium-8 columns content">
    <h3><?= __('Messages') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('type') ?></th>
                <th scope="col"><?= $this->Paginator->sort('msg') ?></th>
                <th scope="col"><?= $this->Paginator->sort('status') ?></th>
                <th scope="col"><?= $this->Paginator->sort('to') ?></th>
                <th scope="col"><?= $this->Paginator->sort('to_user') ?></th>
                <th scope="col"><?= $this->Paginator->sort('from_user') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col"><?= $this->Paginator->sort('asset_id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($messages as $message): ?>
            <tr>
                <td><?= h($message->id) ?></td>
                <td><?= h($message->type) ?></td>
                <td><?= h($message->msg) ?></td>
                <td><?= h($message->status) ?></td>
                <td><?= h($message->to) ?></td>
                <td><?= h($message->to_user) ?></td>
                <td><?= h($message->from_user) ?></td>
                <td><?= h($message->created) ?></td>
                <td><?= h($message->modified) ?></td>
                <td><?= $message->has('asset') ? $this->Html->link($message->asset->name, ['controller' => 'Assets', 'action' => 'view', $message->asset->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $message->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $message->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $message->id], ['confirm' => __('Are you sure you want to delete # {0}?', $message->id)]) ?>
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
