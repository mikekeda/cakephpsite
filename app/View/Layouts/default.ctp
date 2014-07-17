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

$CompanyName = "Header";
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
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body>
	<div id="container">
		<div id="header">
			<h1><?php echo $this->Html->link($CompanyName, '/'); ?></h1>
			<p><?php echo $this->Html->link("Add Post", array('action' => 'add'), array('class' => 'link')); ?></p>
			<?php
				if($this->Session->read('Auth.User.username')) {
					echo $this->Html->link(__($this->Session->read('Auth.User.username'), true), array('controller'=>'users', 'action' => 'view', $this->Session->read('Auth.User.id')), array('class' => 'link'));
				   // user is logged in, show logout..user menu etc
					echo $this->Html->link(__('Logout', true), array('controller'=>'users', 'action'=>'logout'), array('class' => 'link'));
				} else {
				   // the user is not logged in
					echo $this->Html->link(__('Login', true), array('controller'=>'users', 'action'=>'login'), array('class' => 'link'));
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
