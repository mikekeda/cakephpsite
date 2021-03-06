<div class="users form">
<h1>Users</h1>
<table>
    <thead>
        <tr>
            <th><?php echo $this->Form->checkbox('all', array('name' => 'CheckAll',  'id' => 'CheckAll')); ?></th>
            <th><?php echo $this->Paginator->sort('username', 'Username');?>  </th>
            <th><?php echo $this->Paginator->sort('created', 'Created');?></th>
            <th><?php echo $this->Paginator->sort('last_visit','Last visit');?></th>
            <th><?php echo $this->Paginator->sort('role','Role');?></th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>                      
        <?php $count=0; ?>
        <?php foreach($users as $user): ?>               
        <?php $count ++;?>
        <?php if($count % 2): echo '<tr>'; else: echo '<tr class="zebra">' ?>
        <?php endif; ?>
            <td><?php echo $this->Form->checkbox('User.id.'.$user['User']['id']); ?> <?php echo $user['User']['id']; ?></td>
            <td><?php echo $this->Html->link( $user['User']['username'],   array('action'=>'edit', $user['User']['id']), array('escape' => false));?></td>
            <td style="text-align: center;"><?php echo $this->Time->niceShort($user['User']['created']); ?></td>
            <td style="text-align: center;"><?php echo $this->Time->niceShort($user['User']['last_visit']); ?></td>
            <td style="text-align: center;"><?php echo $user['User']['role']; ?></td>
            <td >
            <?php echo $this->Html->link(    "Edit",   array('action'=>'edit', $user['User']['id']) ); ?>
            |
            <?php echo $this->Html->link(    "Delete",   array('action'=>'delete', $user['User']['id']) ); ?>
            </td>
        </tr>
        <?php endforeach; ?>
        <?php unset($user); ?>
    </tbody>
</table>
<?php echo $this->Paginator->prev(' << ' . __('previous'), array(), null, array('class' => 'prev disabled')); ?>
<?php echo $this->Paginator->numbers(); ?>
<?php echo $this->Paginator->next(__('next', true) . ' >> ', array(), null, array('class' => 'disabled')); ?>
</div> 
