<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Roster $roster
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Roster'), ['action' => 'edit', $roster->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Roster'), ['action' => 'delete', $roster->id], ['confirm' => __('Are you sure you want to delete # {0}?', $roster->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Rosters'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Roster'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="rosters view large-9 medium-8 columns content">
    <h3><?= h($roster->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $roster->has('user') ? $this->Html->link($roster->user->name, ['controller' => 'Users', 'action' => 'view', $roster->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Reason') ?></th>
            <td><?= h($roster->reason) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created User') ?></th>
            <td><?= h($roster->created_user) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified User') ?></th>
            <td><?= h($roster->modified_user) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($roster->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Status') ?></th>
            <td><?= $this->Number->format($roster->status) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Start Time') ?></th>
            <td><?= h($roster->start_time) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('End Time') ?></th>
            <td><?= h($roster->end_time) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Deleted') ?></th>
            <td><?= h($roster->deleted) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($roster->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($roster->modified) ?></td>
        </tr>
    </table>
</div>
