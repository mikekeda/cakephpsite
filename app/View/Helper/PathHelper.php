<?php

/*
This helper procesing path to imeges
*/

App::uses('AppHelper', 'View/Helper');

class PathHelper extends AppHelper {
    public function pathtoavatar($user, $filetype) {
    	$default_path = '/' . APP_DIR . '/' . WEBROOT_DIR . '/upload/users/default.jpeg';
		$filename = $user['avatar_file_name'];
		$pos = strrpos($filename, '.');
		$filename = substr($filename, 0, $pos) . '_' . $filetype . substr($filename, $pos);
		$path = 'upload/users/' . $user['id'] . '/' . $filename;
		if (file_exists(WWW_ROOT . $path)) {
			return '/' . APP_DIR . '/' . WEBROOT_DIR . '/' . $path;
		} else {
			return $default_path;
		}
	}
}

?>
