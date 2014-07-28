<?php

class CommentsController extends AppController {

	public $components = array('Paginator');

	public $paginate = array(
		'limit' => 20
	);

    function delete($id) {
		if ($this->Comment->delete($id)) {
			$this->Session->setFlash(__('The comment with id: ' . $id . ' has been deleted.'));
			$this->redirect($this->referer());
		}
	}
	
	function edit($id) {
		$this->Comment->id = $id;
		if (empty($this->data)) {
			$this->data = $this->Comment->read(array('id', 'user_id','post_id','title','body'));
			$this->set('user_id', '12'); //потрібно перевірити!
		} else {
			if ($this->Comment->save($this->data)) {
				$this->Session->setFlash('Your comment has been updated.');
				$this->redirect(array('controller' => 'posts', 'action' => 'view', $this->data['Comment']['post_id']));
			}
		}
	}

	public function add($post_id) {
		if ($this->request->is('post')) {
			$this->Comment->create();
			$this->request->data['Comment']['user_id'] = $this->Auth->user('id');
			$this->request->data['Comment']['post_id'] = $post_id;
			if (empty($this->request->data['Comment']['title'])) {
				$this->request->data['Comment']['title'] = mb_substr($this->request->data['Comment']['body'], 0, 15);
			}
			if ($this->Comment->save($this->request->data)) {
				$this->Session->setFlash(__('The comment has been saved'));
				return $this->redirect($this->referer());
			}
			$this->Session->setFlash(
			__('The comment could not be saved. Please, try again.')
			);
		}
	}

	public function isAuthorized($user) {
		if (isset($user['role'])) {
			// admin can do anything
			if ($user['role'] === 'admin') {
				return true;
			}
			// anyelse can edit only his own profile
			if (in_array($this->action, array('edit', 'delete')) && $user['id'] == $this->request->params['pass'][0]) {
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
