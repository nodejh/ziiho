<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}
class class_common_exhibit extends geshai_model {
	public $t_common_exhibit = 'common_exhibit';
	public $t_common_exhibitg = 'common_exhibitg';
	
	function __construct() {
		parent::__construct ();
	}
	function class_common_exhibit() {
		$this->__construct ();
	}
	
	function find($k, $v = null) {
		$this->db->from ( $this->t_common_exhibit );
		$this->db->where ( $k, $v );
		$this->db->order_by ('listorder');
		$this->db->select ();
		return $this->db->get_one ();
	}
	function insert($data){
		$this->db->from ( $this->t_common_exhibit );
		$this->db->set ($data);
		$this->db->insert ();
		if(!$this->db->is_success()){
			return false;
		}
		$this->db->insert_id();
	}
	function update($data, $k, $v = null){
		$this->db->from ( $this->t_common_exhibit );
		$this->db->where ( $k, $v );
		$this->db->set ($data);
		$this->db->update ();
		return $this->db->is_success();
	}
	function delete($k, $v = null){
		$this->db->from ( $this->t_common_exhibit );
		$this->db->where ( $k, $v );
		$this->db->delete ();
		return $this->db->is_success();
	}
	
	/* -------- */
	function gFind($k, $v = null) {
		$this->db->from ( $this->t_common_exhibitg );
		$this->db->where ( $k, $v );
		$this->db->order_by ('listorder');
		$this->db->select ();
		return $this->db->get_one ();
	}
	function gInsert($data){
		$this->db->from ( $this->t_common_exhibitg );
		$this->db->set ($data);
		$this->db->insert ();
		return $this->db->is_success();
	}
	function gUpdate($data, $k, $v = null){
		$this->db->from ( $this->t_common_exhibitg );
		$this->db->where ( $k, $v );
		$this->db->set ($data);
		$this->db->update ();
		return $this->db->is_success();
	}
	function gDelete($k, $v = null){
		$this->db->from ( $this->t_common_exhibitg );
		$this->db->where ( $k, $v );
		$this->db->delete ();
		return $this->db->is_success();
	}
	function gGet() {
		$this->db->from ( $this->t_common_exhibitg );
		$this->db->where ( $k, $v );
		$this->db->order_by ('listorder');
		$this->db->select ();
		return $this->db->get_list ();
	}
}
?>