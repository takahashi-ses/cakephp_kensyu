<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<?php $id = $this->request->session()->read("Auth.User.id"); ?>
<?php $role = $this->request->session()->read("Auth.User.role"); ?>

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
<div class="users form large-9 medium-8 columns content">
    <?= $this->Form->create($user) ?>
    <fieldset>
        <legend><?= __('Edit User') ?></legend>
        <?php
            echo $this->Form->control('account');
            echo $this->Form->control('password');
            echo $this->Form->control('name');
            echo $this->Form->control('email');
            echo $this->Form->control('tel');
            echo $this->Form->control('zipcode');
            echo $this->Form->control('address');
            echo $this->Form->control('modified_user');
            if (isset($role) && $role == 2) {
                $list = [
                    ['text'=>'user', 'value'=>1],
                    ['text'=>'admin', 'value'=>2]
                ];

                echo $this->Form->control('role', [
                    'type'=>'select',
                    'label'=>'役割',
                    'required'=>true,
                    'options'=>$list
                ]);
            }
            
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
