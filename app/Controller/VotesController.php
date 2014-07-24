<?php

class VotesController extends AppController {

    function delete($id) {
		if ($this->Vote->delete($id)) {
			$this->Session->setFlash(__('The vote with id: ' . $id . ' has been deleted.'));
			$this->redirect($this->referer());
		}
	}

	public function add() {
		$this->loadModel('Post');
		//$this->Post->recursive = 0;
		$this->Post->id = $this->request->query['post_id'];
		if ($this->Post->read('voted')['Post']['voted'] === '0') {
			$this->Vote->create();
			if ($this->Vote->save($this->request->query)) {
				$this->Session->setFlash(__('Your vote has been saved'));
				return $this->redirect($this->referer());
			}
			$this->Session->setFlash(
			__('The vote could not be saved. Please, try again.')
			);
		} else {
			$this->Session->setFlash(
				__('You olredy voted!')
			);
		}
		return $this->redirect($this->referer());
	}

	public function isAuthorized($user) {
		if (isset($user['role'])) {
			// admin can do anything
			if ($user['role'] === 'admin') {
				return true;
			}
			// anyelse can edit only his own profile
			if (in_array($this->action, array('delete')) && $user['id'] == $this->request->params['pass'][0]) {
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
