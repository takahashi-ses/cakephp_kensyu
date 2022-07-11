<?php $id = $this->request->session()->read("Auth.User.id"); ?>

<nav class="large-3 medium-4 columns" id="actions-sidebar">
<ul class="side-nav">
        <li class="heading"><?= __('メニュー') ?></li>
        <?php if ($this->request->session()->read("Auth.User.role") == 2):?>
        <li><?= $this->Html->link(__('勤怠管理'), ["controller"=>"rosters" ,'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('業務報告'), ['controller' => 'Report', 'action' => 'index']) ?></li>
        <?php else: ?>
        <li><?= $this->Html->link(__('勤怠入力'), ["controller"=>"rosters" ,'action' => 'stamp']) ?></li>
        <li><?= $this->Html->link(__('勤怠管理'), ["controller"=>"rosters" ,'action' => 'list', $id]) ?></li>
        <li><?= $this->Html->link(__('業務報告'), ['controller' => 'Report', 'action' => 'add']) ?></li>
        <?php endif; ?>
        <li><?= $this->Html->link(__('会員情報'), ['controller' => 'Users', 'action' => "view/$id"]) ?></li>
        <?php if ($this->request->session()->read("Auth.User.role") == 2):?>
        <li><?= $this->Html->link(__('アカウント新規作成'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('ユーザーリスト'), ['action' => 'list']) ?></li>
        <?php endif; ?>
    </ul>
</nav>

<h1>Home</h1>
<p><?= $this->request->session()->read("Auth.User.account"); ?>君</p>
<p>おかえり。ここが君のお家だよ</p>
