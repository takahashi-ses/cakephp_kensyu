<?php
echo $this->Form->create();
echo $this->Form->controll('email', ['type'=>'email']);
echo $this->Form->button('メールを送信する');
echo $this->Form->end();