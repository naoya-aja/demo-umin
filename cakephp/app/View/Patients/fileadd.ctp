<?php
/**
 * ファイル情報追加画面
 *
 * @version 1.00
 */
?>

<?php echo $this->Html->link('一覧へ戻る', array(
		'controller' => 'patients', 'action' => 'index',
	));
?>
<h2>ファイル情報登録</h2>
<?php echo $this->Form->create('Patient', array('enctype' => 'multipart/form-data')); ?>
<table>
	<tr>
		<th>診察券番号</th>
		<td><?php echo $this->Form->text('Upfile.number', array('div'=>false, 'label'=>false)); ?></td>
	</tr>
	<tr>
		<th>ファイル種別</th>
		<td><?php echo $this->Form->text('Upfile.show_name', array('div'=>false, 'label'=>false)); ?></td>
	</tr>
	<tr>
		<th>アップロードファイル</th>
		<td><?php echo $this->Form->input('Upfile.up_name', array('type'=>'file', 'div'=>false, 'label'=>false)); ?></td>
	</tr>
	<tr>
		<th>ファイル作成日</th>
		<td><?php echo $this->Form->text('Upfile.file_create', array('div'=>false, 'label'=>false)); ?></td>
	</tr>
</table>
	<?php echo $this->Form->end('登録'); ?>
