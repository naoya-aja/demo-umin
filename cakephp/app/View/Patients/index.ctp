<?php
/**
 * 患者情報一覧画面
 *
 * @version 1.00
 */
?>

<?php echo $this->Html->link('メニューへ戻る', array(
			'controller' => 'users', 'action' => 'menu'
		));
 ?>

<h2>患者情報一覧</h2>
<?php echo $this->Html->link('新規患者登録', array(
			'action' => 'add'
		));
 ?>

 <?php if (!empty($patients)): ?>

<table border="1">
	<tr>
		<th>患者番号</th>
		<th>氏名</th>
		<th>氏名かな</th>
		<th>性別</th>
		<th>生年月日</th>
		<th>年齢</th>
		<th>患者情報</th>
		<th>ファイル</th>
	</tr>

	<?php foreach ($patients as $patient): ?>

	<tr>
		<td><?php echo $patient['Patient']['id']; ?></td>
		<td><?php echo $patient['Patient']['last_name'] . " " . $patient['Patient']['first_name']; ?></td>
		<td><?php echo $patient['Patient']['last_name_kana'] . " " . $patient['Patient']['first_name_kana']; ?></td>
		<td>
			<?php
				switch ($patient['Patient']['sex']) {
				case "1":
					echo "男";
					break;
				case "2":
					echo "女";
					break;
				default:
					echo "　";
				}
			?>
		</td>
		<td><?php echo $patient['Patient']['birthday']; ?></td>
		<td><?php
				echo $this->Age->ageconv($patient['Patient']['birthday']);
			?>
		</td>
		<td>
			<?php echo $this->Html->link('編集', array('action' => 'patientedit', $patient['Patient']['id']));?>
		</td>
		<td>
			<?php echo $this->Html->link('登録', array('action' => 'fileadd', $patient['Patient']['id']));?>
		</td>
    </tr>
    <?php endforeach; ?>
</table>

<?php if (!empty($upfiles)): ?>

<?php echo $this->Html->link('新規ファイル登録', array(
			'action' => 'fileadd'
		));
 ?>
<table border="1">
	<tr>
		<th>医療機関</th>
		<th>部門</th>
		<th>診療科</th>
		<th>診察券番号</th>
		<th>ファイル種別</th>
		<th>ファイル作成日</th>
		<th>ファイル</th>
	</tr>

	<?php foreach ($patients as $patient): ?>

	<tr>
		<td><?php echo $patient['Upfile']['hospital_id']; ?></td>
		<td><?php echo $patient['Upfile']['division_id']; ?></td>
		<td><?php echo $patient['Upfile']['department_id']; ?></td>
		<td><?php echo $patient['Upfile']['number']; ?></td>
		<td><?php echo $patient['Upfile']['show_name']; ?></td>
		<td><?php echo $patient['Upfile']['file_create']; ?></td>
		<td>
			<?php echo $this->Html->link('編集', array('action' => 'fileedit', $patient['Patient']['id']));?>
		</td>
    </tr>
    <?php endforeach; ?>
</table>

<?php endif; ?>
<?php endif; ?>
