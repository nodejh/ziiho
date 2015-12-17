<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}
class class_resume extends geshai_model {
	public $t_resume = 'resume';
	public $t_resume_profile = 'resume_profile';
	public $t_resume_relate = 'resume_relate';
	public $t_resume_educate = 'resume_educate';
	public $t_resume_language = 'resume_language';
	public $t_resume_projectexp = 'resume_projectexp';
	public $t_resume_train = 'resume_train';
	public $t_resume_wish = 'resume_wish';
	public $t_resume_workexp = 'resume_workexp';
	public $t_resume_attach = 'resume_attach';
	
	public $s_id = '_resumeid';
	
	function __construct() {
		parent::__construct ();
	}
	function class_resume() {
		$this->__construct ();
	}
	
	function find($table, $k, $v = null, $orderby = array()) {
		$this->db->from ( $table );
		$this->db->where ( $k, $v );
		if (my_is_array( $orderby )) {
			$this->db->order_by ($orderby[0], my_array_value(1, $orderby));
		}
		$this->db->select ();
		return $this->db->get_one ();
	}
	
	function finds($table, $k, $v = null, $orderby = array()) {
		$data = array(0, null);
		$this->db->from ( $table );
		$this->db->where ( $k, $v );
		$data[0] = $this->db->count ();
		$this->db->order_by ( 'ctime' );
		$this->db->limit ( 0, 10 );
		$this->db->select ();
		$data[1] = $this->db->get_list ();
		return $data;
	}
	
	function insert($table, $k, $v = null) {
		$this->db->from ( $table );
		$this->db->set ( $k, $v );
		$this->db->insert ();
		return $this->db->is_success ();
	}
	
	function update($table, $dk, $dv, $wk, $wv = null) {
		$this->db->from ( $table );
		$this->db->where ( $wk, $wv );
		$this->db->set ( $dk, $dv );
		$this->db->update ();
		return $this->db->is_success ();
	}
	
	function delete($table, $k, $v = null) {
		$this->db->from ( $table );
		$this->db->where ( $k, $v );
		$this->db->delete ();
		return $this->db->is_success ();
	}
	
	function rfind($k, $v = null) {
		$this->db->from ( $this->t_resume );
		$this->db->where ( $k, $v );
		$this->db->select ();
		return $this->db->get_one ();
	}
	
	function chkId() {
		return _g('session')->is_exist ( $this->s_id );
	}
	function delId() {
		_g('session')->delete ( $this->s_id );
	}
	function getId($v = null) {
		if (func_num_args() == 1) {
			my_session( $this->s_id, $v );
		}
		return my_session( $this->s_id );
	}
	function toData($d) {
		$d = (is_array( $d ) ? $d : array());
		
		if (my_is_array( $d )) {
			$d['syear'] = date('Y', $d['stime']);
			$d['smonth'] = date('m', $d['stime']);
				
			$d['eyear'] = null;
			$d['emonth'] = null;
			if ($d['etime'] != 0) {
				$d['eyear'] = date('Y', $d['etime']);
				$d['emonth'] = date('m', $d['etime']);
			}
		}
		
		return $d;
	}
}
?>