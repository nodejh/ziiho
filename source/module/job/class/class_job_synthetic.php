<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}
class class_job_synthetic extends geshai_model {
	public $t_job_synthetic = 'job_synthetic';
	function __construct() {
		parent::__construct ();
	}
	function class_job_synthetic() {
		$this->__construct ();
	}
	function find($k, $v = null) {
		$this->db->from ( $this->t_job_synthetic );
		$this->db->where ( $k, $v );
		$this->db->select ();
		return $this->db->get_one ();
	}
	function finds($k, $v = null) {
		$data = array(0, null);
		$this->db->from ( $this->t_job_synthetic );
		$this->db->where ( $k, $v );
		$data[0] = $this->db->count();
		$this->db->order_by( 'listorder' );
		$this->db->limit(0, 10);
		$this->db->select ();
		$data[1] = $this->db->get_list ();
		return $data;
	}
	
	function count($k, $v = null) {
		$this->db->from ( $this->t_job_synthetic );
		$this->db->where ( $k, $v );
		$c = $this->db->count ();
		$this->db->select ();
		return ($this->db->is_success($c) ? $c : 0);
	}
	
	function insert($k, $v = null){
		$this->db->from( $this->t_job_synthetic );
		$this->db->set( $k, $v );
		$this->db->insert ();
		return $this->db->is_success ();
	}
	
	function update($k, $v, $wk, $wv = null){
		$this->db->from ( $this->t_job_synthetic );
		$this->db->where ( $wk, $wv );
		$this->db->set ( $k, $v );
		$this->db->update ();
		return $this->db->is_success ();
	}
	
	function delete($k, $v = null){
		$this->db->from( $this->t_job_synthetic );
		$this->db->where( $k, $v );
		$this->db->delete ();
		return $this->db->is_success ();
	}
}
?>