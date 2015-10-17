<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}
class class_job_examsubject extends geshai_model {
	public $t_job_examsubject = 'job_examsubject';
	function __construct() {
		parent::__construct ();
	}
	function class_job_examsubject() {
		$this->__construct ();
	}
	function find($k, $v = null) {
		$this->db->from ( $this->t_job_examsubject );
		$this->db->where ( $k, $v );
		$this->db->select ();
		return $this->db->get_one ();
	}
	function finds($k, $v = null) {
		$data = array(0, null);
		$this->db->from ( $this->t_job_examsubject );
		$this->db->where ( $k, $v );
		$data[0] = $this->db->count();
		$this->db->order_by('ctime', 'DESC');
		$this->db->limit(0, 10);
		$this->db->select ();
		$data[1] = $this->db->get_list ();
		return $data;
	}
	
	function count($k, $v = null) {
		$this->db->from ( $this->t_job_examsubject );
		$this->db->where ( $k, $v );
		$c = $this->db->count ();
		$this->db->select ();
		
		$s = $this->db->is_success($c);
		return array($s, ($s ? $c : 0));
	}
	
	/* update - value */
	function updateValue($where, $data){
		$this->db->from($this->t_job_examsubject);
		$this->db->where($where);
		$this->db->set($data);
		$this->db->update();
		return $this->db->is_success();
	}
	
	function writeSave($data, $esid){
		$isUpdate = _g('validate')->pnum($esid);
		$qRs = null;
		if($isUpdate){
			$qRs = $this->find('esid', $esid);
			if (! $this->db->is_success ($qRs)) {
				smsg ( lang ( '200013' ) );
				return null;
			}
			if(!my_is_array($qRs)){
				smsg ( lang ( 'job:600003' ) );
				return null;
			}
		}
		
		$this->db->from($this->t_job_examsubject);
		if($isUpdate){
			my_unset($data, 'ctime');
			$this->db->where('esid', $esid);
			$this->db->set($data);
			$this->db->update();
		}else{
			$this->db->set($data);
			$this->db->insert();
		}
		if (! $this->db->is_success ()) {
			smsg ( lang ( '200013' ) );
			return null;
		}
		smsg ( lang ( '100061' ), null, 1 );
	}
	function delete($esid){
		$qRs = $this->find('esid', $esid);
		if (! $this->db->is_success ()) {
			smsg ( lang ( '200013' ) );
			return null;
		}
		if(!my_is_array($qRs)){
			smsg ( lang ( 'job:400000' ) );
			return null;
		}
		
		$this->db->from($this->t_job_examsubject);
		$this->db->where('esid', $esid);
		$this->db->delete();
		if (! $this->db->is_success ()) {
			smsg ( lang ( '200013' ) );
			return null;
		}
		smsg ( lang ( '100061' ), null, 1 );
		return true;
	}
}
?>