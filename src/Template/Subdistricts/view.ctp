<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Subdistrict $subdistrict
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Subdistrict'), ['action' => 'edit', $subdistrict->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Subdistrict'), ['action' => 'delete', $subdistrict->id], ['confirm' => __('Are you sure you want to delete # {0}?', $subdistrict->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Subdistricts'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Subdistrict'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Districts'), ['controller' => 'Districts', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New District'), ['controller' => 'Districts', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Addresses'), ['controller' => 'Addresses', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Address'), ['controller' => 'Addresses', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="subdistricts view large-9 medium-8 columns content">
    <h3><?= h($subdistrict->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Code') ?></th>
            <td><?= h($subdistrict->code) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($subdistrict->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('District') ?></th>
            <td><?= $subdistrict->has('district') ? $this->Html->link($subdistrict->district->name, ['controller' => 'Districts', 'action' => 'view', $subdistrict->district->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($subdistrict->id) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Addresses') ?></h4>
        <?php if (!empty($subdistrict->addresses)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Address1') ?></th>
                <th scope="col"><?= __('Address2') ?></th>
                <th scope="col"><?= __('Moo') ?></th>
                <th scope="col"><?= __('Soi') ?></th>
                <th scope="col"><?= __('Subdistrict Id') ?></th>
                <th scope="col"><?= __('District Id') ?></th>
                <th scope="col"><?= __('Province Id') ?></th>
                <th scope="col"><?= __('Street') ?></th>
                <th scope="col"><?= __('Zipcode') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Description') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($subdistrict->addresses as $addresses): ?>
            <tr>
                <td><?= h($addresses->id) ?></td>
                <td><?= h($addresses->address1) ?></td>
                <td><?= h($addresses->address2) ?></td>
                <td><?= h($addresses->moo) ?></td>
                <td><?= h($addresses->soi) ?></td>
                <td><?= h($addresses->subdistrict_id) ?></td>
                <td><?= h($addresses->district_id) ?></td>
                <td><?= h($addresses->province_id) ?></td>
                <td><?= h($addresses->street) ?></td>
                <td><?= h($addresses->zipcode) ?></td>
                <td><?= h($addresses->created) ?></td>
                <td><?= h($addresses->description) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Addresses', 'action' => 'view', $addresses->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Addresses', 'action' => 'edit', $addresses->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Addresses', 'action' => 'delete', $addresses->id], ['confirm' => __('Are you sure you want to delete # {0}?', $addresses->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
