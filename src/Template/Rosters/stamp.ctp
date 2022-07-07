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
