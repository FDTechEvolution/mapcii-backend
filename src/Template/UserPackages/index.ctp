<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\UserPackage[]|\Cake\Collection\CollectionInterface $userPackages
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New User Package'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Packages'), ['controller' => 'Packages', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Package'), ['controller' => 'Packages', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="userPackages index large-9 medium-8 columns content">
    <h3><?= __('User Packages') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('package_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('plant') ?></th>
                <th scope="col"><?= $this->Paginator->sort('start_date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('end_date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('isexpire') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ispaid') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col"><?= $this->Paginator->sort('description') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($userPackages as $userPackage): ?>
            <tr>
                <td><?= h($userPackage->id) ?></td>
                <td><?= $userPackage->has('user') ? $this->Html->link($userPackage->user->title, ['controller' => 'Users', 'action' => 'view', $userPackage->user->id]) : '' ?></td>
                <td><?= $userPackage->has('package') ? $this->Html->link($userPackage->package->name, ['controller' => 'Packages', 'action' => 'view', $userPackage->package->id]) : '' ?></td>
                <td><?= h($userPackage->plant) ?></td>
                <td><?= h($userPackage->start_date) ?></td>
                <td><?= h($userPackage->end_date) ?></td>
                <td><?= h($userPackage->isexpire) ?></td>
                <td><?= h($userPackage->ispaid) ?></td>
                <td><?= h($userPackage->created) ?></td>
                <td><?= h($userPackage->modified) ?></td>
                <td><?= h($userPackage->description) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $userPackage->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $userPackage->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $userPackage->id], ['confirm' => __('Are you sure you want to delete # {0}?', $userPackage->id)]) ?>
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
