<?php
class UsersController extends AppController {

	public $helpers = array('Form', 'UploadPack.Upload', 'Path');

	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('login', 'logout', 'signup');
	}

/*	public function canUploadMedias($model, $id){
	    if($model == 'User' & $id = $this->Session->read('Auth.User.id')){
	        return true; // Everyone can edit the medias for their own record
	    }
	    return $this->Session->read('Auth.User.role') == 'admin'; // Only admins can upload medias for everything else
	}*/

	public function index() {
		$this->User->recursive = 0;
		$this->set('users', $this->paginate());
	}

	public function view($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		$this->set('user', $this->User->read(null, $id));
	}

	public function login() {
		if($this->request->is('post')) {
			App::Import('Utility', 'Validation');
			if( isset($this->data['User']['username']) &&
			Validation::email($this->data['User']['username'])) {
				$this->request->data['User']['email'] = $this->data['User']['username'];
				$this->Auth->authenticate['Form'] = array('fields' =>
				array('username' => 'email'));
			}
			if(!$this->Auth->login()) {
				$this->Session->setFlash(__('Invalid username or password, try again'));
			} else {
				$this->redirect($this->Auth->redirect());
			}
		}
	}

	public function logout() {
		$this->Auth->logout();
		$this->redirect(array('controller' => 'posts', 'action' => 'index', 'home'));
	}

	public function signup() {

		$helpers = array('Form', 'UploadPack.Upload');

		//if ($this->request->is('post')) {
		if (!empty($this->data)) {
			$this->User->create();
			if ($this->User->save($this->data)) {
				$this->Session->setFlash(__('Welcome'));
				$this->Auth->login();
				return $this->redirect(array('action' => 'index'));
			}
			$this->Session->setFlash(
			__('Please, try again.')
			);
		}
	}

	public function add() {
		if ($this->request->is('post')) {
			$this->User->create();
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved'));
				return $this->redirect(array('action' => 'index'));
			}
			$this->Session->setFlash(
			__('The user could not be saved. Please, try again.')
			);
		}
	}

	public function edit($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved'));
				$this->Session->write('Auth', $this->User->read(null, $this->Auth->User('id')));
				return $this->redirect(array('action' => 'view', $this->User->id));
			}
			$this->Session->setFlash(
			__('The user could not be saved. Please, try again.')
			);
		} else {
			$this->request->data = $this->User->read(null, $id);
			unset($this->request->data['User']['password']);
		}

	}

	public function delete($id = null) {
		$this->request->onlyAllow('post');
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->User->delete()) {
			$this->Session->setFlash(__('User deleted'));
			return $this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('User was not deleted'));
		return $this->redirect(array('action' => 'index'));
	}

	public function isAuthorized($user) {
		if (in_array($this->action, array('add', 'edit', 'delete'))) {
			return true;
		}
		return parent::isAuthorized($user);
	}

}

?>
