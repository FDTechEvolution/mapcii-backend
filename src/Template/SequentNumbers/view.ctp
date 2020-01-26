<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SequentNumber $sequentNumber
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Sequent Number'), ['action' => 'edit', $sequentNumber->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Sequent Number'), ['action' => 'delete', $sequentNumber->id], ['confirm' => __('Are you sure you want to delete # {0}?', $sequentNumber->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Sequent Numbers'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Sequent Number'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="sequentNumbers view large-9 medium-8 columns content">
    <h3><?= h($sequentNumber->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= h($sequentNumber->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Prefix') ?></th>
            <td><?= h($sequentNumber->prefix) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Suffix') ?></th>
            <td><?= h($sequentNumber->suffix) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Current Sequent') ?></th>
            <td><?= h($sequentNumber->current_sequent) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Start No') ?></th>
            <td><?= $this->Number->format($sequentNumber->start_no) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Current No') ?></th>
            <td><?= $this->Number->format($sequentNumber->current_no) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Running Length') ?></th>
            <td><?= $this->Number->format($sequentNumber->running_length) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($sequentNumber->created) ?></td>
        </tr>
    </table>
</div>
