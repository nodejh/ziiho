<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}
class class_job_examsubject_answer extends geshai_model {
	public $t_job_examsubject_record = 'job_examsubject_record';
	
	function __construct() {
		parent::__construct ();
	}
	function class_job_examsubject_answer() {
		$this->__construct ();
	}
	function find($k, $v = null) {
		$this->db->from ( $this->t_job_examsubject_record );
		$this->db->where ( $k, $v );
		$this->db->order_by('ctime', 'DESC');
		$this->db->select ();
		return $this->db->get_one ();
	}
	function finds($k, $v = null) {
		$data = array(0, null);
		$this->db->from ( $this->t_job_examsubject_record );
		$this->db->where ( $k, $v );
		$data[0] = $this->db->count();
		$this->db->order_by('ctime', 'DESC');
		$this->db->limit(0, 10);
		$this->db->select ();
		$data[1] = $this->db->get_list ();
		return $data;
	}
	
	function count($k, $v = null) {
		$this->db->from ( $this->t_job_examsubject_record );
		$this->db->where ( $k, $v );
		$c = $this->db->count ();
		$this->db->select ();
		
		$s = $this->db->is_success ( $c );
		return array( $s, ($s ? $c : 0) );
	}
	
	/* update - value */
	function updateValue($where, $data){
		$this->db->from ( $this->t_job_examsubject_record );
		$this->db->where ( $where );
		$this->db->set ( $data );
		$this->db->update ();
		return $this->db->is_success ();
	}
	
	function insertValue($data){
		$this->db->from ( $this->t_job_examsubject_record );
		$this->db->set ( $data );
		$this->db->insert ();
		return $this->db->is_success ();
	}
}
?>