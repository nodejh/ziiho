<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}
class class_resume_model extends geshai_model {
	
	function __construct() {
		parent::__construct ();
	}
	function class_resume_model() {
		$this->__construct ();
	}
	
	function profile($uid, $k = null){
		$d = null;
		$this->db->from ('resume_profile');
		$this->db->where ( 'uid', $uid );
		$this->db->select ();
		if (!$this->db->is_success ()) {
			return $d;
		}
		$rs = $this->db->get_one ();
		if (my_is_array( $rs )) {
			if (func_num_args() < 2) {
				$d = $rs;
			} else {
				$d = my_array_value( $k, $rs );
			}
		}
		return $d;
	}
}
?>