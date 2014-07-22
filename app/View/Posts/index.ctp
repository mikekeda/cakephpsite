<!-- File: /app/views/posts/index.ctp  (edit links added) -->

<h2>Blog posts</h2>
<!-- /**
<table>
    <tr>
        <th>Id</th>
        <th>Title</th>
        <th>Owner</th>
        <th>Created</th>
        <th>Action</th>
    </tr>

<?php foreach ($posts as $post): ?>
    <tr>
        <td><?php echo $post['Post']['id']; ?></td>
        <td>
            <?php echo $this->Html->link($post['Post']['title'], array('action' => 'view', $post['Post']['id']));?>
        </td>
        <td><?php echo $this->Html->link(__($post['Post']['owner']['User']['username'], true), array('controller'=>'users', 'action' => 'view', $post['Post']['user_id']));?></td>
        <td><?php echo $post['Post']['created']; ?></td>
        <td>
            <?php echo $this->Html->link(
                'Delete',
                array('action' => 'delete', $post['Post']['id']),
                null,
                'Are you sure?'
            )?>
            <?php echo $this->Html->link('Edit', array('action' => 'edit', $post['Post']['id']));?>
        </td>
    </tr>
<?php endforeach; ?>

</table>
**/ -->

<!--
<?php foreach ($posts as $post): ?>
<article>
  <h3><?php echo $this->Html->link($post['Post']['title'], array('action' => 'view', $post['Post']['id']));?></h3>
  <p><small>
    Autor: <?php echo $this->Html->link(__($post['Post']['owner']['User']['username'], true), array('controller'=>'users', 'action' => 'view', $post['Post']['user_id']));?>
    Created: <?php echo $post['Post']['created']?>
    <?php echo $this->Html->link(
                'Delete',
                array('action' => 'delete', $post['Post']['id']),
                null,
                'Are you sure?'
            )?>
            <?php echo $this->Html->link('Edit', array('action' => 'edit', $post['Post']['id']));?>
    </small></p>
  <p><?php echo $this->Text->truncate($post['Post']['body'], 250); ?></p>
  <p><small><?php echo $this->Html->link("Read More", array('action' => 'view', $post['Post']['id']));?></small></p>
</article>
<?php endforeach; ?>
-->

<?php foreach ($posts as $post): ?>
<article>
  <h3><?php echo $this->Html->link($post['Post']['title'], array('action' => 'view', $post['Post']['id']));?></h3>
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
