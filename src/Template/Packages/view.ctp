<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Package $package
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Package'), ['action' => 'edit', $package->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Package'), ['action' => 'delete', $package->id], ['confirm' => __('Are you sure you want to delete # {0}?', $package->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Packages'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Package'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List User Packages'), ['controller' => 'UserPackages', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User Package'), ['controller' => 'UserPackages', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="packages view large-9 medium-8 columns content">
    <h3><?= h($package->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= h($package->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($package->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Description') ?></th>
            <td><?= h($package->description) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Createdby') ?></th>
            <td><?= h($package->createdby) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Monthly Price') ?></th>
            <td><?= $this->Number->format($package->monthly_price) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Quarterly Price') ?></th>
            <td><?= $this->Number->format($package->quarterly_price) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Semiannual Price') ?></th>
            <td><?= $this->Number->format($package->semiannual_price) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Annual Price') ?></th>
            <td><?= $this->Number->format($package->annual_price) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($package->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($package->modified) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related User Packages') ?></h4>
        <?php if (!empty($package->user_packages)): ?>
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
            <?php foreach ($package->user_packages as $userPackages): ?>
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
