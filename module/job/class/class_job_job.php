<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}
class class_job_job extends geshai_model {
	public $t_job_job = 'job_job';
	function __construct() {
		parent::__construct ();
	}
	function class_job_job() {
		$this->__construct ();
	}
	function find($k, $v = null) {
		$this->db->from ( $this->t_job_job );
		$this->db->where ( $k, $v );
		$this->db->select ();
		return $this->db->get_one ();
	}
	function finds($k, $v = null) {
		$data = array(0, null);
		$this->db->from ( $this->t_job_job );
		$this->db->where ( $k, $v );
		$data[0] = $this->db->count();
		$this->db->order_by('ctime', 'DESC');
		$this->db->limit(0, 10);
		$this->db->select ();
		$data[1] = $this->db->get_list ();
		return $data;
	}
	
	function count($k, $v = null) {
		$this->db->from ( $this->t_job_job );
		$this->db->where ( $k, $v );
		$c = $this->db->count ();
		$this->db->select ();
		return ($this->db->is_success($c) ? $c : 0);
	}
	function delete($jobid){
		$jobRs = $this->find('jobid', $jobid);
		if (! $this->db->is_success ()) {
			smsg ( lang ( '200013' ) );
			return null;
		}
		if(!my_is_array($jobRs)){
			smsg ( lang ( 'job:job>100000' ) );
			return null;
		}
		
		/* skill */
		$this->db->from('job_skill');
		$this->db->where('jobid', $jobid);
		$this->db->delete();
		if (! $this->db->is_success ()) {
			smsg ( lang ( '200013' ) );
			return null;
		}
		
		/* examsubject */
		$this->db->from('job_examsubject');
		$this->db->where('jobid', $jobid);
		$this->db->delete();
		if (! $this->db->is_success ()) {
			smsg ( lang ( '200013' ) );
			return null;
		}
		
		/* examsubject_answer */
		$this->db->from('job_examsubject_answer');
		$this->db->where('jobid', $jobid);
		$this->db->delete();
		if (! $this->db->is_success ()) {
			smsg ( lang ( '200013' ) );
			return null;
		}
		
		/* job */
		$this->db->from($this->t_job_job);
		$this->db->where('jobid', $jobid);
		$this->db->delete();
		if (! $this->db->is_success ()) {
			smsg ( lang ( '200013' ) );
			return null;
		}
		smsg ( lang ( '100061' ), null, 1 );
	}
}
?>