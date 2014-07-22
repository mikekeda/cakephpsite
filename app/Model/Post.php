<?php
class Post extends AppModel {

	public $name = 'Post';

    public $actsAs = array(
        'Translate' => array(
            'title', 'body'
        )
    );

/*    public $locale = 'eng';*/
    public $translateModel = 'PostI18n';
    public $translateTable = 'PostI18n';

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
