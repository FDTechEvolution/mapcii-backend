<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Appsetting[]|\Cake\Collection\CollectionInterface $appsettings
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Appsetting'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="appsettings index large-9 medium-8 columns content">
    <h3><?= __('Appsettings') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('email_receiver_contact') ?></th>
                <th scope="col"><?= $this->Paginator->sort('email_receiver_seller') ?></th>
                <th scope="col"><?= $this->Paginator->sort('email_receiver_purchase') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($appsettings as $appsetting): ?>
            <tr>
                <td><?= h($appsetting->id) ?></td>
                <td><?= h($appsetting->email_receiver_contact) ?></td>
                <td><?= h($appsetting->email_receiver_seller) ?></td>
                <td><?= h($appsetting->email_receiver_purchase) ?></td>
                <td><?= h($appsetting->created) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $appsetting->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $appsetting->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $appsetting->id], ['confirm' => __('Are you sure you want to delete # {0}?', $appsetting->id)]) ?>
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
