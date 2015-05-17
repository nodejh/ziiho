<?php
if (! defined ( 'GESHAI_DIR' )) {
	exit ( 'no direct access allowed' );
}

define ( 'IN_GESHAI', true );
require GESHAI_DIR . '/source/init.php';

$_G ['session']->init ();
$_G ['cookie']->init ();
$_G ['template']->init ();


class base extends geshai_common {
	function __construct() {
		parent::__construct ();
	}
	function base() {
		$this->__construct ();
	}
	

	static function create($module = null) {
		parent::_enter ( $module );
	}
	

	static function captcha() {
		parent::_captcha ();
	}
	function __destruct() {
		global $_G;
		unset ( $_G );
	}
}
?>