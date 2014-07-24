<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class User extends AppModel {

	public $name = 'User';

	public $displayField = 'username';

	public $hasMany = array(
		'posts' => array(
			'className' => 'Post',
			'foreignKey' => 'user_id',
			'order' => 'created DESC',
			'limit' => '5',
			'dependent' => true
		),
		'comments' => array(
			'className' => 'Comment',
			'foreignKey' => 'user_id',
			'order' => 'created DESC',
			'limit' => '5',
			'dependent' => true
		)
	);

	public $actsAs = array(
		'UploadPack.Upload' => array(
			'avatar' => array(
				'styles' => array(
					'thumb' => '150x150'
				)
			)
		)
	);

	/*public $validationDomain = 'validation';*/

	public $validate = array(
/*		'avatar_file_name' => array(

			'image' => array(
				'rule' => array('extension', array('gif', 'jpeg', 'png', 'jpg')),
				'message' => 'Please supply a valid image.'
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
				'rule' => array('attachmentContentType', array('image/jpeg', 'image/png')),
				'message' => 'Only jpegs or png please'
			)
		),*/

/*		'image' => array(
		    'rule1'=>array(
		        'rule' => array('extension',array('jpeg','jpg','png','gif')),
		        'required' => 'create',
		        'allowEmpty' => true,
		        'message' => 'Select Valid Image',
		        'on' => 'create',
		        'last'=>true
		    ),
		    'rule2'=>array(
		        'rule' => array('extension',array('jpeg','jpg','png','gif')),
		        'message' => 'Select Valid Image',
		        'on' => 'update',
		    ),
		),*/

		'username' => array(
			'required' => array(
				'rule' => array('notEmpty'),
				'message' => 'A username is required'
			),
			'isUnique' => array(
	            'rule' => 'isUnique',
	            'message' => 'This username has already been taken.'
        	)
		),

		'email' => array(
			'required' => array(
				'rule' => array('notEmpty'),
				'message' => 'A email is required'
			),
			'isUnique' => array(
	            'rule' => 'isUnique',
	            'message' => 'This email already exist.'
        	)
		),

/*		'password' => array(     
		    'minLength' => array(
		        'rule' => array('minLength', 2),
		        'message' => 'Your password must be at least 2 characters long.'
		    )
		),*/

	    'password_confirm' => array(
	        'identicalFieldValues' => array(
	            'rule' => array('identicalFieldValues', 'password'),
	            'message' => 'Password confirmation does not match password.'
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
		)/*,

		'attachment' => array(
			//'default_url' => '/app/webroot/upload/users/index.jpeg'
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
		)*/
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

	function identicalFieldValues( $field=array(), $compare_field=null ) {

        foreach( $field as $key => $value ){
            $v1 = $value;
            $v2 = $this->data[$this->name][ $compare_field ];           
            if($v1 !== $v2) {
                return FALSE;
            } else {
                continue;
            }
        }
        return TRUE;
    } 

}
?>
