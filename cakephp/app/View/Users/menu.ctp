<?php
/**
 * メニュー画面
 *
 * ログイン後のメニュー表示
 *
 * @version 1.00
 */
?>
<?php
	echo $this->Html->link('患者情報・ファイルの登録', array(
		'controller' => 'patients', 'action' => 'index',
	));
?>
<br>
<br>
<?php
	echo $this->Html->link('ファイル検索', array(
		'controller' => 'patient', 'action' => 'index',
	));
?>
