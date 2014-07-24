<!-- File: /app/views/Posts/view.ctp -->

<h1><?php echo $post['Post']['title']?></h1>

<p><small>
    <?php echo __('Owner') ?>: <?php echo $this->Html->link($post['User']['username'], array('controller'=>'users', 'action' => 'view', $post['Post']['user_id']));?>
    <?php echo __('Created') ?>: <?php echo $post['Post']['created']?>
    <?php if ($this->Session->read('Auth.User.role') === 'admin' or ($this->Session->read('Auth.User.id') === $post['User']['id'])): ?>
	<?php echo $this->Html->link(
		__('Delete', true),
		array('action' => 'delete', $post['Post']['id']),
		null,
		__('Are you sure?')
	)?>
    <?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $post['Post']['id']));?>
<?php endif; ?>
</small></p>

<?php echo $this->Text->autoParagraph($post['Post']['body']);?>

<hr>
<br>
<?php foreach ($post['comments'] as $comment): ?>
	<article>
	  <h4><?php echo $comment['title']; ?></h4>
	  <p><small>
	  	
	    <?php echo __('Autor'); ?>: <?php echo $this->Html->link($comment['author'], array('controller'=>'users', 'action' => 'view', $comment['user_id']));?>
	    <?php echo __('Created'); ?>: <?php echo $comment['created']?>
	    <?php if ($this->Session->read('Auth.User.role') === 'admin' or ($this->Session->read('Auth.User.id') === $comment['user_id'])): ?>
	    	<?php echo $this->Html->link(
		        __('Delete', true),
		        array('controller'=>'comments', 'action' => 'delete', $comment['id']),
		        null,
		        __('Are you sure?')
		    )?>
		    <?php echo $this->Html->link(__('Edit', true), array('controller'=>'comments', 'action' => 'edit', $comment['id']));?>
	    <?php endif; ?>
	    </small></p>
	  <p><?php echo $this->Text->truncate($comment['body'], 250); ?></p>
	</article>
<?php endforeach; ?>
<?php if($this->Session->read('Auth.User.username')): ?>
<h3><?php echo __('Add Comment'); ?></h3>
<?php
	echo $this->Form->create('Comment', array('url' => array('controller' => 'comments', 'action' => 'add', $post['Post']['id'])));
	echo $this->Form->input('title', array('label' => __('Title')));
	echo $this->Form->input('body', array('rows' => '3', 'label' => __('Text')));
	echo $this->Form->end(__('Save Comment'));
?>
<?php endif ?>
