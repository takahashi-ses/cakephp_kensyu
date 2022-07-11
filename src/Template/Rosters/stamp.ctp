<!-- <?php
var_dump($id); echo '<br>';
var_dump($rosters);
?> -->

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
    </ul>
</nav>

<div class="rosters form" style="text-align:center;">
    <div>
        <?= $this->Flash->render() ?>
        <h3 id="date"></h3>
        <h1 id="realtime"></h1>
        <?= $this->Form->create() ?>
        <?= $this->Form->button('出勤', ['value' => 'sta', 'name' => 'kubun']); ?>
        <?= $this->Form->button('退勤', ['value' => 'end', 'name' => 'kubun']); ?>
        <?= $this->Form->end() ?>
    </div>

    <p style="margin-top: 64px;">最近の打刻</p>
    <table cellpadding="0" cellspacing="0" style="margin-left: 40%; width: 50%">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('start_time') ?></th>
                <th><?= $this->Paginator->sort('end_time') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($rosters as $roster): ?>
                <tr>
                    <td><?= h($roster->start_time) ?></td>
                    <td><?= h($roster->end_time) ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
</div>
