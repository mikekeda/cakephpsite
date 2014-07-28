<?php
/**
 *
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
App::import('Controller', 'users');
$CompanyName = __("World of Blogs");
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $CompanyName ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('cake.generic');
		echo $this->Html->css('user');

		echo $this->fetch('meta');
		echo $this->Html->meta('/favicon.ico', '/favicon.png', array('type' => 'icon'));
		echo $this->fetch('css');
		echo $this->fetch('script');
		echo $this->Html->script('jquery');
		echo $this->Html->script('jquery.validate');
		echo $this->Html->script('myjs');
	?>
</head>
<body>
	<div id="container">
		<div id="header">
			<h1><?php echo $this->Html->link($CompanyName, '/'); ?></h1>
			<?php
				if($this->Session->read('Auth.User.username')) {
					$path = $this->Path->pathtoavatar($this->Session->read('Auth.User'), 'thumb');
					echo $this->Html->image($path, array('alt' => $this->Session->read('Auth.User.username')));
				}
			?>
			<div id="minemenu">
				<ul class="flags">
					<li>
					<?php echo $this->Html->link(
						$this->Html->image('/' . APP_DIR . '/' . WEBROOT_DIR . '/img/flags/ua.png', array('alt' => 'ua')), array('action' => 'changeLanguage', 'ukr'), array('escape' => false)
						);
					?>
					</li>
					<li>
					<?php echo $this->Html->link(
						$this->Html->image('/' . APP_DIR . '/' . WEBROOT_DIR . '/img/flags/en.png', array('alt' => 'en')), array('action' => 'changeLanguage', 'eng'), array('escape' => false)
						);
					?>
					</li>
				</ul>
				<nav>
					<?php
						if ($this->Session->read('Auth.User.role') === 'admin' or $this->Session->read('Auth.User.role') === 'editor') {
							echo $this->Html->link(__("Add Post"), array('action' => 'add'), array('class' => 'link'));
						}
						if($this->Session->read('Auth.User.username')) {
		/*					$path = $this->Path->pathtoavatar($this->Session->read('Auth.User'), 'thumb');
							echo $this->Html->image($path, array('alt' => $this->Session->read('Auth.User.username')));*/
						   // user is logged in, show logout..user menu etc
							echo $this->Html->link(__("Profile"), array('controller'=>'users', 'action' => 'view', $this->Session->read('Auth.User.id')), array('class' => 'link'));
							echo $this->Html->link(__('Logout', true), array('controller'=>'users', 'action'=>'logout'), array('class' => 'link'));
						} else {
						   // the user is not logged in
							echo $this->Html->link(__('Sign up', true), array('controller'=>'users', 'action'=>'signup'), array('class' => 'link'));
							echo $this->Html->link(__('Log in', true), array('controller'=>'users', 'action'=>'login'), array('class' => 'link'));
						}
					?>
				</nav>
			</div>
			<?php
				if (!$this->Session->read('Auth.User.username')) {
					echo '<div class="forminline">';
				    echo $this->Session->flash('auth');
				    echo $this->Form->create('User', array('inputDefaults' => array('label' => false, 'div' => false), 'class' => 'loginform', 'url' => array('controller' => 'users', 'action' => 'login')));
				    echo '<fieldset>';
				        echo $this->Form->input('username');
				        echo $this->Form->input('password');
				    echo '</fieldset>';
				    $options = array(
					    'label' => __('Login'),
					    'value' => __('Login'),
					    'div' => false
					);
				    echo $this->Form->end($options);
					echo '</div>';
				}
			 ?>
		</div>
		<div id="content">

			<?php echo $this->Session->flash(); ?>

			<?php echo $this->fetch('content'); ?>
		</div>
		<div id="footer">
		</div>
	</div>
	<?php echo $this->element('sql_dump'); ?>
</body>
</html>
