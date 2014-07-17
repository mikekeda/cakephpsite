<?php
class Post extends AppModel {

	var $name = 'Post';

    public $components = array('Paginator');

    public $paginate = array(
        'limit' => 10,
        'order' => array(
            'Post.title' => 'asc'
        )
    );

    var $validate = array(
        'title' => array(
            'rule' => 'notEmpty'
        ),
        'body' => array(
            'rule' => 'notEmpty'
        ),
        'user_id' => array(
            'rule' => 'notEmpty'
        )
    );

	public function isOwnedBy($post, $user) {
		return $this->field('id', array('id' => $post, 'user_id' => $user)) !== false;
	}

}