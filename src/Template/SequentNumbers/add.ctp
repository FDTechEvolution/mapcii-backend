<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SequentNumber $sequentNumber
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Sequent Numbers'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="sequentNumbers form large-9 medium-8 columns content">
    <?= $this->Form->create($sequentNumber) ?>
    <fieldset>
        <legend><?= __('Add Sequent Number') ?></legend>
        <?php
            echo $this->Form->control('prefix');
            echo $this->Form->control('suffix');
            echo $this->Form->control('start_no');
            echo $this->Form->control('current_no');
            echo $this->Form->control('running_length');
            echo $this->Form->control('current_sequent');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
