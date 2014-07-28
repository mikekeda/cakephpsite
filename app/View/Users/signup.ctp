<!-- File: /app/views/posts/Edit.ctp  (edit links added) -->

<div class="users form">
<?php echo $this->Form->create('User', array('type' => 'file', 'id' => 'SignupForm')); ?>
    <fieldset>
        <legend><?php echo __('Sign up'); ?></legend>
        <?php
        echo $this->Form->file('avatar');
        echo $this->Form->input('username', array('label' => __('Username'), 'name' => 'username'));
        echo $this->Form->input('email', array('label' => __('Email'), 'name' => 'email'));
        echo $this->Form->input('name', array('label' => __('Name'), 'name' => 'name'));
        echo $this->Form->input('surname', array('label' => __('Surname'), 'name' => 'surname'));
        echo $this->Form->input('password', array( /*'id' => 'userpassword', */'label' => __('Password'), 'name' => 'password', 'maxLength' => 255, 'type'=>'password', 'class' => 'required'));
        echo $this->Form->input('password_confirm', array('label' => __('Confirm Password'), 'name' => 'password_confirm', 'maxLength' => 255, 'title' => 'Confirm password', 'type'=>'password', 'class' => 'required'));
         
 
        /*echo $this->Form->input('role', array(
            'options' => array('admin' => 'admin', 'editor' => 'editor', 'user' => 'user', 'banned' => 'banned')
        ));*/
        echo $this->Form->submit(__('Sign up'), array('class' => 'form-submit',  'title' => 'Click here to Sign up') );
?>
    </fieldset>
</div>