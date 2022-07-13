<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Chatwork[]|\Cake\Collection\CollectionInterface $chatworks
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Chatwork'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="chatworks index large-9 medium-8 columns">
    <div class="chat-body">
        <?= $this->Flash->render() ?>
        <?php foreach ($chatworks as $chat): ?>
            <table>
                <tr>
                    <?= $chat->has('user') ? $this->Html->link($chat->user->name, ['controller' => 'Users', 'action' => 'view', $chat->user->id]) : '' ?>
                    &nbsp;<?= h($chat->created) ?>&nbsp;
                    <?php if ($user->id == $chat->users_id) : ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $chat->id]) ?>&nbsp;
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete',$chat->id],['confirm' => __('Are you sure you want to delete # {0}?',$chat->id)]) ?>
                    <?php endif; ?>
                </tr>
                <td><?= h($chat->message) ?></td>
            </table>
        <?php endforeach; ?>
    </div>


    <div class="chatworks chat-system">
        <div class="send-box flex-box">
            <?= $this->Form->create($chatwork) ?>
            <?= $this->Form->hidden('users_id', ['value' => $user->id]); ?>
            <div class="chat-form">
                <div class="pos-left">
                    <?= $this->Form->textarea('message', ['rows' => '1']); ?>
                </div>
                <div class="pos-right">
                    <?= $this->Form->button(__('Submit')) ?>
                </div>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>
