
<h4 class='email_title'>新しいパスワードを入力してください。</h4>
<?= $this->Form->create('users', ['action'=>'resetok']); ?>
<div class="input_email">
    <?= $this->Form->controll('password', ['type'=>'password']); ?>
</div>
<div class="email_button">
    <?= $this->Form->button('送信'); ?>
</div>
<?= $this->Form->end(); ?>