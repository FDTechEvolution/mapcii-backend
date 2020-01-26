<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Address $address
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Address'), ['action' => 'edit', $address->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Address'), ['action' => 'delete', $address->id], ['confirm' => __('Are you sure you want to delete # {0}?', $address->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Addresses'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Address'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Subdistricts'), ['controller' => 'Subdistricts', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Subdistrict'), ['controller' => 'Subdistricts', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Districts'), ['controller' => 'Districts', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New District'), ['controller' => 'Districts', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Provinces'), ['controller' => 'Provinces', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Province'), ['controller' => 'Provinces', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Assets'), ['controller' => 'Assets', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Asset'), ['controller' => 'Assets', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List User Addresses'), ['controller' => 'UserAddresses', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User Address'), ['controller' => 'UserAddresses', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="addresses view large-9 medium-8 columns content">
    <h3><?= h($address->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= h($address->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Address1') ?></th>
            <td><?= h($address->address1) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Address2') ?></th>
            <td><?= h($address->address2) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Moo') ?></th>
            <td><?= h($address->moo) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Soi') ?></th>
            <td><?= h($address->soi) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Subdistrict') ?></th>
            <td><?= $address->has('subdistrict') ? $this->Html->link($address->subdistrict->name, ['controller' => 'Subdistricts', 'action' => 'view', $address->subdistrict->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('District') ?></th>
            <td><?= $address->has('district') ? $this->Html->link($address->district->name, ['controller' => 'Districts', 'action' => 'view', $address->district->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Province') ?></th>
            <td><?= $address->has('province') ? $this->Html->link($address->province->name, ['controller' => 'Provinces', 'action' => 'view', $address->province->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Street') ?></th>
            <td><?= h($address->street) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Zipcode') ?></th>
            <td><?= h($address->zipcode) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($address->created) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Description') ?></h4>
        <?= $this->Text->autoParagraph(h($address->description)); ?>
    </div>
    <div class="related">
        <h4><?= __('Related Assets') ?></h4>
        <?php if (!empty($address->assets)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Code') ?></th>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col"><?= __('Asset Type Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Floor') ?></th>
                <th scope="col"><?= __('Bedroom') ?></th>
                <th scope="col"><?= __('Bathroom') ?></th>
                <th scope="col"><?= __('Kitchenroom') ?></th>
                <th scope="col"><?= __('Receptionroom') ?></th>
                <th scope="col"><?= __('Diningroom') ?></th>
                <th scope="col"><?= __('Maidroom') ?></th>
                <th scope="col"><?= __('Parking') ?></th>
                <th scope="col"><?= __('Description') ?></th>
                <th scope="col"><?= __('Address Id') ?></th>
                <th scope="col"><?= __('Isactive') ?></th>
                <th scope="col"><?= __('Issale') ?></th>
                <th scope="col"><?= __('Isrent') ?></th>
                <th scope="col"><?= __('Expire Date') ?></th>
                <th scope="col"><?= __('Price Sales') ?></th>
                <th scope="col"><?= __('Price Rent') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col"><?= __('Landsize') ?></th>
                <th scope="col"><?= __('Usefulspace') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($address->assets as $assets): ?>
            <tr>
                <td><?= h($assets->id) ?></td>
                <td><?= h($assets->code) ?></td>
                <td><?= h($assets->name) ?></td>
                <td><?= h($assets->asset_type_id) ?></td>
                <td><?= h($assets->user_id) ?></td>
                <td><?= h($assets->floor) ?></td>
                <td><?= h($assets->bedroom) ?></td>
                <td><?= h($assets->bathroom) ?></td>
                <td><?= h($assets->kitchenroom) ?></td>
                <td><?= h($assets->receptionroom) ?></td>
                <td><?= h($assets->diningroom) ?></td>
                <td><?= h($assets->maidroom) ?></td>
                <td><?= h($assets->parking) ?></td>
                <td><?= h($assets->description) ?></td>
                <td><?= h($assets->address_id) ?></td>
                <td><?= h($assets->isactive) ?></td>
                <td><?= h($assets->issale) ?></td>
                <td><?= h($assets->isrent) ?></td>
                <td><?= h($assets->expire_date) ?></td>
                <td><?= h($assets->price_sales) ?></td>
                <td><?= h($assets->price_rent) ?></td>
                <td><?= h($assets->created) ?></td>
                <td><?= h($assets->modified) ?></td>
                <td><?= h($assets->landsize) ?></td>
                <td><?= h($assets->usefulspace) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Assets', 'action' => 'view', $assets->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Assets', 'action' => 'edit', $assets->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Assets', 'action' => 'delete', $assets->id], ['confirm' => __('Are you sure you want to delete # {0}?', $assets->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related User Addresses') ?></h4>
        <?php if (!empty($address->user_addresses)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Address Id') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Description') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($address->user_addresses as $userAddresses): ?>
            <tr>
                <td><?= h($userAddresses->id) ?></td>
                <td><?= h($userAddresses->user_id) ?></td>
                <td><?= h($userAddresses->address_id) ?></td>
                <td><?= h($userAddresses->created) ?></td>
                <td><?= h($userAddresses->description) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'UserAddresses', 'action' => 'view', $userAddresses->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'UserAddresses', 'action' => 'edit', $userAddresses->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'UserAddresses', 'action' => 'delete', $userAddresses->id], ['confirm' => __('Are you sure you want to delete # {0}?', $userAddresses->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
