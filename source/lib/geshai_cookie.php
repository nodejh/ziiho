<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}
class geshai_cookie {
	public $_cookie_prefix = null;
	public $_expire = null;
	function __construct() {
	}
	function geshai_cookie() {
		$this->__construct ();
	}
	function init() {
		$this->_sess_prefix = _g ( 'cfg>cookie_prefix' );
	}
	function name($v = null) {
		return ($this->_cookie_prefix . $v);
	}
	function expire($n = null, $op = true) {
		if ($op === true) {
			$this->_expire = intval ( _g ( 'cfg>time' ) ) + intval ( $n );
		} else {
			$this->_expire = intval ( _g ( 'cfg>time' ) ) - intval ( $n );
		}
	}
	function value($k = null, $v = null, $expire = null) {
		$k = $this->name ( $k );
		
		$data = null;
		switch (func_num_args ()) {
			case 1 :
				$data = my_array_value ( $k, $_COOKIE );
				break;
			case 2 :
				$this->expire ( 86400 * 365 );
				setcookie ( $k, $v, $this->_expire );
				break;
			case 3 :
				$this->expire ( $expire );
				setcookie ( $k, $v, $this->_expire );
				break;
		}
		return $data;
	}
	function delete($k = null, $expire = null) {
		$k = $this->name ( $k );
		switch (func_num_args ()) {
			case 1 :
				$this->expire ( 86400 * 365 );
				setcookie ( $k, null, $this->_expire );
				break;
			case 2 :
				$this->expire ( $expire, false );
				setcookie ( $k, null, $this->_expire );
				break;
		}
	}
}
?>