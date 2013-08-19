<?php
echo $this->Form->create('User', array('action' => 'editPasswd'));
echo $this->Form->inputs(array(
	'legend' => __('パスワードを変更'),
	'password'
));
echo $this->Form->end('変更');
