<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit User'), ['action' => 'edit', $user->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete User'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Images'), ['controller' => 'Images', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Image'), ['controller' => 'Images', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Assets'), ['controller' => 'Assets', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Asset'), ['controller' => 'Assets', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List User Addresses'), ['controller' => 'UserAddresses', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User Address'), ['controller' => 'UserAddresses', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List User Packages'), ['controller' => 'UserPackages', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User Package'), ['controller' => 'UserPackages', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="users view large-9 medium-8 columns content">
    <h3><?= h($user->title) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= h($user->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Usercode') ?></th>
            <td><?= h($user->usercode) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Title') ?></th>
            <td><?= h($user->title) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Firstname') ?></th>
            <td><?= h($user->firstname) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Lastname') ?></th>
            <td><?= h($user->lastname) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Username') ?></th>
            <td><?= h($user->username) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Password') ?></th>
            <td><?= h($user->password) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Email') ?></th>
            <td><?= h($user->email) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Phone') ?></th>
            <td><?= h($user->phone) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Lineid') ?></th>
            <td><?= h($user->lineid) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Fax') ?></th>
            <td><?= h($user->fax) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Isactive') ?></th>
            <td><?= h($user->isactive) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Isverify') ?></th>
            <td><?= h($user->isverify) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Islocked') ?></th>
            <td><?= h($user->islocked) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Iscustomer') ?></th>
            <td><?= h($user->iscustomer) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Isseller') ?></th>
            <td><?= h($user->isseller) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Gender') ?></th>
            <td><?= h($user->gender) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Verifycode') ?></th>
            <td><?= h($user->verifycode) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Position') ?></th>
            <td><?= h($user->position) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Image') ?></th>
            <td><?= $user->has('image') ? $this->Html->link($user->image->name, ['controller' => 'Images', 'action' => 'view', $user->image->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($user->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Updated') ?></th>
            <td><?= h($user->updated) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Assets') ?></h4>
        <?php if (!empty($user->assets)): ?>
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
            <?php foreach ($user->assets as $assets): ?>
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
        <?php if (!empty($user->user_addresses)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Address Id') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Description') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($user->user_addresses as $userAddresses): ?>
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
    <div class="related">
        <h4><?= __('Related User Packages') ?></h4>
        <?php if (!empty($user->user_packages)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Package Id') ?></th>
                <th scope="col"><?= __('Plant') ?></th>
                <th scope="col"><?= __('Start Date') ?></th>
                <th scope="col"><?= __('End Date') ?></th>
                <th scope="col"><?= __('Isexpire') ?></th>
                <th scope="col"><?= __('Ispaid') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col"><?= __('Description') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($user->user_packages as $userPackages): ?>
            <tr>
                <td><?= h($userPackages->id) ?></td>
                <td><?= h($userPackages->user_id) ?></td>
                <td><?= h($userPackages->package_id) ?></td>
                <td><?= h($userPackages->plant) ?></td>
                <td><?= h($userPackages->start_date) ?></td>
                <td><?= h($userPackages->end_date) ?></td>
                <td><?= h($userPackages->isexpire) ?></td>
                <td><?= h($userPackages->ispaid) ?></td>
                <td><?= h($userPackages->created) ?></td>
                <td><?= h($userPackages->modified) ?></td>
                <td><?= h($userPackages->description) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'UserPackages', 'action' => 'view', $userPackages->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'UserPackages', 'action' => 'edit', $userPackages->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'UserPackages', 'action' => 'delete', $userPackages->id], ['confirm' => __('Are you sure you want to delete # {0}?', $userPackages->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
