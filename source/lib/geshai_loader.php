<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}
class geshai_loader {
	function __construct() {
	}
	function geshai_loader() {
		$this->__construct ();
	}
	
	
	function sdir($kn = null) {
		if (func_num_args () < 1) {
			return _g ( 'dir>root' );
		}
		if ($kn == ':') {
			return GESHAI_ROOT;
		}
		if (preg_match ( "/^:(\w+)/", $kn )) {
			$r = GESHAI_ROOT;
			$k = substr ( $kn, 1 );
		} else {
			if (! preg_match ( "/^(\w+)$/", $kn )) {
				return null;
			}
			$r = _g ( 'dir>root' );
			$k = $kn;
		}
		$d = array (
				'data' => 'data',
				'source' => 'source',
				'template' => 'template',
				'static' => 'static',
				'uploadfile' => 'uploadfile',
				'html' => 'html',
				'plugin' => 'plugin',
				'install' => 'install' 
		);
		if (my_array_key_exist ( $k, $d )) {
			$v = ($r . DS . my_array_value ( $k, $d ));
		} else {
			$v = null;
		}
		return $v;
	}
	
	
	function lib($name = null, $param = null, $is_instance = false) {
		$c_name = 'geshai_' . $name;
		$filename = sdir ( ':source' ) . '/lib/' . $c_name . '.php';
		if (! is_file ( $filename )) {
			return null;
		}
		
		
		if (! class_exists ( $c_name )) {
			require ($filename);
		}
		
		if ($is_instance === true) {
			return new $c_name ( $param );
		}
	}
	
	
	function print_message($message, $redirectUrl, $param) {
		$_file = sdir ( ':source' ) . '/helper/message.php';
		if (is_file ( $_file )) {
			include ($_file);
		} else {
			prt ( $message );
		}
	}
	
	
	function api($name, $filename, $ext = '.php') {
		$_file = sdir ( ':source' ) . '/api/' . $name . '/' . $filename . $ext;
		if (! is_file ( $_file )) {
			return false;
		}
		return $_file;
	}
}
?>