<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}
class class_job_examsubject_auth extends geshai_model {
	public $t_job_examsubject_auth = 'job_examsubject_auth';
	function __construct() {
		parent::__construct ();
	}
	function class_job_examsubject_auth() {
		$this->__construct ();
	}
	function find($k, $v = null) {
		$this->db->from ( $this->t_job_examsubject_auth );
		$this->db->where ( $k, $v );
		$this->db->select ();
		return $this->db->get_one ();
	}
	
	function count($k, $v = null) {
		$this->db->from ( $this->t_job_examsubject_auth );
		$this->db->where ( $k, $v );
		$c = $this->db->count ();
		$this->db->select ();
		
		$s = $this->db->is_success($c);
		return array($s, ($s ? $c : 0));
	}
	
	/* update - value */
	function updateValue($where, $data){
		$this->db->from($this->t_job_examsubject_auth);
		$this->db->where($where);
		$this->db->set($data);
		$this->db->update();
		return $this->db->is_success();
	}
	
	function insertValue($data){
		$this->db->from($this->t_job_examsubject_auth);
		$this->db->set($data);
		$this->db->insert();
		return $this->db->is_success();
	}
}
?>