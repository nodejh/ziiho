<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}
class geshai_common {
	function __construct() {
	}
	function geshai_common() {
		$this->__construct ();
	}
	function _enter($module) {
		global $_G;
		$f = _g ( 'module' )->inc ( $module, 'common' );
		if (is_file ( $f )) {
			include ($f);
		} else {
			prt ( lang ( '110002', $f ) );
		}
	}
	function _captcha() {
		_g ( 'loader' )->lib ( 'captcha', null, true )->create ();
	}
}
?>