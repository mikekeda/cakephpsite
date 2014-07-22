<!-- File: /app/views/Posts/view.ctp -->

<h1><?php echo $post['Post']['title']?></h1>

<p><small>
    <?php echo __('Owner') ?>: <?php echo $this->Html->link($post['Post']['owner']['User']['username'], array('controller'=>'users', 'action' => 'view', $post['Post']['user_id']));?>
    <?php echo __('Created') ?>: <?php echo $post['Post']['created']?>
    <?php if ($this->Session->read('Auth.User.role') === 'admin' or ($this->Session->read('Auth.User.id') === $post['Post']['owner']['User']['id'])): ?>
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
