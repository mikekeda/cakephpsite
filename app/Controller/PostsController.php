<?php

class PostsController extends AppController {

	public $components = array('Paginator');

	public $paginate = array(
		'limit' => 10,
		'order' => array(
        	'created' => 'desc'
        )
	);

	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('index', 'view');
	}

	function view($id) {
		//$this->loadModel('Comment');
        $this->Post->id = $id;
        $post = $this->Post->read();
        $post['CurentUser'] = array();
        $post['CurentUser']['Id'] = $this->Session->read('Auth.User.id');
        $this->set('post', $post);
    }

    function delete($id) {
		if ($this->Post->delete($id)) {
			$this->Session->setFlash(__('The post with id: ' . $id . ' has been deleted.'));
			$this->redirect(array('action' => 'index'));
		}
	}
	
	function edit($id = null) {
		$this->loadModel('PostI18n');
		$this->Post->id = $id;  
		/*$this->Post->locale = array('eng','ukr');*/
		if (empty($this->data)) {
			$this->data = $this->Post->read();
			$trans = $this->PostI18n->find('all', array(
		        'conditions' => array('foreign_key' => $id)
		    ));
		    if (!empty($trans)) {
			    $this->request->data['Post'][$trans[0]['PostI18n']['field']] = $arrayName = array();
			    $this->request->data['Post'][$trans[2]['PostI18n']['field']] = $arrayName = array();

			    $this->request->data['Post'][$trans[0]['PostI18n']['field']][$trans[0]['PostI18n']['locale']] = $trans[0]['PostI18n']['content'];
			    $this->request->data['Post'][$trans[1]['PostI18n']['field']][$trans[1]['PostI18n']['locale']] = $trans[1]['PostI18n']['content'];
			    $this->request->data['Post'][$trans[2]['PostI18n']['field']][$trans[2]['PostI18n']['locale']] = $trans[2]['PostI18n']['content'];
			    $this->request->data['Post'][$trans[3]['PostI18n']['field']][$trans[3]['PostI18n']['locale']] = $trans[3]['PostI18n']['content'];
			} else {
				$this->request->data['Post']['title']['eng'] = array($this->data['Post']['title']);
				$this->request->data['Post']['body']['eng'] = array($this->data['Post']['body']);
			}
		} else {
			if ($this->Post->saveMany($this->data)) {
				$this->Session->setFlash('Your post has been updated.');
				$this->redirect(array('action' => 'index'));
			}
		}
	}

	function index($id = 0) {
		$this->Post->recursive = 0;
		$this->loadModel('User');
		$this->Paginator->settings = $this->paginate;
		$posts = $this->Paginator->paginate('Post');
		$this->set('posts', $posts);
    }

	public function add() {
		if ($this->request->is('post')) {
			$this->Post->locale = array('eng','ukr');
			$this->request->data['Post']['user_id'] = $this->Auth->user('id');
			if ($this->Post->saveMany(array($this->request->data))) {
				$this->Session->setFlash(__('Your post has been saved.'));
				$this->redirect(array('action' => 'view', $this->Post->id));
			}
		}
	}

	public function isAuthorized($user) {
		if ($this->action === 'index') {
			return true;
		}
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
