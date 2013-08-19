<?php
/**
 * ヘッダーエレメント
 *
 * ヘッダー部分を部品化
 *
 * @author H.Asakura
 * @version 1.00
 */
?>
<div style="width:100%;">
<div style="float:left; width:50%;">東大病院様デモ</div>

<div style="text-align:right;">
<?php
// ログイン情報
$auth = $this->Session->read('Auth.User');

// ログイン済みか？
if (!empty($auth)) {
	echo '( ';
	echo h($auth['username']), ' | ';
	echo $this->Html->link('ログアウト', array('controller' => 'users', 'action' => 'logout'));
	echo ' )';
}
echo '&nbsp;';
?>
</div>
</div>

<hr/>
