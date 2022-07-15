<?php $id = $this->request->session()->read("Auth.User.id"); ?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
<ul class="side-nav">
        <li class="heading"><?= __('メニュー') ?></li>
        <?php if ($this->request->session()->read("Auth.User.role") == 2): ?>
            <li><?= $this->Html->link(__('アカウント新規作成'), ['controller'=>'users', 'action' => 'add']) ?></li>
            <li><?= $this->Html->link(__('ユーザーリスト'), ['controller'=>'users', 'action' => 'list']) ?></li>
            <li><?= $this->Html->link(__('勤怠修正'), ["controller"=>"rosters" ,'action' => 'index']) ?></li>
            <li><?= $this->Html->link(__('お知らせ追加'), ["controller"=>"bulletins" ,'action' => 'add']) ?></li>
            <li><?= $this->Html->link(__('お知らせリスト'), ["controller"=>"bulletins" ,'action' => 'index']) ?></li>
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
<div class="bulletins index large-9 medium-8 columns content">
    <h3 class="osirase"><?= __('お知らせ') ?></h3>
    <div class="index_table">
        <table cellpadding="0" cellspacing="0">
            <tbody>
                <div class="index_bulletin">
                    <?php foreach ($bulletins as $bulletin): ?>
                        <?php if ($bulletin["title"]) : ?>
                            <tr>
                                <td class="title"><?= $this->Html->link($bulletin->title, ['controller'=>'Bulletins', 'action'=>'view', $bulletin->id]) ?></td>
                                <td class="date"><?= h($bulletin->created) ?></td>
                            </tr>
                        <?php else : ?>
                            <tr>
                                <td>お知らせはありません</td>
                                <td>a</td>
                                <?php break; ?>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </tbody>
        </table>
    </div>
    <!-- <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div> -->
</div>
