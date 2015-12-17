<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}
class class_admin_lockscreen extends geshai_model {
	public $t_admin_lockscreen = 'admin_lockscreen';
	
	function __construct() {
		parent::__construct ();
	}
	function class_admin_lockscreen() {
		$this->__construct ();
	}
	
	function find($k, $v = null) {
		$this->db->from( $this->t_admin_lockscreen );
		$this->db->where( $k, $v );
		$this->db->select ();
		return $this->db->get_one ();
	}
	function insert($data) {
		$this->db->from( $this->t_admin_lockscreen );
		$this->db->set( $data );
		$this->db->insert ();
		return $this->db->is_success ();
	}
	function update($data, $k, $v = null) {
		$this->db->from( $this->t_admin_lockscreen );
		$this->db->where( $k, $v );
		$this->db->set( $data );
		$this->db->update ();
		return $this->db->is_success ();
	}
	function delete($k, $v = null) {
		$this->db->from( $this->t_admin_lockscreen );
		$this->db->where( $k, $v );
		$this->db->delete ();
		return $this->db->is_success ();
	}
	function is() {
		$status = true;
		$rs = $this->find ( 'uid', _g ( 'cp' )->admin->uid );
		if ($this->db->is_success ($rs)) {
			if (!my_is_array($rs)) {
				$status = false;
			}
		}
		return $status;
	}
}
?>