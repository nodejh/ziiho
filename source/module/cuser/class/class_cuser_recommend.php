<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}
class class_cuser_recommend extends geshai_model {
	public $t_cuser_recommend = 'cuser_recommend';
	
	function __construct() {
		parent::__construct ();
	}
	function class_cuser_recommend() {
		$this->__construct ();
	}
	
	function find($k, $v = null) {
		$this->db->from ( $this->t_cuser_recommend );
		$this->db->where ( $k, $v );
		$this->db->select ();
		return $this->db->get_one ();
	}
	function insert($data){
		$this->db->from ( $this->t_cuser_recommend );
		$this->db->set ($data);
		$this->db->insert ();
		return $this->db->is_success();
	}
	function update($data, $k, $v = null){
		$this->db->from ( $this->t_cuser_recommend );
		$this->db->where ( $k, $v );
		$this->db->set ($data);
		$this->db->update ();
		return $this->db->is_success();
	}
	function delete($k, $v = null){
		$this->db->from ( $this->t_cuser_recommend );
		$this->db->where ( $k, $v );
		$this->db->delete ();
		return $this->db->is_success();
	}
	
	function is($cuid){
		$result = $this->find('cuid', $cuid);
		$data = array(
				my_is_array($result),
				$result
		);
		return $data;
	}
}
?>