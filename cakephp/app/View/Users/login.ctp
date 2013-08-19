<?php
/**
 * ログイン画面
 *
 * Auth認証用ログイン画面
 *
 * @author H.Asakura
 * @version 1.00
 */
?>
<?php
echo $this->Form->create('User', array('action' => 'login'));
echo $this->Form->inputs(array(
	'legend' => __('ログイン'),
	'username',
	'password'
));
echo $this->Form->end('Login');
