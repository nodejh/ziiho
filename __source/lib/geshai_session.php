<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}
class geshai_session {
	public $_dir = null;
	public $_sess_prefix = null;
	public $_flag_file = null;
	function __construct() {
	}
	function geshai_session() {
		$this->__construct ();
	}
	
	function init() {
		$this->_sess_prefix = _g ( 'cfg>session_prefix' );
		$this->_dir = sdir ( ':data' ) . '/session';
		$this->_flag_file = 'flag.txt';
		$this->set_path ();
	}
	
	function set_path() {
		if (is_dir ( $this->_dir )) {
			$s_lifetime = (24 * 60) * 60;
			ini_set ( 'session.save_path', $this->_dir );
			ini_set ( 'session.gc_maxlifetime', $s_lifetime );
			if (_g ( 'validate' )->haspost ( 'my_current_session_id' )) {
				$this->id ( _post ( 'my_current_session_id' ) );
			}
			$s_flagfile = $this->_dir . '/' . $this->_flag_file;
			$s_is_clear = true;
			if (is_file ( $s_flagfile )) {
				$s_flagfilemtime = _g ( 'cfg>time' ) - intval ( filemtime ( $s_flagfile ) );
				if ($s_flagfilemtime <= $s_lifetime) {
					$s_is_clear = false;
				}
			}
			if ($s_is_clear) {
				$s_files = glob ( $this->_dir . '/sess_*' );
				if (! empty ( $s_files )) {
					foreach ( $s_files as $f ) {
						clearstatcache ();
						$f_mtime = _g ( 'cfg>time' ) - intval ( filemtime ( $f ) );
						if ($f_mtime >= $s_lifetime) {
							unlink ( $f );
						}
					}
					_g ( 'file' )->write ( $this->_dir, $this->_flag_file, _g ( 'cfg>time' ) );
				}
				unset ( $s_files );
			}
			session_start ();
			$_s_time = md5 ( 'session_geshai_lifetime' );
			$this->value ( $_s_time, _g ( 'cfg>time' ) );
		}
	}
	
	function destroy() {
		$_SESSION = array ();
		if (isset ( $_COOKIE [session_name ()] )) {
			setcookie ( session_name (), null, _g ( 'cfg>time' ) - 42000, $this->_dir );
		}
		session_unset ();
		session_destroy ();
	}
	
	function name($v = null) {
		return ($this->_sess_prefix . $v);
	}
	
	function id($v = null) {
		if (! empty ( $v )) {
			session_id ( $v );
		} else {
			return session_id ();
		}
	}
	
	function value($k, $v = null) {
		$k = $this->name ( $k );
		
		$arglen = func_num_args ();
		if ($arglen == 1) {
			return my_array_value ( $k, $_SESSION );
		} else if ($arglen == 2) {
			$_SESSION [$k] = (is_array ( $v ) ? my_serialize ( $v ) : $v);
		}
	}
	
	function is_exist($k = null) {
		return my_array_key_exist ( $this->name ( $k ), $_SESSION );
	}
	
	function delete($k) {
		if ($this->is_exist ( $k )) {
			unset ( $_SESSION [$this->name ( $k )] );
		}
	}
}
?>