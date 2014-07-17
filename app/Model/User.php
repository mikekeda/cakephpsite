<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class User extends AppModel {
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