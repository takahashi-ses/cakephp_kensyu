<div class="rosters form" style="text-align:center;">
    <?php
    $this->start('title');
    echo '勤怠システム';
    $this->end();
    ?>
    <div style="width:500px;margin-left:auto;margin-right:auto;">
        <?= $this->Flash->render() ?>
        <?= $this->Form->create() ?>
        <?= __('アカウントIDを入力して打刻してください。') ?>
        <?= $this->Form->control('account', ['required' => true, 'label' => '']) ?>
        <?= $this->Form->button('出勤', ['value' => 'sta', 'name' => 'kubun']); ?>
        <?= $this->Form->button('退勤', ['value' => 'end', 'name' => 'kubun']); ?>
        <?= $this->Form->end() ?>
    </div>
</div>
