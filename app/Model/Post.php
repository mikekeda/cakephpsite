<?php
class Post extends AppModel {

	public $name = 'Post';

    public $belongsTo = array(
        'User' => array(
        'className' => 'User',
        'foreignKey' => 'user_id'
        )
    );

    public $validate = array(
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