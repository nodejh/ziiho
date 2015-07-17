<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}
class class_job_skill extends geshai_model {
	public $t_job_skill = 'job_skill';
	function __construct() {
		parent::__construct ();
	}
	function class_job_skill() {
		$this->__construct ();
	}
	function find($k, $v = null) {
		$this->db->from ( $this->t_job_skill );
		$this->db->where ( $k, $v );
		$this->db->select ();
		return $this->db->get_one ();
	}
	function finds($k, $v = null) {
		$this->db->from ( $this->t_job_skill );
		$this->db->where ( $k, $v );
		$this->db->order_by ( 'listorder' );
		$this->db->select ();
		return $this->db->get_list ();
	}
	
	function count($k, $v = null) {
		$this->db->from ( $this->t_job_skill );
		$this->db->where ( $k, $v );
		$this->db->order_by ( 'listorder' );
		$c = $this->db->count();
		$this->db->select ();
		return $c;
	}
	
	function writeSave($skillid, $data){
		$isUpdate = _g('validate')->pnum($skillid);
		
		if($isUpdate){
			$jobRs = $this->find('skillid', $skillid);
			if (! $this->db->is_success ()) {
				smsg ( lang ( '200013' ) );
				return null;
			}
			if(!my_is_array($jobRs)){
				smsg ( lang ( 'job:job>200000' ) );
				return null;
			}
		}
		
		$this->db->from($this->t_job_skill);
		if($isUpdate){
			$this->db->where('skillid', $skillid);
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
	function delete($skillid){
		$jobRs = $this->find('skillid', $skillid);
		if (! $this->db->is_success ()) {
			smsg ( lang ( '200013' ) );
			return null;
		}
		if(!my_is_array($jobRs)){
			smsg ( lang ( 'job:job>200000' ) );
			return null;
		}
		$this->db->from($this->t_job_skill);
		$this->db->where('skillid', $skillid);
		$this->db->delete();
		if (! $this->db->is_success ()) {
			smsg ( lang ( '200013' ) );
			return null;
		}
		smsg ( lang ( '100061' ), null, 1 );
	}
}
?>