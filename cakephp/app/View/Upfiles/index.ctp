<?php
/**
 * アップロードファイル一覧画面
 *
 * 選択された患者情報表示 
 * アップロードされたファイル一覧表示
 * ファイルのダウンロードリンク表示
 *
 * @author H.Asakura
 * @version 1.00
 */
?>
<?php echo $this->Html->link('検索へ戻る', array(
		'controller' => 'patient', 'action' => 'index',
	));
?>
<h2>ファイル一覧</h2>

<?php if (!empty($patient)): ?>

<table border="1">
	<thead>
		<?php
			// テーブルヘッダー(th)の生成
			echo $this->Html->tableHeaders(array(
				'患者ID',
				'氏名',
			 	'かな',
			 	'性別',
			 	'年齢',
			 	'電話番号',
			 	'郵便番号',
			 	'住所',
			));
		?>
	</thead>
	<tbody>
		<?php
			$row = $patient['Patient'];
			switch ($row['sex']) {
			case '1':
				$sex = '男';
				break;
			case '2':
				$sex = '女';
				break;
			default:
				$sex = ' ';
			}   
			$cells = array();
			$cells[] = array(
				h($row['id']),
				h($row['last_name'] .' '. $row['first_name']),
				h($row['last_name_kana'] .' '. $row['first_name_kana']),
				h($sex),
				h($this->Age->ageconv($row['birthday'])),
				h($row['tel']),
				h($row['zip']),
				h($row['address']),
			);
			// テーブルセル(td)の生成
			echo $this->Html->tableCells($cells);
		?>
	</tbody>
</table>

<?php if (!empty($upfiles)): ?>

<table border="1">
	<thead>
		<?php
			// テーブルヘッダー(th)の生成
			echo $this->Html->tableHeaders(
				array(
					'ファイル種別',
					'表示',
				)
			);
		?>
	</thead>
	<tbody>
		<?php
			$cells = array();
			foreach ($upfiles as $row) {
				$row = $row['Upfile'];

				$link = array('action' => 'download', $row['id']);
				$link = $this->Html->link('Download', $link);

				$cells[] = array(
					h($row['show_name']),
					$link,
				);
			}
			if (count($cells) > 0) {
				// テーブルセル(td)の生成
				echo $this->Html->tableCells($cells);
			}
		?>
	</tbody>
</table>

<?php endif; ?>
<?php endif; ?>
