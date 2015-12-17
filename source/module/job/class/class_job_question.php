<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}
class class_job_question extends geshai_model {
	public $t_job_question = 'job_question';
	function __construct() {
		parent::__construct ();
	}
	function class_job_question() {
		$this->__construct ();
	}
	function find($k, $v = null) {
		$this->db->from ( $this->t_job_question );
		$this->db->where ( $k, $v );
		$this->db->select ();
		return $this->db->get_one ();
	}
	function finds($k, $v = null) {
		$data = array(0, null);
		$this->db->from ( $this->t_job_question );
		$this->db->where ( $k, $v );
		$data[0] = _g('page')->c($this->db->count(), 15, 10, _get('page'));
		$this->db->order_by('listorder');
		$this->db->limit(0, 10);
		$this->db->select ();
		$data[1] = $this->db->get_list ();
		return $data;
	}
	
	function count($k, $v = null) {
		$this->db->from ( $this->t_job_question );
		$this->db->where ( $k, $v );
		$c = $this->db->count ();
		$this->db->select ();
		return ($this->db->is_success($c) ? $c : 0);
	}
	
	function moveResult($sortid, $questionid){
		$this->db->from ( $this->t_job_question );
		$this->db->where_regexp ( 'sortid', (',' . $sortid . ',') );
		$this->db->where ('questionid', $questionid, '!=');
		$this->db->order_by('listorder');
		$this->db->limit(0, 100);
		$this->db->select ();
		return $this->db->get_list ();
	}
	
	function relate($value, $id = null, $limit = 10){
		$this->db->from ( $this->t_job_question );
		$this->db->where_regexp ( 'sortid', (',' . $value . ',') );
		if(_g('validate')->pnum($id)){
			$this->db->where ('questionid', $id, '!=');
		}
		$this->db->order_by('listorder');
		$this->db->limit(0, $limit);
		$this->db->select ();
		return $this->db->get_list ();
	}
	
	/* update - value */
	function updateValue($where, $data){
		$this->db->from($this->t_job_question);
		$this->db->where($where);
		$this->db->set($data);
		$this->db->update();
		return $this->db->is_success();
	}
	
	function writeSave($data, $questionid){
		$isUpdate = _g('validate')->pnum($questionid);
		$qRs = null;
		if($isUpdate){
			$qRs = $this->find('questionid', $questionid);
			if (! $this->db->is_success ($qRs)) {
				smsg ( lang ( '200013' ) );
				return null;
			}
			if(!my_is_array($qRs)){
				smsg ( lang ( 'job:400000' ) );
				return null;
			}
		}
		
		$this->db->from($this->t_job_question);
		if($isUpdate){
			my_unset($data, 'ctime');
			$this->db->where('questionid', $questionid);
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
		return true;
	}
	function delete($questionid){
		$qRs = $this->find('questionid', $questionid);
		if (! $this->db->is_success ()) {
			smsg ( lang ( '200013' ) );
			return null;
		}
		if(!my_is_array($qRs)){
			smsg ( lang ( 'job:400000' ) );
			return null;
		}
		if(strlen($qRs['src']) >= 1){
			if(!_g('file')->delete(sdir(':uploadfile') . '/' . $qRs['src'])){
				smsg(lang('job:300003'));
				return null;
			}
		}
		
		$this->db->from($this->t_job_question);
		$this->db->where('questionid', $questionid);
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