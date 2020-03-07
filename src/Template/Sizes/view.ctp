<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Size $size
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Size'), ['action' => 'edit', $size->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Size'), ['action' => 'delete', $size->id], ['confirm' => __('Are you sure you want to delete # {0}?', $size->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Sizes'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Size'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="sizes view large-9 medium-8 columns content">
    <h3><?= h($size->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= h($size->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Width') ?></th>
            <td><?= $this->Number->format($size->width) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Height') ?></th>
            <td><?= $this->Number->format($size->height) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($size->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($size->modified) ?></td>
        </tr>
    </table>
</div>
