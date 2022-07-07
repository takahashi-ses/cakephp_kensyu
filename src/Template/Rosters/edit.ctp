<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Roster $roster
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $roster->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $roster->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Rosters'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="rosters form large-9 medium-8 columns content">
    <?= $this->Form->create($roster) ?>
    <fieldset>
        <legend><?= __('Edit Roster') ?></legend>
        <?php
            echo $this->Form->control('users_id', ['options' => $users]);
            echo $this->Form->control('start_time', ['empty' => true]);
            echo $this->Form->control('end_time', ['empty' => true]);
            echo $this->Form->control('status');
            echo $this->Form->control('reason');
            echo $this->Form->control('deleted', ['empty' => true]);
            echo $this->Form->control('created_user');
            echo $this->Form->control('modified_user');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
