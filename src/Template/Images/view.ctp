<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Image $image
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Image'), ['action' => 'edit', $image->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Image'), ['action' => 'delete', $image->id], ['confirm' => __('Are you sure you want to delete # {0}?', $image->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Images'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Image'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Asset Images'), ['controller' => 'AssetImages', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Asset Image'), ['controller' => 'AssetImages', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Asset Types'), ['controller' => 'AssetTypes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Asset Type'), ['controller' => 'AssetTypes', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="images view large-9 medium-8 columns content">
    <h3><?= h($image->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= h($image->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($image->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Type') ?></th>
            <td><?= h($image->type) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Url') ?></th>
            <td><?= h($image->url) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($image->created) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Path') ?></h4>
        <?= $this->Text->autoParagraph(h($image->path)); ?>
    </div>
    <div class="related">
        <h4><?= __('Related Asset Images') ?></h4>
        <?php if (!empty($image->asset_images)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Asset Id') ?></th>
                <th scope="col"><?= __('Image Id') ?></th>
                <th scope="col"><?= __('Isdefault') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Seq') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($image->asset_images as $assetImages): ?>
            <tr>
                <td><?= h($assetImages->id) ?></td>
                <td><?= h($assetImages->asset_id) ?></td>
                <td><?= h($assetImages->image_id) ?></td>
                <td><?= h($assetImages->isdefault) ?></td>
                <td><?= h($assetImages->created) ?></td>
                <td><?= h($assetImages->seq) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'AssetImages', 'action' => 'view', $assetImages->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'AssetImages', 'action' => 'edit', $assetImages->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'AssetImages', 'action' => 'delete', $assetImages->id], ['confirm' => __('Are you sure you want to delete # {0}?', $assetImages->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Asset Types') ?></h4>
        <?php if (!empty($image->asset_types)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col"><?= __('Image Id') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col"><?= __('Seq') ?></th>
                <th scope="col"><?= __('Asset Category Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($image->asset_types as $assetTypes): ?>
            <tr>
                <td><?= h($assetTypes->id) ?></td>
                <td><?= h($assetTypes->name) ?></td>
                <td><?= h($assetTypes->image_id) ?></td>
                <td><?= h($assetTypes->created) ?></td>
                <td><?= h($assetTypes->modified) ?></td>
                <td><?= h($assetTypes->seq) ?></td>
                <td><?= h($assetTypes->asset_category_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'AssetTypes', 'action' => 'view', $assetTypes->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'AssetTypes', 'action' => 'edit', $assetTypes->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'AssetTypes', 'action' => 'delete', $assetTypes->id], ['confirm' => __('Are you sure you want to delete # {0}?', $assetTypes->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Users') ?></h4>
        <?php if (!empty($image->users)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Usercode') ?></th>
                <th scope="col"><?= __('Title') ?></th>
                <th scope="col"><?= __('Firstname') ?></th>
                <th scope="col"><?= __('Lastname') ?></th>
                <th scope="col"><?= __('Username') ?></th>
                <th scope="col"><?= __('Password') ?></th>
                <th scope="col"><?= __('Email') ?></th>
                <th scope="col"><?= __('Phone') ?></th>
                <th scope="col"><?= __('Lineid') ?></th>
                <th scope="col"><?= __('Fax') ?></th>
                <th scope="col"><?= __('Isactive') ?></th>
                <th scope="col"><?= __('Isverify') ?></th>
                <th scope="col"><?= __('Islocked') ?></th>
                <th scope="col"><?= __('Iscustomer') ?></th>
                <th scope="col"><?= __('Isseller') ?></th>
                <th scope="col"><?= __('Gender') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Updated') ?></th>
                <th scope="col"><?= __('Verifycode') ?></th>
                <th scope="col"><?= __('Position') ?></th>
                <th scope="col"><?= __('Image Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($image->users as $users): ?>
            <tr>
                <td><?= h($users->id) ?></td>
                <td><?= h($users->usercode) ?></td>
                <td><?= h($users->title) ?></td>
                <td><?= h($users->firstname) ?></td>
                <td><?= h($users->lastname) ?></td>
                <td><?= h($users->username) ?></td>
                <td><?= h($users->password) ?></td>
                <td><?= h($users->email) ?></td>
                <td><?= h($users->phone) ?></td>
                <td><?= h($users->lineid) ?></td>
                <td><?= h($users->fax) ?></td>
                <td><?= h($users->isactive) ?></td>
                <td><?= h($users->isverify) ?></td>
                <td><?= h($users->islocked) ?></td>
                <td><?= h($users->iscustomer) ?></td>
                <td><?= h($users->isseller) ?></td>
                <td><?= h($users->gender) ?></td>
                <td><?= h($users->created) ?></td>
                <td><?= h($users->updated) ?></td>
                <td><?= h($users->verifycode) ?></td>
                <td><?= h($users->position) ?></td>
                <td><?= h($users->image_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Users', 'action' => 'view', $users->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Users', 'action' => 'edit', $users->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Users', 'action' => 'delete', $users->id], ['confirm' => __('Are you sure you want to delete # {0}?', $users->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
