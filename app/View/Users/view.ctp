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
        <?php unset($user); ?>
    </tbody>
</table>
</div>               
<?php echo $this->Html->link( "Add A New User.",   array('action'=>'add'),array('escape' => false) ); ?>
