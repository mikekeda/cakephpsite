<!-- File: /app/views/posts/index.ctp  (edit links added) -->

<h2><?php echo __('Blog posts'); ?></h2>

<?php foreach ($posts as $post): ?>
<article>
  <h2><?php echo $this->Html->link($post['Post']['title'], array('action' => 'view', $post['Post']['id']));?></h2>
  <p><small>
    <?php echo __('Autor'); ?>: <?php echo $this->Html->link($post['User']['username'], array('controller'=>'users', 'action' => 'view', $post['Post']['user_id']));?>
    <?php echo __('Created'); ?>: <?php echo $post['Post']['created']?>
    <?php if ($this->Session->read('Auth.User.role') === 'admin' or ($this->Session->read('Auth.User.role') === 'editor' and $this->Session->read('Auth.User.id') === $post['Post']['user_id'])): ?>
    <?php echo $this->Html->link(
        __('Delete', true),
        array('action' => 'delete', $post['Post']['id']),
        null,
        __('Are you sure?')
    )?>
    <?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $post['Post']['id']));?>
    <?php endif; ?>
    </small></p>
  <p><?php echo $this->Text->truncate($post['Post']['body'], 250); ?></p>
  <p><small><?php echo $this->Html->link(__("Read More", true), array('action' => 'view', $post['Post']['id']));?></small></p>
</article>
<?php endforeach; ?>

<?php echo $this->Paginator->prev(' << ' . __('previous'), array(), null, array('class' => 'prev disabled')); ?>
<?php echo $this->Paginator->numbers(); ?>
<?php echo $this->Paginator->next(__('next', true) . ' >> ', array(), null, array('class' => 'disabled')); ?>
