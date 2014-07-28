<!-- File: /app/views/comments/edit.ctp -->

<h1><?php echo __('Edit Comment'); ?></h1>
<?php
    echo $this->Form->create('Comment', array('action' => 'edit'));
	echo $this->Form->input('title');
	echo $this->Form->input('body', array('rows' => '3', 'label' => __('Text')));
    echo $this->Form->input('id', array('type' => 'hidden'));
    echo $this->Form->input('post_id', array('type' => 'hidden'));
    echo $this->Form->end(__('Save Comment'));
?>
