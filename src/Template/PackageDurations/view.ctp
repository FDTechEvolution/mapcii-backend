<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PackageDuration $packageDuration
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Package Duration'), ['action' => 'edit', $packageDuration->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Package Duration'), ['action' => 'delete', $packageDuration->id], ['confirm' => __('Are you sure you want to delete # {0}?', $packageDuration->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Package Durations'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Package Duration'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="packageDurations view large-9 medium-8 columns content">
    <h3><?= h($packageDuration->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= h($packageDuration->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Duration Name') ?></th>
            <td><?= h($packageDuration->duration_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Duration Exp') ?></th>
            <td><?= $this->Number->format($packageDuration->duration_exp) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($packageDuration->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($packageDuration->modified) ?></td>
        </tr>
    </table>
</div>
