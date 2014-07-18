<!-- File: /app/views/Users/view.ctp  (edit links added) -->

<div class="users form">
<h1>Users</h1>
<table>
    <thead>
        <tr>
            <th>Id</th>
            <th>Username</th>
            <th>Email</th>
            <th>Created</th>
            <th>Last Update</th>
            <th>Role</th>
        </tr>
    </thead>
    <tbody>                      
        <?php $count=0; ?>
        <?php if($count % 2): echo '<tr>'; else: echo '<tr class="zebra">' ?>
        <?php endif; ?>
            <td><?php echo $this->Form->checkbox('User.id.'.$user['User']['id']); ?> <?php echo $user['User']['id']; ?></td>
            <td><?php echo $this->Html->link($user['User']['username'], array('action'=>'edit', $user['User']['id']),array('escape' => false) );?></td>
            <td style="text-align: center;"><?php echo $user['User']['email']; ?></td>
            <td style="text-align: center;"><?php echo $this->Time->niceShort($user['User']['created']); ?></td>
            <td style="text-align: center;"><?php echo $this->Time->niceShort($user['User']['modified']); ?></td>
            <td style="text-align: center;"><?php echo $user['User']['role']; ?></td>
        </tr>
      
    </tbody>
</table>

<?php foreach ($user['posts'] as $post): ?>
<article>
  <h3><?php echo $this->Html->link($post['title'], array('action' => 'view', $post['id']));?></h3>
  <p><small>
    Autor: <?php echo $this->Html->link(__($user['User']['username'], true), array('controller'=>'users', 'action' => 'view', $post['user_id']));?>
    Created: <?php echo $post['created']?>
    <?php echo $this->Html->link(
                'Delete',
                array('action' => 'delete', $post['id']),
                null,
                'Are you sure?'
            )?>
            <?php echo $this->Html->link('Edit', array('action' => 'edit', $post['id']));?>
    </small></p>
  <p><?php echo $this->Text->truncate($post['body'], 250); ?></p>
  <p><small><?php echo $this->Html->link("Read More", array('action' => 'view', $post['id']));?></small></p>
</article>
<?php endforeach; ?>

</div>               
<?php echo $this->Html->link( "Add A New User.",   array('action'=>'add'),array('escape' => false)); ?>
<br>

<?php $path = $this->Path->pathtoavatar($user['User'], 'thumb'); ?>
<?php echo $this->Html->image($path, array('alt' => $this->Session->read('Auth.User.username'))); ?>
<?php unset($user); ?>
