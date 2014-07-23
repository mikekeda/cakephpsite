<!-- File: /app/views/posts/edit.ctp -->

<h1><?php echo __('Edit Post'); ?></h1>
<?php
    echo $this->Form->create('Post', array('action' => 'edit'));
	echo $this->Form->input('Post.title.eng', array('label' => __('Title En')));
	echo $this->Form->input('Post.body.eng', array('rows' => '3', 'label' => __('Text En')));
	echo $this->Form->input('Post.title.ukr', array('label' => __('Title Ua')));
	echo $this->Form->input('Post.body.ukr', array('rows' => '3', 'label' => __('Text Ua')));
    echo $this->Form->input('id', array('type' => 'hidden'));
    echo $this->Form->end(__('Save Post'));
?>
