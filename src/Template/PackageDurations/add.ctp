<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PackageDuration $packageDuration
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Package Durations'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="packageDurations form large-9 medium-8 columns content">
    <?= $this->Form->create($packageDuration) ?>
    <fieldset>
        <legend><?= __('Add Package Duration') ?></legend>
        <?php
            echo $this->Form->control('duration_name');
            echo $this->Form->control('duration_exp');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
