<div class="users form">
<?= $this->Flash->render() ?>
<?= $this->Form->create() ?>
    <fieldset>
        <legend><?= __('Please enter your username and password') ?></legend>
        <?= $this->Form->control('account') ?>
        <?= $this->Form->control('password') ?>
        <?= $this->Html->link('パスワードを忘れた方はこちら', ['controller'=>'users', 'action'=>'forget']) ?>
    </fieldset>
<?= $this->Form->button(__('Login')); ?>
<?= $this->Form->end() ?>
</div>
