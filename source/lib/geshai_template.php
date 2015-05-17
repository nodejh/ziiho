<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}
class geshai_template {
	public $_skin = null;
	function __construct() {
	}
	function geshai_template() {
		$this->__construct ();
	}
	
	
	function init() {
		$this->_skin = 'aaa';
	}
	
	
	function dir($module = null, $isLocal = false) {
		$root = sdir ( ($isLocal === true ? ':' : null) . 'template' );
		$module = _g ( 'module' )->flag ( $module );
		
		$path = ($root . '/main/' . $this->_skin . '/' . $module);
		return $path;
	}
	
	
	function name($module = null, $name = null, $isLocal = false) {
		$dir = $this->dir ( $module, $isLocal );
		$filename = ($dir . '/' . $name . '.php');
		return $filename;
	}
}
?>