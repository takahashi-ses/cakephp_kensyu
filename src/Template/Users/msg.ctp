<?php

echo "メッセージを送信しました。";
echo '<br>';
// echo $this->Form->create();
echo $this->Html->link('ログイン画面へ', ['controller'=>'users', 'action'=>'login']);
// echo $this->Form->end();\\\