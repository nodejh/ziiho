<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}
class class_job_material_file extends geshai_model {
	public $t_job_material_file = 'job_material_file';
	
	function __construct() {
		parent::__construct ();
	}
	function class_job_material_file() {
		$this->__construct ();
	}
	function find($k, $v = null) {
		$this->db->from ( $this->t_job_material_file );
		$this->db->where ( $k, $v );
		$this->db->select ();
		return $this->db->get_one ();
	}
	
	function count($k, $v = null) {
		$this->db->from ( $this->t_job_material_file );
		$this->db->where ( $k, $v );
		$c = $this->db->count ();
		$this->db->select ();
		return ($this->db->is_success($c) ? $c : 0);
	}
	
	/* update - value */
	function updateValue($where, $data){
		$this->db->from( $this->t_job_material_file );
		$this->db->where($where);
		$this->db->set($data);
		$this->db->update();
		return $this->db->is_success();
	}
	
	function delete($jmfid){
		
	}
}
?>