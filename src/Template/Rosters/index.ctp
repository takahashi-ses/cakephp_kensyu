<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Roster[]|\Cake\Collection\CollectionInterface $rosters
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
    </ul>
</nav>
<div class="rosters index large-9 medium-8 columns content">
    <h3><?= __('勤怠管理ユーザー') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('users_id') ?></th>
                <!-- <th scope="col"><?= $this->Paginator->sort('start_time') ?></th>
                <th scope="col"><?= $this->Paginator->sort('end_time') ?></th> -->
                <!-- <th scope="col" class="actions"><?= __('Actions') ?></th> -->
            </tr>
        </thead>
        <tbody>
            <?php foreach ($rosters as $roster): ?>
            <tr>
                <td><?= $roster->has('user') ? $this->Html->link($roster->user->name, ['controller' => 'Rosters', 'action' => 'list', $roster->user->id]) : 'NULL' ?></td>
                <!-- <td><?= h($roster->start_time) ?></td>
                <td><?= h($roster->end_time) ?></td> -->
                <!-- <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $roster->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $roster->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $roster->id], ['confirm' => __('Are you sure you want to delete # {0}?', $roster->id)]) ?>
                </td> -->
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
