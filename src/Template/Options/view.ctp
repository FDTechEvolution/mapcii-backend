<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Option $option
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Option'), ['action' => 'edit', $option->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Option'), ['action' => 'delete', $option->id], ['confirm' => __('Are you sure you want to delete # {0}?', $option->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Options'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Option'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Asset Options'), ['controller' => 'AssetOptions', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Asset Option'), ['controller' => 'AssetOptions', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="options view large-9 medium-8 columns content">
    <h3><?= h($option->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= h($option->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($option->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Value') ?></th>
            <td><?= h($option->value) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Type') ?></th>
            <td><?= h($option->type) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Createdby') ?></th>
            <td><?= h($option->createdby) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modifiedby') ?></th>
            <td><?= h($option->modifiedby) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Seq') ?></th>
            <td><?= $this->Number->format($option->seq) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($option->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($option->modified) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Asset Options') ?></h4>
        <?php if (!empty($option->asset_options)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Asset Id') ?></th>
                <th scope="col"><?= __('Option Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($option->asset_options as $assetOptions): ?>
            <tr>
                <td><?= h($assetOptions->id) ?></td>
                <td><?= h($assetOptions->asset_id) ?></td>
                <td><?= h($assetOptions->option_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'AssetOptions', 'action' => 'view', $assetOptions->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'AssetOptions', 'action' => 'edit', $assetOptions->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'AssetOptions', 'action' => 'delete', $assetOptions->id], ['confirm' => __('Are you sure you want to delete # {0}?', $assetOptions->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
