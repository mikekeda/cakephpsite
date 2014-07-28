<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */

class AppController extends Controller {

	public $helpers = array('Path', 'Js' => array('Jquery'));

	public $components = array(
		'Session',
		'Auth' => array(
			'loginRedirect' => array('controller' => 'posts', 'action' => 'index'),
			'logoutRedirect' => array('controller' => 'pages', 'action' => 'display', 'home'),
			'authorize' => array('Controller')
		)
	);

	public function beforeFilter() {
		$this->Auth->allow('view', 'changeLanguage');
	    if ($this->Session->check('Config.language')) {
			Configure::write('Config.language', $this->Session->read('Config.language'));
		} else {
			Configure::write('Config.language', 'eng');
		}
	}

	public function isAuthorized($user) {
		if (isset($user['role']) && $user['role'] === 'admin') {
			return true;
		}
		$this->redirect(array('controller' => 'users', 'action' => 'view'), $user['id']);
		return false;
	}

	public function changeLanguage($lang){
		if(empty($lang)){
			$lang = 'eng';
		}
		debug($lang);
        if($lang == 'eng'){
            $this->Session->write('Config.language', 'eng');
            Configure::write('Config.language', 'eng');
            setlocale(LC_ALL,'en_US.utf8');
            $locale = 'eng';
        }

        else if($lang == 'ukr'){
            $this->Session->write('Config.language', 'ukr');
            Configure::write('Config.language', 'ukr');
            putenv ("LC_ALL=uk_UK");
            setlocale (LC_ALL, "uk_UA.utf8");
            $locale = 'ukr';
        }
        //in order to redirect the user to the page from which it was called
        $this->redirect($this->referer());
    }

}

/*
function setLanguage() {
	if(!isset($this->params['lang'])) $this->params['lang'] = 'ro';
	$lang = $this->params['lang'];
	App::import('Core', 'i18n');
	$I18n =& I18n::getInstance();
	$I18n->l10n->get($lang);
	foreach (Configure::read('Config.languages') as $lang => $locale) {
		if($lang == $this->params['lang'])
		$this->params['locale'] = $locale['locale'];
	}
}*/