<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}
class geshai_base {
	public $db = null;
	public $_global = null;
	public $_loader = null;
	public $_time = 0;
	function __construct() {
		global $_G;
		$this->_global = &$_G;
		$this->_loader = &$_G ['loader'];
		$this->_time = &$_G ['cfg'] ['time'];
		
		$this->db_connect ();
	}
	function geshai_base() {
		$this->__construct ();
	}
	function db_connect() {
		if (! my_array_key_exist ( 'db', $this->_global )) {
			_g ( 'loader' )->lib ( 'mysql' );
			$this->_global ['db'] = _g ( 'loader' )->lib ( 'database', $this->_global ['dns'], true );
		}
		$this->db = &$this->_global ['db'];
	}
}
?>