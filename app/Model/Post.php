<?php
class Post extends AppModel {

	public $name = 'Post';

    public $actsAs = array(
        'Translate' => array('title', 'body')
    );

    public $virtualFields = array(
        'rating' => 'SELECT AVG(rating) FROM votes where post_id = `Post`.`id`'/*,
        'voted' => 'SELECT COUNT(*) FROM votes where post_id = `Post`.`id` AND user_id = `User`.`id`'*/ //не вірно! автор посту!
    );

    public $translateModel = 'PostI18n';
    public $translateTable = 'Posti18n';

    public $belongsTo = array(
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'user_id'
        )
    );

    public $hasMany = array(
        'comments' => array(
            'className' => 'Comment',
            'foreignKey' => 'post_id',
            'order' => 'created DESC',
            'limit' => '20',
            'dependent' => true
        )/*,
        'votes' => array(
            'className' => 'Vote',
            'foreignKey' => 'post_id',
            'limit' => '1',
            'dependent' => true
        )*/
    );

/*    public $hasMany = array(
        'postI18n' => array(
            'className' => 'PostI18n ',
            'foreignKey' => 'foreign_key',
            'limit' => '2',
            'dependent' => true
        )
    );*/

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

    public function beforeFind($query = array()) {
        if(!parent::beforeFind($query)) {
            return false;
        }

        $this->setupVirtualFields();
        return true;
    }

    public function setupVirtualFields() {
        $user_id = CakeSession::read("Auth.User.id");
        if(!empty($user_id)) {
            $this->virtualFields = array_merge($this->virtualFields, array ( 
                'voted' => sprintf('SELECT COUNT(*) FROM votes where post_id = `Post`.`id` AND user_id = %s', $user_id),
            ));
        }
    }

	public function isOwnedBy($post, $user) {
		return $this->field('id', array('id' => $post, 'user_id' => $user)) !== false;
	}

}
