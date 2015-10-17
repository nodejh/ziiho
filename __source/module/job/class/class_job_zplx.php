<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}
class class_job_zplx extends geshai_model {
	public $t_job_zplx = 'job_zplx';
	
	function __construct() {
		parent::__construct ();
	}
	function class_job_zplx() {
		$this->__construct ();
	}
	function find($k, $v = null) {
		$this->db->from ( $this->t_job_zplx );
		$this->db->where ( $k, $v );
		$this->db->select ();
		return $this->db->get_one ();
	}
	function findin($cuid, $ids) {
		$data = array();
		$this->db->from ( $this->t_job_zplx );
		$this->db->where ( 'cuid', $cuid );
		$this->db->where_in ( 'zplxid', $ids );
		$data[0] = $this->db->count();
		$this->db->limit(0, 20);
		$this->db->select ();
		$data[1] = $this->db->get_list ();
		return $data;
	}
	
	function insert($data){
		$this->db->from ( $this->t_job_zplx );
		$this->db->set ( $data );
		$this->db->insert();
		return $this->db->is_success();
	}
	
	function update($zplxid, $data){
		if(my_array_key_exist('ctime', $data)){
			unset($data['ctime']);
		}
		if(my_array_key_exist('cuid', $data)){
			unset($data['cuid']);
		}
		$this->db->from ( $this->t_job_zplx );
		$this->db->where ( 'zplxid', $zplxid );
		$this->db->set ( $data );
		$this->db->update();
		return $this->db->is_success();
	}
	
	function delete($zplxid){
		$this->db->from ( $this->t_job_zplx );
		$this->db->where ( 'zplxid', $zplxid );
		$this->db->delete();
		return $this->db->is_success();
	}
	function de($v){
		$data = array();
		if(preg_match_all("/\,(\d+)\,/", $v, $matchs)){
			$data = $matchs[1];
		}
		return $data;
	}
}
?>