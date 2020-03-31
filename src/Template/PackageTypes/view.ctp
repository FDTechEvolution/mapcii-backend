<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PackageType $packageType
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Package Type'), ['action' => 'edit', $packageType->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Package Type'), ['action' => 'delete', $packageType->id], ['confirm' => __('Are you sure you want to delete # {0}?', $packageType->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Package Types'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Package Type'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Packages'), ['controller' => 'Packages', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Package'), ['controller' => 'Packages', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="packageTypes view large-9 medium-8 columns content">
    <h3><?= h($packageType->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= h($packageType->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($packageType->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Isactive') ?></th>
            <td><?= h($packageType->isactive) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($packageType->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($packageType->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Description') ?></h4>
        <?= $this->Text->autoParagraph(h($packageType->description)); ?>
    </div>
    <div class="related">
        <h4><?= __('Related Packages') ?></h4>
        <?php if (!empty($packageType->packages)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col"><?= __('Description') ?></th>
                <th scope="col"><?= __('Monthly Price') ?></th>
                <th scope="col"><?= __('Quarterly Price') ?></th>
                <th scope="col"><?= __('Semiannual Price') ?></th>
                <th scope="col"><?= __('Annual Price') ?></th>
                <th scope="col"><?= __('Showpage') ?></th>
                <th scope="col"><?= __('Showcase') ?></th>
                <th scope="col"><?= __('Size Id') ?></th>
                <th scope="col"><?= __('Position Id') ?></th>
                <th scope="col"><?= __('Package Type Id') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col"><?= __('Createdby') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($packageType->packages as $packages): ?>
            <tr>
                <td><?= h($packages->id) ?></td>
                <td><?= h($packages->name) ?></td>
                <td><?= h($packages->description) ?></td>
                <td><?= h($packages->monthly_price) ?></td>
                <td><?= h($packages->quarterly_price) ?></td>
                <td><?= h($packages->semiannual_price) ?></td>
                <td><?= h($packages->annual_price) ?></td>
                <td><?= h($packages->showpage) ?></td>
                <td><?= h($packages->showcase) ?></td>
                <td><?= h($packages->size_id) ?></td>
                <td><?= h($packages->position_id) ?></td>
                <td><?= h($packages->package_type_id) ?></td>
                <td><?= h($packages->created) ?></td>
                <td><?= h($packages->modified) ?></td>
                <td><?= h($packages->createdby) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Packages', 'action' => 'view', $packages->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Packages', 'action' => 'edit', $packages->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Packages', 'action' => 'delete', $packages->id], ['confirm' => __('Are you sure you want to delete # {0}?', $packages->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
