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
                <tbody>
                <?php if ($user->id == $chat->users_id) : ?>
                    <tr class="self-td">
                <?php else : ?>
                    <tr class="others-td">
                <?php endif; ?>
                        <td><?= h($chat->user->name) ?></td>
                        <td class="action-td">
                            <?php if ($user->id == $chat->users_id) : ?>
                                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $chat->id]) ?>&nbsp;
                                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete',$chat->id],['confirm' => __('Are you sure you want to delete # {0}?',$chat->id)]) ?>
                                &nbsp;&nbsp;<?= h($chat->created) ?>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" class="message-td"><?= h($chat->message) ?></td>
                    </tr>
                </tbody>
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
