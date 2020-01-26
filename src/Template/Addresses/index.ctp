<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Address[]|\Cake\Collection\CollectionInterface $addresses
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Address'), ['action' => 'add']) ?></li>
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
<div class="addresses index large-9 medium-8 columns content">
    <h3><?= __('Addresses') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('address1') ?></th>
                <th scope="col"><?= $this->Paginator->sort('address2') ?></th>
                <th scope="col"><?= $this->Paginator->sort('moo') ?></th>
                <th scope="col"><?= $this->Paginator->sort('soi') ?></th>
                <th scope="col"><?= $this->Paginator->sort('subdistrict_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('district_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('province_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('street') ?></th>
                <th scope="col"><?= $this->Paginator->sort('zipcode') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($addresses as $address): ?>
            <tr>
                <td><?= h($address->id) ?></td>
                <td><?= h($address->address1) ?></td>
                <td><?= h($address->address2) ?></td>
                <td><?= h($address->moo) ?></td>
                <td><?= h($address->soi) ?></td>
                <td><?= $address->has('subdistrict') ? $this->Html->link($address->subdistrict->name, ['controller' => 'Subdistricts', 'action' => 'view', $address->subdistrict->id]) : '' ?></td>
                <td><?= $address->has('district') ? $this->Html->link($address->district->name, ['controller' => 'Districts', 'action' => 'view', $address->district->id]) : '' ?></td>
                <td><?= $address->has('province') ? $this->Html->link($address->province->name, ['controller' => 'Provinces', 'action' => 'view', $address->province->id]) : '' ?></td>
                <td><?= h($address->street) ?></td>
                <td><?= h($address->zipcode) ?></td>
                <td><?= h($address->created) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $address->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $address->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $address->id], ['confirm' => __('Are you sure you want to delete # {0}?', $address->id)]) ?>
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
