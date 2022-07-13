<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Chatwork $chatwork
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Chatwork'), ['action' => 'edit', $chatwork->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Chatwork'), ['action' => 'delete', $chatwork->id], ['confirm' => __('Are you sure you want to delete # {0}?', $chatwork->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Chatworks'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Chatwork'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="chatworks view large-9 medium-8 columns content">
    <h3><?= h($chatwork->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $chatwork->has('user') ? $this->Html->link($chatwork->user->name, ['controller' => 'Users', 'action' => 'view', $chatwork->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Message') ?></th>
            <td><?= h($chatwork->message) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($chatwork->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($chatwork->created) ?></td>
        </tr>
    </table>
</div>
