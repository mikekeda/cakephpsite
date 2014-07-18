<!-- File: /app/views/posts/Edit.ctp  (edit links added) -->

<div class="users form">
<?php echo $this->Form->create('User', array('type' => 'file')); ?>
    <fieldset>
        <legend><?php echo __('Edit User'); ?></legend>
        <?php
        echo $this->Form->hidden('id', array('value' => $this->data['User']['id']));
        echo $this->Form->file('avatar');
        echo $this->Form->input('username');
        echo $this->Form->input('email');
        echo $this->Form->input('name');
        echo $this->Form->input('surname');
        echo $this->Form->input('password', array( 'label' => 'New Password (leave empty if you do not want to change)', 'maxLength' => 255, 'type'=>'password','required' => 0));
        echo $this->Form->input('password_confirm', array('label' => 'Confirm New Password *', 'maxLength' => 255, 'title' => 'Confirm New password', 'type'=>'password','required' => 0)); 
        echo $this->Form->input('role', array(
            'options' => array('admin' => 'admin', 'editor' => 'editor', 'user' => 'user', 'banned' => 'banned')
        ));
        echo $this->Form->submit('Edit User', array('class' => 'form-submit',  'title' => 'Click here to add the user') );
?>
    </fieldset>
<?php echo $this->Form->end(); ?>
</div>
<?php $path = $this->Path->pathtoavatar($this->Session->read('Auth.User'), 'thumb'); ?>
<?php echo $this->Html->image($path, array('alt' => $this->Session->read('Auth.User.username'))); ?>