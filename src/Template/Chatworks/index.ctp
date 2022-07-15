<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Chatwork[]|\Cake\Collection\CollectionInterface $chatworks
 */
?>
<?php $id = $this->request->session()->read("Auth.User.id"); ?>

<nav class="large-3 medium-4 columns" id="actions-sidebar">
<ul class="side-nav">
        <li class="heading"><?= __('メニュー') ?></li>
        <?php if ($this->request->session()->read("Auth.User.role") == 2): ?>
            <li><?= $this->Html->link(__('アカウント新規作成'), ['controller'=>'users', 'action' => 'add']) ?></li>
            <li><?= $this->Html->link(__('ユーザーリスト'), ['controller'=>'users', 'action' => 'list']) ?></li>
            <li><?= $this->Html->link(__('勤怠修正'), ["controller"=>"rosters" ,'action' => 'index']) ?></li>
        <?php else: ?>
            <li><?= $this->Html->link(__('勤怠入力'), ["controller"=>"rosters" ,'action' => "stamp/$id"]) ?></li>
            <li><?= $this->Html->link(__('勤怠時間閲覧'), ["controller"=>"rosters" ,'action' => "list/$id"]) ?></li>
            <li><?= $this->Html->link(__('業務報告作成'), ['controller' => 'Report', 'action' => "add/$id"]) ?></li>
        <?php endif; ?>
        <li><?= $this->Html->link(__('業務報告書確認'), ['controller' => 'Report', 'action' => "index/$id"]) ?></li>
        <li><?= $this->Html->link(__('従業員情報'), ['controller' => 'users', 'action' => "view/$id"]) ?></li>
        <li><?= $this->Html->link(__('従業員情報変更'), ['controller' => 'users', 'action' => "edit/$id"]) ?></li>
        <li><?= $this->Html->link(__('チャット'), ['controller' => 'chatworks', 'action' => "index"]) ?></li>
    </ul>
</nav>
<div class="chatworks index large-9 medium-8 columns">
    <div class="chat-body">
        <?= $this->Flash->render() ?>
        <div  id="scroll-inner">
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
                                <?php endif; ?>
                                &nbsp;&nbsp;<?= h($chat->created) ?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" class="message-td" id="message-ajax"><?= h($chat->message) ?></td>
                        </tr>
                    </tbody>
                </table>
            <?php endforeach; ?>
        </div>
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
