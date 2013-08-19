<?php
	echo $this->Form->create('Upfile', array('type' => 'file'));
	echo $this->Form->file('Upfile.item');
	echo $this->Form->end('アップロード');
?>
