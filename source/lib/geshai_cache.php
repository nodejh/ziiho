<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}
class geshai_cache {
	public $root = null;
	function __construct() {
		$this->root = sdir ( ':data' );
	}
	function geshai_cache() {
		$this->__construct ();
	}
	function read($module, $fdir, $fname, $def = null) {
		$module = _g ( 'module' )->flag ( $module );
		if (strlen ( $module ) < 1 || strlen ( $fname ) < 1) {
			return $def;
		}
		$dir = 'cache/' . $module;
		if (strlen ( $fdir ) >= 1) {
			$dir .= ('/' . $fdir);
		}
		return _g ( 'file' )->read ( $this->root . '/' . $dir, $fname, $def );
	}
	function write($module, $fdir, $fname, $content) {
		$module = _g ( 'module' )->flag ( $module );
		if (strlen ( $module ) < 1 || strlen ( $fname ) < 1) {
			return false;
		}
		$dir = 'cache/' . $module;
		if (strlen ( $fdir ) >= 1) {
			$dir .= ('/' . $fdir);
		}
		$dir = _g ( 'file' )->clean_dir ( $dir );
		if (_g ( 'file' )->create_dir ( $this->root, $dir ) !== true) {
			return false;
		}
		return _g ( 'file' )->write ( $this->root . '/' . $dir, $fname, $content );
	}
	function delete() {
	}
	function clear() {
	}
}
?>