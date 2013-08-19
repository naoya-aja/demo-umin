<?php
/**
 * デフォルトレイアウト
 *
 * @author H.Asakura
 * @version 1.00
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja">
<head>
<?php echo $this->Html->charset(); ?>
<meta http-equiv="content-style-type" content="text/css" />
<meta http-equiv="content-script-type" content="text/javascript" />
<title>
	<?php echo $title_for_layout; ?>
</title>
<?php
	echo $this->Html->meta('icon');
	echo $scripts_for_layout;
?>
</head>
<body>
<div id="container">
	<div id="header">
		<?php echo $this->element('header'); ?>
	</div>
	<div id="content">

		<?php echo $this->Session->flash(); ?>

		<?php echo $content_for_layout; ?>

	</div>
	<div id="footer">
		<?php echo $this->element('footer'); ?>
	</div>
</div>
<?php echo $this->element('sql_dump'); ?>
</body>
</html>
