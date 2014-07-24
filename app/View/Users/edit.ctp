<!-- File: /app/views/users/Edit.ctp  (edit links added) -->

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
        echo $this->Form->input('password', array( 'label' => __('New Password (leave empty if you do not want to change)'), 'maxLength' => 255, 'type'=>'password','required' => 0));
        echo $this->Form->input('password_confirm', array('label' => 'Confirm New Password *', 'maxLength' => 255, 'title' => __('Confirm New password'), 'type'=>'password','required' => 0));
        if ($this->Session->read('Auth.User.role') === 'admin') {
            echo $this->Form->input('role', array(
                'options' => array('admin' => __('admin'), 'editor' => __('editor'), 'user' => __('user'), 'banned' => __('banned'))
            ));
        }
        echo $this->Form->submit(__('Edit User'), array('class' => 'form-submit',  'title' => __('Click here to add the user')) );
?>
    </fieldset>
<?php echo $this->Form->end(); ?>
</div>
<?php $path = $this->Path->pathtoavatar($this->data['User'], 'thumb'); ?>
<?php if ($this->Session->read('Auth.User.role') === 'admin' or ($this->Session->read('Auth.User.id') === $this->data['User']['id'])): ?>
<?php echo $this->Html->image($path, array('alt' => $this->data['User']['username'])); ?>
<br>
<?php echo $this->Html->link(__('Delete profile', true), array('action'=>'delete', $this->data['User']['id']) );?>
<?php endif; ?>
<?php unset($user); ?>