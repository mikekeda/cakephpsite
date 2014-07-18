<?php

/*
This helper procesing path to imeges
*/

App::uses('AppHelper', 'View/Helper');

class PathHelper extends AppHelper {
    public function pathtoavatar($user, $filetype) {
		$filename = $user['avatar_file_name'];
		$pos = strrpos($filename, '.');
		$filename = substr($filename, 0, $pos) . '_' . $filetype . substr($filename, $pos);
		$path = '/app/webroot/upload/users/' . $user['id'] . '/' . $filename;
		return $path;
	}
}

?>
