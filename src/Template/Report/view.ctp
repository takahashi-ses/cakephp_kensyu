<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Report $report
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
<div class="report view large-9 medium-8 columns content">
    <h3><?= h($report->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $report->has('user') ? $this->Html->link($report->user->name, ['controller' => 'Users', 'action' => 'view', $report->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Comment') ?></th>
            <td><?= h($report->comment) ?></td>
        </tr>
        <!-- <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($report->id) ?></td>
        </tr> -->
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($report->created) ?></td>
        </tr>
    </table>
</div>
