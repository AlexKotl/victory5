<?php
/**
 * Created by PhpStorm.
 * User: slicer
 * Date: 08.10.16
 * Time: 20:20
 */

class Site {
	public function index() {
		echo file_get_contents(dirname(__FILE__).'/../app/index.html');
	}
}
?>