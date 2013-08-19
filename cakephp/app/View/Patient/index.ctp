<?php
/**
 * 患者情報検索／一覧画面
 *
 * 患者情報の検索、検索結果一覧の表示
 *
 * @author H.Asakura
 * @version 1.00
 */
?>
<?php echo $this->Html->link('メニューへ戻る', array(
			'controller' => 'users', 'action' => 'menu'
		));
 ?>
<h2>患者検索</h2>

<?php echo $this->Form->create('Patient'); ?>
<table>
<tr>
	<td>患者ID</td>
	<td><?php echo $this->Form->text('id'); ?></td>
</tr>
<tr>
	<td>姓</td>
	<td><?php echo $this->Form->text('last_name'); ?></td>
</tr>
<tr>
	<td>名</td>
	<td><?php echo $this->Form->text('first_name'); ?></td>
</tr>
<tr>
	<td>姓かな</td>
	<td><?php echo $this->Form->text('last_name_kana'); ?></td>
</tr>
<tr>
	<td>名かな</td>
	<td><?php echo $this->Form->text('first_name_kana'); ?></td>
</tr>
</table>
<?php echo $this->Form->end('検索'); ?>

<?php if (!empty($patients)): ?>
<hr/>
<table border="1">
	<tr>
		<th>患者ID</th>
		<th>氏名</th>
		<th>氏名かな</th>
		<th>性別</th>
		<th>選択</th>
	</tr>
	<?php foreach ($patients as $patient): ?>
	<tr>
		<td><?php echo $patient['Patient']['id']; ?></td>
		<td>
			<?php echo $patient['Patient']['last_name']; ?>
			<?php echo $patient['Patient']['first_name']; ?>
		</td>
		<td>
			<?php echo $patient['Patient']['last_name_kana']; ?>
			<?php echo $patient['Patient']['first_name_kana']; ?>
		</td>
		<td>
			<?php
				switch ($patient['Patient']['sex']) {
				case '1':
					echo '男';
					break;
				case '2':
					echo '女';
					break;
				default:
					echo ' ';
				}
 			?>
		</td>
		<td>
			<?php
				$link = array('controller' => 'upfiles', 'action' => 'index', $patient['Patient']['id']);
				echo $this->Html->link('表示', $link);
			?>
		</td>
	</tr>
	<?php endforeach; ?>
</table>
<?php endif; ?>
