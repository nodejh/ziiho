<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}
class class_job_examsubject_answer extends geshai_model {
	public $t_job_examsubject_answer = 'job_examsubject_answer';
	function __construct() {
		parent::__construct ();
	}
	function class_job_examsubject_answer() {
		$this->__construct ();
	}
	function find($k, $v = null) {
		$this->db->from ( $this->t_job_examsubject_answer );
		$this->db->where ( $k, $v );
		$this->db->order_by('ctime', 'DESC');
		$this->db->select ();
		return $this->db->get_one ();
	}
	function finds($k, $v = null) {
		$data = array(0, null);
		$this->db->from ( $this->t_job_examsubject_answer );
		$this->db->where ( $k, $v );
		$data[0] = $this->db->count();
		$this->db->order_by('ctime', 'DESC');
		$this->db->limit(0, 10);
		$this->db->select ();
		$data[1] = $this->db->get_list ();
		return $data;
	}
	
	function count($k, $v = null) {
		$this->db->from ( $this->t_job_examsubject_answer );
		$this->db->where ( $k, $v );
		$c = $this->db->count ();
		$this->db->select ();
		
		$s = $this->db->is_success($c);
		return array($s, ($s ? $c : 0));
	}
	
	/* update - value */
	function updateValue($where, $data){
		$this->db->from($this->t_job_examsubject_answer);
		$this->db->where($where);
		$this->db->set($data);
		$this->db->update();
		return $this->db->is_success();
	}
	
	function insertValue($data){
		$this->db->from($this->t_job_examsubject_answer);
		$this->db->set($data);
		$this->db->insert();
		return $this->db->is_success();
	}
	
	/* show my answer */
	function myAnswer($esid, $cuid, $jobid, $uid, $option, $model, $isStr = false){
		$where = array(
				'esid'=>$esid,
				'cuid'=>$cuid,
				'jobid'=>$jobid,
				'uid'=>$uid
		);
		$answerData = $this->find($where);
		if(my_is_array($answerData)){
			$answer = _g('value')->ra(str2array($answerData['esoptionid']));
			$option = _g('value')->ra(str2array($option));
			
			$value = array();
			$i = 0;
			foreach($option as $k=>$v){
				if(my_in_array($k, $answer)){
					$value[] = $model->qsOptionOrder($i);
				}
				$i++;
			}
		}
		
		return ($isStr != true ? $value : my_join(',', $value));
	}
}
?>