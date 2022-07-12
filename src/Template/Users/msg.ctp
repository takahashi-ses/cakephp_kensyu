<?php

echo "メッセージを送信しました。";
echo '<br>';
echo $this->Form->create('users', ['action'=>'login']);
echo $this->Form->submit('ログイン画面へ');
echo $this->Form->end();