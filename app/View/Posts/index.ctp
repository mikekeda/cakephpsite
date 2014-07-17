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

<?php if ($curentpage > 0) {
        echo $this->Html->link(__('Previus Page ', true), array('action' => 'index', $curentpage - 1));
    }
?>
<?php if ($curentpage < $totalpages - 1) {
        echo $this->Html->link(' Next Page', array('action' => 'index', $curentpage + 1));
    }    
?>
