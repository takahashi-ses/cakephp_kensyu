
<h4 class='email_title'>登録されているメールアドレスを入力してください。</h4>
<?= $this->Form->create(); ?>
<div class="input_email">
    <?= $this->Form->controll('email', ['type'=>'email']); ?>
</div>
<div class="email_button">
    <form method='post'>
    <?= $this->Form->button('メールを送信する'); ?>
    </form>
</div>
<?= $this->Form->end(); ?>