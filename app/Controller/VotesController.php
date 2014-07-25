<?php

class VotesController extends AppController {

	public $components = array(
        'RequestHandler'
    );

    function delete($post_id) {
    	if ($this->request->is('ajax')) {
			$this->autoRender = false;
			$this->layout = null;
		}
		if ($this->Vote->deleteAll(array('Vote.post_id' => $post_id, 'Vote.user_id' => $this->Session->read('Auth.User.id')), false)) {
			$this->Session->setFlash(__('The vote has been deleted.'));
			$this->redirect($this->referer());
		}
		//$this->redirect($this->referer());
	}

	public function add() {
		if ($this->request->is('ajax')) {
			$this->autoRender = false;
			$this->layout = null;
		}
		$this->Session->setFlash($this->request->is('ajax'));
		$this->loadModel('Post');
		//$this->Post->recursive = 0;
		$this->Post->id = $this->request->query['post_id'];
		if ($this->Post->read('voted')['Post']['voted'] === '0') {
			$this->request->query['user_id'] = $this->Session->read('Auth.User.id');
			$this->Vote->create();
			if ($this->Vote->save($this->request->query)) {
				
				if ($this->request->is('ajax')) {
					echo __('Thanks for your vote!');
				} else {
					$this->Session->setFlash(__('Thanks for your vote!'));
					return $this->redirect($this->referer());
				}
			} else {
				if ($this->request->is('ajax')) {
					echo __('The vote could not be saved. Please, try again.');
				} else {
					$this->Session->setFlash(__('The vote could not be saved. Please, try again.'));
				}
			}
		} else {
			if ($this->request->is('ajax')) {
				echo __('You olredy voted!');
			} else {
				$this->Session->setFlash(__('You olredy voted!'));
			}
		}
		if (!$this->request->is('ajax')) {
			return $this->redirect($this->referer());
		}
		if ($this->request->is('ajax')) {
			$this->Session->delete('Message.flash');
		}
	}

	public function isAuthorized($user) {
		if (isset($user['role'])) {
			// admin can do anything
			if ($user['role'] === 'admin') {
				return true;
			}
			// anyelse can edit only his own profile
			if ($this->action === 'delete' && in_array($user['role'], array('editor', 'user'))) {
				return true;
			}
			if ($this->action === 'add' && in_array($user['role'], array('editor', 'user'))) {
				return true;
			}
		}
		if (isset($this->request->params['pass'][0])) {
			$this->redirect(array('controller' => 'posts', 'action' => 'view', $this->request->params['pass'][0]));
		} else {
			$this->redirect(array('controller' => 'posts', 'action' => 'index', 'home'));
		}
		return false;
	}

}

?>
