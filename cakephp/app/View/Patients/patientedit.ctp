<?php
/**
 * 患者情報変更画面
 *
 * @version 1.00
 */
?>

<?php echo $this->Html->link('一覧へ戻る', array(
		'controller' => 'patients', 'action' => 'index',
	));
?>
<h2>患者情報編集</h2>
<?php echo $this->Form->create('Patient', array('enctype' => 'multipart/form-data')); ?>
<table>
	<tr>
		<th>姓</th>
		<td><?php echo $this->Form->text('last_name', array('div'=>false, 'label'=>false)); ?></td>
	</tr>
	<tr>
		<th>名</th>
		<td><?php echo $this->Form->text('first_name', array('div'=>false, 'label'=>false)); ?></td>
	</tr>
	<tr>
		<th>姓かな</th>
		<td><?php echo $this->Form->text('last_name_kana', array('div'=>false, 'label'=>false)); ?></td>
	</tr>
	<tr>
		<th>名かな</th>
		<td><?php echo $this->Form->text('first_name_kana', array('div'=>false, 'label'=>false)); ?></td>
	</tr>
	<tr>
		<th>性別</th>
		<td>
			<?php
				$options = array('1'=>'男', '2'=>'女');
				echo $this->Form->radio('sex',$options, array('div'=>false, 'legend'=>false));
			?>
		</td>
	</tr>
	<tr>
		<th>生年月日</th>
		<td><?php echo $this->Form->text('birthday', array('div'=>false, 'label'=>false)); ?></td>
	</tr>
	<tr>
		<th>郵便番号</th>
		<td><?php echo $this->Form->text('zip', array('div'=>false, 'label'=>false)); ?></td>
	</tr>
	<tr>
		<th>住所</th>
		<td><?php echo $this->Form->text('address', array('div'=>false, 'label'=>false, 'rows' => '3')); ?></td>
	</tr>
	<tr>
		<th>電話番号</th>
		<td><?php echo $this->Form->text('tel', array('div'=>false, 'label'=>false)); ?></td>
	</tr>
</table>
<?php echo $this->Form->input('id', array('type' => 'hidden')); ?>
<?php echo $this->Form->end('更新'); ?>
