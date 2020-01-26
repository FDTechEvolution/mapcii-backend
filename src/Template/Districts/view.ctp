<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\District $district
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit District'), ['action' => 'edit', $district->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete District'), ['action' => 'delete', $district->id], ['confirm' => __('Are you sure you want to delete # {0}?', $district->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Districts'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New District'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Provinces'), ['controller' => 'Provinces', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Province'), ['controller' => 'Provinces', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Addresses'), ['controller' => 'Addresses', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Address'), ['controller' => 'Addresses', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Subdistricts'), ['controller' => 'Subdistricts', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Subdistrict'), ['controller' => 'Subdistricts', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="districts view large-9 medium-8 columns content">
    <h3><?= h($district->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Code') ?></th>
            <td><?= h($district->code) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($district->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Postcode') ?></th>
            <td><?= h($district->postcode) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Province') ?></th>
            <td><?= $district->has('province') ? $this->Html->link($district->province->name, ['controller' => 'Provinces', 'action' => 'view', $district->province->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($district->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Geoid') ?></th>
            <td><?= $this->Number->format($district->geoid) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Addresses') ?></h4>
        <?php if (!empty($district->addresses)): ?>
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
            <?php foreach ($district->addresses as $addresses): ?>
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
    <div class="related">
        <h4><?= __('Related Subdistricts') ?></h4>
        <?php if (!empty($district->subdistricts)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Code') ?></th>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col"><?= __('District Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($district->subdistricts as $subdistricts): ?>
            <tr>
                <td><?= h($subdistricts->id) ?></td>
                <td><?= h($subdistricts->code) ?></td>
                <td><?= h($subdistricts->name) ?></td>
                <td><?= h($subdistricts->district_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Subdistricts', 'action' => 'view', $subdistricts->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Subdistricts', 'action' => 'edit', $subdistricts->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Subdistricts', 'action' => 'delete', $subdistricts->id], ['confirm' => __('Are you sure you want to delete # {0}?', $subdistricts->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
