<!-- File: /app/views/posts/add.ctp -->

<h1><?php echo __('Add Post'); ?></h1>
<?php
echo $this->Form->create('Post');
echo $this->Form->input('title', array('label' => __('Title')));
echo $this->Form->input('body', array('rows' => '3', 'label' => __('Text')));
echo $this->Form->end(__('Save Post'));
?>
