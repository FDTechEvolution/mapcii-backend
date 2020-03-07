<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Size $size
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Sizes'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="sizes form large-9 medium-8 columns content">
    <?= $this->Form->create($size) ?>
    <fieldset>
        <legend><?= __('Add Size') ?></legend>
        <?php
            echo $this->Form->control('width');
            echo $this->Form->control('height');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
