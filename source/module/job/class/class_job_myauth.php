<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}
class class_job_myauth extends geshai_model {
	public $t_job_myauth = 'job_myauth';
	function __construct() {
		parent::__construct ();
	}
	function class_job_myauth() {
		$this->__construct ();
	}
	function find($k, $v = null) {
		$this->db->from ( $this->t_job_myauth );
		$this->db->where ( $k, $v );
		$this->db->select ();
		return $this->db->get_one ();
	}
	
	function count($k, $v = null) {
		$this->db->from ( $this->t_job_myauth );
		$this->db->where ( $k, $v );
		$c = $this->db->count ();
		$this->db->select ();
		
		$s = $this->db->is_success($c);
		return array($s, ($s ? $c : 0));
	}
	
	/* is */
	function is($jobid, $uid = null){
		if(!_g( 'validate' )->pnum( $jobid )){
			return false;
		}
		if(func_num_args() < 2){
			$uModel = _g('module')->trigger('user', 'model');
			if(!$uModel->is_suser()){
				return false;
			}
			if($uModel->suser('login_type') != 1){
				return false;
			}
			$uid = $uModel->suser('uid');
		}
		if(!_g( 'validate' )->pnum( $uid )){
			return false;
		}
		$where = array(
				'jobid' => $jobid,
				'uid' => $uid
		);
		return my_is_array( $this->find( $where ) );
	}
	
	/* update - value */
	function updateValue($where, $data){
		$this->db->from($this->t_job_myauth);
		$this->db->where($where);
		$this->db->set($data);
		$this->db->update();
		return $this->db->is_success();
	}
	
	function insertValue($data){
		$this->db->from($this->t_job_myauth);
		$this->db->set($data);
		$this->db->insert();
		return $this->db->is_success();
	}
}
?>