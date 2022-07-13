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
<div class="report form large-9 medium-8 columns content">
    <?= $this->Form->create($report) ?>
    <fieldset>
        <legend><?= __('Edit Report') ?></legend>
        <?php
            if ($this->request->session()->read("Auth.User.role") == 2) {
                echo $this->Form->control('user_id', ['options' => $users]);
            } else {
                echo "報告者 : " . $users->name;
                echo $this->Form->hidden('user_id', ['value' => $users->id]);
            }
            echo $this->Form->textarea('comment');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
