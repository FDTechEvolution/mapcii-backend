<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Size $size
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $size->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $size->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Sizes'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Packages'), ['controller' => 'Packages', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Package'), ['controller' => 'Packages', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="sizes form large-9 medium-8 columns content">
    <?= $this->Form->create($size) ?>
    <fieldset>
        <legend><?= __('Edit Size') ?></legend>
        <?php
            echo $this->Form->control('name');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
