<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}
class class_job_provide extends geshai_model {
	
	public $t_job_provide = 'job_provide';
	public $t_job_provide_item = 'job_provide_item';
	
	function __construct() {
		parent::__construct ();
	}
	function class_job_provide() {
		$this->__construct ();
	}
	
	function find($table, $k, $v = null) {
		$this->db->from ( $table );
		$this->db->where ( $k, $v );
		$this->db->order_by ( 'listorder' );
		$this->db->select ();
		return $this->db->get_one ();
	}
	
	function finds($table, $k, $v = null) {
		$d = array (0, null);
		$this->db->from ( $table );
		$this->db->where ( $k, $v );
		$d[0] = $this->db->count ();
		$this->db->order_by ( 'listorder' );
		$this->db->limit( 0, 20 );
		$this->db->select ();
		$d[1] = $this->db->get_list ();
		return $d;
	}
	
	function insert($table, $k, $v = null){
		$this->db->from ( $table );
		$this->db->set ( $k, $v );
		$this->db->insert ();
		return $this->db->is_success ();
	}
	
	function update($table, $k, $v, $wk = null, $wv = null){
		$this->db->from ( $table );
		$this->db->where ( $wk, $wv );
		$this->db->set ( $k, $v );
		$this->db->update ();
		return $this->db->is_success ();
	}
	
	function delete($table, $k, $v = null){
		$this->db->from ( $table );
		$this->db->where ( $k, $v );
		$this->db->delete ();
		return $this->db->is_success ();
	}
	
	function count($k, $v = null) {
		$this->db->from ( $this->t_job_provide_item );
		$this->db->where ( $k, $v );
		$c = $this->db->count ();
		$this->db->select ();
		return ($this->db->is_success($c) ? $c : 0);
	}
}
?>