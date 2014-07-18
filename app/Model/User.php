<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class User extends AppModel {

	var $name = 'User';
	var $actsAs = array(
		'UploadPack.Upload' => array(
			'avatar' => array(
				'styles' => array(
					'thumb' => '80x80'
				)/*,
				'path' => 'img/users'*/
			)
		)
	);

	public $validate = array(
		'username' => array(
			'required' => array(
				'rule' => array('notEmpty'),
				'message' => 'A username is required'
			)
		),

		'email' => array(
			'required' => array(
				'rule' => array('notEmpty'),
				'message' => 'A email is required'
			)
		),

		'password' => array(
			'required' => array(
				'rule' => array('notEmpty'),
				'message' => 'A password is required'
			)
		),

		'name' => array(
			'required' => array(
				'rule' => array('notEmpty'),
				'message' => 'A name is required'
			)
		),

		'surname' => array(
			'required' => array(
				'rule' => array('notEmpty'),
				'message' => 'A surname is required'
			)
		),

		'role' => array(
			'valid' => array(
				'rule' => array('inList', array('admin', 'editor', 'user', 'banned')),
				'message' => 'Please enter a valid role',
				'allowEmpty' => false
			)
		),

		'attachment' => array(
			/*'default_url' => '/app/webroot/upload/users/index.jpeg',*/
			'notEmpty' => array(
                'allowEmpty' => true
            ),
			'maxSize' => array(
				'rule' => array('attachmentMaxSize', 1048576),
				'message' => "Avatar can't be larger than 1MB"
			),
			'minSize' => array(
				'rule' => array('attachmentMinSize', 1024),
				'message' => "Avatar can't be smaller than 1KB"
			),
			'image' => array(
				'rule' => array('attachmentContentType', 'image/jpeg', 'image/png'),
				'message' => 'Only jpegs or png please'
			),
		)
	);

	public function beforeSave($options = array()) {
		if (isset($this->data[$this->alias]['password'])) {
			$passwordHasher = new SimplePasswordHasher();
			$this->data[$this->alias]['password'] = $passwordHasher->hash(
				$this->data[$this->alias]['password']
			);
		}
		return true;
	}

}
?>