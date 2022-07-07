<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<!-- <nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit User'), ['action' => 'edit', $user->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete User'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Report'), ['controller' => 'Report', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Report'), ['controller' => 'Report', 'action' => 'add']) ?> </li>
    </ul>
</nav> -->
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('メニュー') ?></li>
        <li><?= $this->Html->link(__('勤怠管理'), ["controller"=>"rosters" ,'action' => 'stamp']) ?></li>
        <li><?= $this->Html->link(__('業務報告'), ['controller' => 'Report', 'action' => 'index']) ?></li>
        <?php if ($this->request->session()->read("Auth.User.role") == 2):?>
        <li><?= $this->Html->link(__('アカウント新規作成'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('ユーザーリスト'), ['action' => 'list']) ?></li>
        <?php endif; ?>
        <li><?= $this->Html->link(__('HOME'), ['controller' => 'Users', 'action' => 'index']) ?></li>
    </ul>
</nav>
<div class="users view large-9 medium-8 columns content">
    <h3><?= h($user->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Account') ?></th>
            <td><?= h($user->account) ?></td>
        </tr>
        <!-- <tr>
            <th scope="row"><?= __('Password') ?></th>
            <td><?= h($user->password) ?></td>
        </tr> -->
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($user->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Email') ?></th>
            <td><?= h($user->email) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Tel') ?></th>
            <td><?= h($user->tel) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Zipcode') ?></th>
            <td><?= h($user->zipcode) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Address') ?></th>
            <td><?= h($user->address) ?></td>
        </tr>
        <!-- <tr>
            <th scope="row"><?= __('Created User') ?></th>
            <td><?= h($user->created_user) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified User') ?></th>
            <td><?= h($user->modified_user) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($user->id) ?></td>
        </tr> -->
        <tr>
            <th scope="row"><?= __('Role') ?></th>
            <td><?= $this->Number->format($user->role) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($user->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($user->modified) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Report') ?></h4>
        <?php if (!empty($user->report)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <!-- <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th> -->
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Comment') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($user->report as $report): ?>
            <tr>
                <!-- <td><?= h($report->id) ?></td>
                <td><?= h($report->user_id) ?></td> -->
                <td><?= h($report->created) ?></td>
                <td><?= h($report->comment) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Report', 'action' => 'view', $report->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Report', 'action' => 'edit', $report->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Report', 'action' => 'delete', $report->id], ['confirm' => __('Are you sure you want to delete # {0}?', $report->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
