<?php
class Comment extends AppModel {

	public $name = 'Comment';

    public $virtualFields = array(
        'author' => 'SELECT username FROM users where id = user_id'
    );

    public $belongsTo = array(
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'user_id'
        ),
        'Post' => array(
            'className' => 'Post',
            'foreignKey' => 'post_id'
        )
    );

    public $validate = array(
        'body' => array(
            'rule' => 'notEmpty'
        ),
        'user_id' => array(
            'rule' => 'notEmpty'
        ),
        'post_id' => array(
            'rule' => 'notEmpty'
        )
    );

	public function isOwnedBy($comment, $user) {
		return $this->field('id', array('id' => $comment, 'user_id' => $user)) !== false;
	}

}
