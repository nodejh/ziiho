<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}
class class_common_invitecode extends geshai_model {
	public $t_common_invitecode = 'common_invitecode';
	
	function __construct() {
		parent::__construct ();
	}
	function class_common_invitecode() {
		$this->__construct ();
	}
	
	function find($k, $v = null) {
		$this->db->from ( $this->t_common_invitecode );
		$this->db->where ( $k, $v );
		$this->db->order_by ('ugid');
		$this->db->select ();
		return $this->db->get_one ();
	}
	function insert($data){
		$this->db->from ( $this->t_common_invitecode );
		$this->db->set ($data);
		$this->db->insert ();
		return $this->db->is_success();
	}
	function update($data, $k, $v = null){
		$this->db->from ( $this->t_common_invitecode );
		$this->db->where ( $k, $v );
		$this->db->set ($data);
		$this->db->update ();
		return $this->db->is_success();
	}
	function delete($k, $v = null){
		$this->db->from ( $this->t_common_invitecode );
		$this->db->where ( $k, $v );
		$this->db->delete ();
		return $this->db->is_success();
	}
}
?>