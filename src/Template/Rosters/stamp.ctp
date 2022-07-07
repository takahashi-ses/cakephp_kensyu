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
    <?php
    $this->start('title');
    echo '勤怠システム';
    $this->end();
    ?>

    <div style="width:500px;margin-left:auto;margin-right:auto;margin: top 16%;">
        <?= $this->Flash->render() ?>
        <?= $this->Form->create() ?>
        <?= $this->Form->button('出勤', ['value' => 'sta', 'name' => 'kubun']); ?>
        <?= $this->Form->button('退勤', ['value' => 'end', 'name' => 'kubun']); ?>
        <?= $this->Form->end() ?>
    </div>
</div>
