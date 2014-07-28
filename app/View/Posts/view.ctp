<!-- File: /app/views/Posts/view.ctp -->
<article>
<h2><?php echo $post['Post']['title']?></h2>
<p><small>
    <?php echo __('Autor') ?>: <?php echo $this->Html->link($post['User']['username'], array('controller'=>'users', 'action' => 'view', $post['Post']['user_id']));?>
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

<div class="starRate">
	<?php $ul_classes = array("nostar", "onestar", "twostar", "threestar", "fourstar", "fivestar"); ?>
	<?php $ul = '<ul id="rate" class="rating ' . $ul_classes[round($post['Post']['rating'])] . '">'; ?>
	<?php
		if (!empty($post['Post']['rate'])) {
			echo __("Your rate the material at: ");
			echo $post['Post']['rate'];
			echo "<small>";
			echo $this->Html->link(__('Delete vote', true), array('controller'=>'votes', 'action' => 'delete', $post['Post']['id']));
			echo "</small>";
		} else {
			echo __("You not vote yet");
		}
		
	?>
	<?php echo $ul; ?>
		<?php $lis = array("one", "two", "three", "four", "five"); ?>
		<?php $i = 0; ?>
		<?php foreach ($lis as $li): ?>
			<?php $i++; ?>
			<li class=<?php echo $li; ?>><?php echo $this->Html->link($i . ' Star', array('controller'=>'votes', 'action' => 'add', '?' => array("post_id" => $post['Post']['id'], "rating" => $i))); ?></li>
		<?php endforeach; ?>
		<?php
			if ($post['Post']['people_voted'] != 0) {
				echo "<spam>";
				echo $post['Post']['people_voted'];
				echo __(" votes");
				echo "</spam>";
			} else {
				echo "<spam>";
				echo __("Nobody has voted yet");
				echo "</spam>";
			}
		?>
	</ul>
</div>

<?php echo $this->Text->autoParagraph($post['Post']['body']);?>
</article>

<hr>
<br>
<?php foreach ($post['comments'] as $comment): ?>
<!-- 	<article>
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
	</article> -->

<div class="wrap">
	<?php $path = $this->Path->pathtoavatar(array('id' => $comment['user_id'],'avatar_file_name' => $comment['avatar_file_name']), 'thumb'); ?>
	<?php echo $this->Html->link($this->Html->image($path, array('alt' => $comment['author'])), array('controller'=>'users', 'action' => 'view', $comment['user_id']), array('escape' => false)); ?>  
    <div class="comment" data-owner=<?php echo $comment['author']; ?>>
    	<h3><?php echo $comment['title']; ?></h3>
        <p><?php echo $this->Text->truncate($comment['body'], 250); ?></p>
        <ol class="postscript"> <!-- links and timestamp -->
            <li><?php echo $this->Html->link(
		        __('Delete', true),
		        array('controller'=>'comments', 'action' => 'delete', $comment['id']),
		        null,
		        __('Are you sure?')
		    )?></li>
		    <li><?php echo $this->Html->link(__('Edit', true), array('controller'=>'comments', 'action' => 'edit', $comment['id']));?></li>
            <li class="date"><?php echo __('Created'); ?>: <?php echo $comment['created']?></li>
        </ol>
    </div>
</div>

<?php endforeach; ?>
<?php if($this->Session->read('Auth.User.username')): ?>
<div class="wrap">
<h3><?php echo __('Add Comment'); ?></h3>
<?php
	echo $this->Form->create('Comment', array('url' => array('controller' => 'comments', 'action' => 'add', $post['Post']['id'])));
	echo $this->Form->input('title', array('label' => __('Title')));
	echo $this->Form->input('body', array('rows' => '3', 'label' => __('Text')));
	echo $this->Form->end(__('Save Comment'));
?>
</div>
<?php endif ?>
