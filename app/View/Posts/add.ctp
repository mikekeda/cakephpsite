<!-- File: /app/views/posts/add.ctp -->

<h1><?php echo __('Add Post'); ?></h1>
<?php
echo $this->Form->create('Post');
echo $this->Form->input('Post.title.eng', array('label' => __('Title En')));
echo $this->Form->input('Post.body.eng', array('rows' => '3', 'label' => __('Text En')));
echo $this->Form->input('Post.title.ukr', array('label' => __('Title Ua')));
echo $this->Form->input('Post.body.ukr', array('rows' => '3', 'label' => __('Text Ua')));
echo $this->Form->end(__('Save Post'));
?>
