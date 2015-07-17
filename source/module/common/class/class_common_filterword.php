<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}
class class_common_filterword extends geshai_model {
	public $t_common_filterword = 'common_filterword';
	
	function __construct() {
		parent::__construct ();
	}
	function class_common_filterword() {
		$this->__construct ();
	}
	
	function find($k, $v = null) {
		$this->db->from ( $this->t_common_filterword );
		$this->db->where ( $k, $v );
		$this->db->order_by ('fwid');
		$this->db->select ();
		return $this->db->get_one ();
	}
	function insert($data){
		$this->db->from ( $this->t_common_filterword );
		$this->db->set ($data);
		$this->db->insert ();
		return $this->db->is_success();
	}
	function update($data, $k, $v = null){
		$this->db->from ( $this->t_common_filterword );
		$this->db->where ( $k, $v );
		$this->db->set ($data);
		$this->db->update ();
		return $this->db->is_success();
	}
	function delete($k, $v = null){
		$this->db->from ( $this->t_common_filterword );
		$this->db->where ( $k, $v );
		$this->db->delete ();
		return $this->db->is_success();
	}
}
?>