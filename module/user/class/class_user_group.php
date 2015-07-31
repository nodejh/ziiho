<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}
class class_user_group extends geshai_model {
	public $t_user_group = 'user_group';
	
	function __construct() {
		parent::__construct ();
	}
	function class_user_group() {
		$this->__construct ();
	}
	
	function find($k, $v = null) {
		$this->db->from ( $this->t_user_group );
		$this->db->where ( $k, $v );
		$this->db->order_by ('ugid');
		$this->db->select ();
		return $this->db->get_one ();
	}
	function insert($data){
		$this->db->from ( $this->t_user_group );
		$this->db->set ($data);
		$this->db->insert ();
		return $this->db->is_success();
	}
	function update($data, $k, $v = null){
		$this->db->from ( $this->t_user_group );
		$this->db->where ( $k, $v );
		$this->db->set ($data);
		$this->db->update ();
		return $this->db->is_success();
	}
	function delete($k, $v = null){
		$this->db->from ( $this->t_user_group );
		$this->db->where ( $k, $v );
		$this->db->delete ();
		return $this->db->is_success();
	}
	
	function getList($ugtype){
		$this->db->from ( $this->t_user_group );
		$this->db->where ( 'ugtype', $ugtype );
		$this->db->order_by ('ugid');
		$this->db->select ();
		return $this->db->get_list ();
	}
}
?>