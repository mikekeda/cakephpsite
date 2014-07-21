<?php

class PostsController extends AppController {

	public $components = array('Paginator');

	public $paginate = array(
		'limit' => 10
	);

	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('index', 'view');
	}

	function view($id) {
		$this->loadModel('User');
        $this->Post->id = $id;
        $post = $this->Post->read();
        $post['Post']['owner'] = $this->User->find('first', array('conditions' => array('id' => $post['Post']['user_id'])));
        $this->set('post', $post);
    }

    function delete($id) {
		if ($this->Post->delete($id)) {
			$this->Session->setFlash('The post with id: ' . $id . ' has been deleted.');
			$this->redirect(array('action' => 'index'));
		}
	}
	
	function edit($id = null) {
		$this->Post->id = $id;
		if (empty($this->data)) {
			$this->data = $this->Post->read();
		} else {
			if ($this->Post->save($this->data)) {
				$this->Session->setFlash('Your post has been updated.');
				$this->redirect(array('action' => 'index'));
			}
		}
	}

	function index($id = 0) {
/*		$articlesonpage = 10;
		$this->loadModel('User');
		$posts = $this->Post->find('all',array(
          'limit'=>$articlesonpage,
          'offset' => $id*$articlesonpage
		));
		$totalpages = ceil($this->Post->find('count') / $articlesonpage);
		$this->set('curentpage', $id);
		$this->set('totalpages', $totalpages);
		foreach ( $posts as &$post ) {
        	$post['Post']['owner'] = $this->User->find('first', array('conditions' => array('id' => $post['Post']['user_id'])));
		}
		$this->set('posts', $posts);*/

		$this->loadModel('User');
		$this->Paginator->settings = $this->paginate;
		$posts = $this->Paginator->paginate('Post');
/*		foreach ( $posts as &$post ) {
        	$post['Post']['owner'] = $this->User->find('first', array('conditions' => array('id' => $post['Post']['user_id'])));
		}*/
		$this->set('posts', $posts);
    }

	public function add() {
		if ($this->request->is('post')) {
			//Added this line
			$this->request->data['Post']['user_id'] = $this->Auth->user('id');
			if ($this->Post->save($this->request->data)) {
				$this->Session->setFlash(__('Your post has been saved.'));
				$this->redirect(array('action' => 'view', $this->Post->id));
			}
		}
	}

	public function isAuthorized($user) {
		if ($this->action === 'index') {
			return true;
		}
		//$this->loadModel('User');

		if (isset($user['role'])) {
			// admin can do anything
			if ($user['role'] === 'admin') {
				return true;
			}

			if ($user['role'] === 'editor') {
				if ($this->action === 'add') {
					return true;
				}
				if (in_array($this->action, array('edit', 'delete'))) {
					$postId = (int) $this->request->params['pass'][0];
					debug($postId);
					if ($this->Post->isOwnedBy($postId, $user['id'])) {
						return true;
					}
				}

			}
		}
		if (isset($this->request->params['pass'][0])) {
			$this->redirect(array('action' => 'view', $this->request->params['pass'][0]));
		} else {
			$this->redirect(array('action' => 'index', 'home'));
		}
	}

}

?>