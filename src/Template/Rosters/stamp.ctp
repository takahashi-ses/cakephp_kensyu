<?php $id = $this->request->session()->read("Auth.User.id"); ?>

<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('メニュー') ?></li>
        <li><?= $this->Html->link(__('勤怠管理'), ["controller"=>"rosters" ,'action' => 'stamp']) ?></li>
        <li><?= $this->Html->link(__('業務報告'), ['controller' => 'Report', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('会員情報'), ['controller' => 'Users', 'action' => "view/$id"]) ?></li>
        <?php if ($this->request->session()->read("Auth.User.role") == 2):?>
        <li><?= $this->Html->link(__('アカウント新規作成'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('ユーザーリスト'), ['action' => 'list']) ?></li>
        <?php endif; ?>
        <li><?= $this->Html->link(__('HOME'), ['controller' => 'Users', 'action' => 'index']) ?></li>
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
