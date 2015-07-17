<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}
class geshai_model extends geshai_base {
	function __construct() {
		parent::__construct ();
	}
	function geshai_model() {
		$this->__construct ();
	}
}
?>