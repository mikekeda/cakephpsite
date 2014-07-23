<!-- File: /app/views/Users/view.ctp  (edit links added) -->

<div class="users form">
<h1>Users</h1>
<table>
    <thead>
        <tr>
            <th>Id</th>
            <th><?php echo __('Username') ?></th>
            <?php if($this->Session->read('Auth.User.username')) {
                echo "<th>" . __("Email") . "</th>";
            }
            ?>
            <th><?php echo __('Created') ?></th>
            <th><?php echo __('Last visit') ?></th>
            <th><?php echo __('Role') ?></th>
        </tr>
    </thead>
    <tbody>                      
        <?php $count=0; ?>
        <?php if($count % 2): echo '<tr>'; else: echo '<tr class="zebra">' ?>
        <?php endif; ?>
            <td><?php echo $this->Form->checkbox('User.id.'.$user['User']['id']); ?> <?php echo $user['User']['id']; ?></td>
            <td><?php echo $this->Html->link($user['User']['username'], array('action'=>'edit', $user['User']['id']),array('escape' => false) );?></td>
            <?php if($this->Session->read('Auth.User.username')) {
                echo '<td style="text-align: center;">' . $user['User']['email'] . '></td>';
            }
            ?>
            <td style="text-align: center;"><?php echo $this->Time->niceShort($user['User']['created']); ?></td>
            <td style="text-align: center;"><?php echo $this->Time->niceShort($user['User']['last_visit']); ?></td>
            <td style="text-align: center;"><?php echo $user['User']['role']; ?></td>
        </tr>
      
    </tbody>
</table>

<?php foreach ($user['posts'] as $post): ?>
<article>
  <h3><?php echo $this->Html->link($post['title'], array('controller'=>'posts', 'action' => 'view', $post['id']));?></h3>
  <p><small>
    <?php echo __('Autor') ?>: <?php echo $this->Html->link($user['User']['username'], array('controller'=>'users', 'action' => 'view', $post['user_id']));?>
    <?php echo __('Created') ?>: <?php echo $post['created']?>
    <?php if ($this->Session->read('Auth.User.role') === 'admin' or ($this->Session->read('Auth.User.id') === $user['User']['id'])): ?>
    <?php echo $this->Html->link(
        __('Delete'),
        array('action' => 'delete', $post['id']),
        null,
        __('Are you sure?')
    ) ?>
    <?php echo $this->Html->link(__('Edit', true), array('controller' => 'posts', 'action' => 'edit', $post['id']));?>
    <?php endif; ?>
    </small></p>
  <p><?php echo $this->Text->truncate($post['body'], 250); ?></p>
  <p><small><?php echo $this->Html->link(__("Read More", true), array('action' => 'view', $post['id']));?></small></p>
</article>
<?php endforeach; ?>

</div>
<?php $path = $this->Path->pathtoavatar($user['User'], 'thumb'); ?>
<?php echo $this->Html->image($path, array('alt' => $user['User']['username'])); ?>            
<?php if ($this->Session->read('Auth.User.role') === 'admin' or ($this->Session->read('Auth.User.id') === $user['User']['id'])): ?>
<br>
<?php echo $this->Html->link(__('Edit profile', true), array('action'=>'edit', $user['User']['id']) );?>
<br>
<?php echo $this->Html->link(__('Delete profile', true), array('action'=>'delete', $user['User']['id']) );?>
<?php endif; ?>
<?php unset($user); ?>
