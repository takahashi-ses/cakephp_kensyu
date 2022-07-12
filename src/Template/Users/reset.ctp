<?php
echo '新しいパスワードを入力してください。';
echo $this->Form->create('users', ['action' => 'resetok']);
echo $this->Form->control('password');
echo $this->Form->submit('確定');
echo $this->Form->end();