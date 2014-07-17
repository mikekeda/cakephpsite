<!-- File: /app/views/posts/Edit.ctp  (edit links added) -->

<div class="users form">
<?php echo $this->Form->create('User'); ?>
    <fieldset>
        <legend><?php echo __('Sign up'); ?></legend>
        <?php
        echo $this->Form->input('username', array('label' => 'Usernames cannot be changed!'));
        echo $this->Form->input('email');
        echo $this->Form->input('name');
        echo $this->Form->input('surname');
        echo $this->Form->input('password', array( 'label' => 'Password', 'maxLength' => 255, 'type'=>'password','required' => 0));
        echo $this->Form->input('password_confirm', array('label' => 'Confirm Password *', 'maxLength' => 255, 'title' => 'Confirm password', 'type'=>'password','required' => 0));
         
 
        echo $this->Form->input('role', array(
            'options' => array('admin', 'editor', 'user', 'banned')
        ));
        echo $this->Form->submit('Sign up', array('class' => 'form-submit',  'title' => 'Click here to Sign up') );
?>
    </fieldset>
<?php echo $this->Form->end(); ?>
</div>
<?php
echo $this->Html->link( "Return to Dashboard",   array('action'=>'index') );
?>
<br/>
<?php
echo $this->Html->link( "Logout",   array('action'=>'logout') );
?>