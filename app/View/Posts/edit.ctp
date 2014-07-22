<!-- File: /app/views/posts/edit.ctp -->

<h1><?php echo __('Edit Post'); ?></h1>
<?php
    echo $this->Form->create('Post', array('action' => 'edit'));
    echo $this->Form->input('title', 'label' => "title");
    echo $this->Form->input('body', array('rows' => '3'));
    echo $this->Form->input('id', array('type' => 'hidden'));
    echo $this->Form->end(__('Save Post'));
?>
