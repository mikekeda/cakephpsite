<div class="users form">
	<?php echo $this->Session->flash('auth'); ?>
	<?php echo $this->Form->create('User'); ?>
	<fieldset>
		<legend>
			<?php echo __('Please enter your username and password'); ?>
		</legend>
		<?php
		echo $this->Form->input('username', array('label' => __('Username or e-mail:')));
		echo $this->Form->input('password', array('label' => __('Password:')));
		?>
	</fieldset>
	<?php echo $this->Form->end(__('Login')); ?>
</div>