<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}
class class_user_avatar extends geshai_model {
	public $t_user_avatar = 'user_avatar';
	public $t_user_avatartmp = 'user_avatartmp';
	
	function __construct() {
		parent::__construct ();
	}
	function class_user_avatar() {
		$this->__construct ();
	}
	
	function find($k, $v = null) {
		$this->db->from ( $this->t_user_avatar );
		$this->db->where ( $k, $v );
		$this->db->select ();
		return $this->db->get_one ();
	}
	function insert($data){
		$this->db->from ( $this->t_user_avatar );
		$this->db->set ($data);
		$this->db->insert ();
		return $this->db->is_success();
	}
	function update($data, $k, $v = null){
		$this->db->from ( $this->t_user_avatar );
		$this->db->where ( $k, $v );
		$this->db->set ($data);
		$this->db->update ();
		return $this->db->is_success();
	}
	function delete($k, $v = null){
		$this->db->from ( $this->t_user_avatar );
		$this->db->where ( $k, $v );
		$this->db->delete ();
		return $this->db->is_success();
	}
	
	/* tmp */
	function tmpFind($k, $v = null) {
		$this->db->from ( $this->t_user_avatartmp );
		$this->db->where ( $k, $v );
		$this->db->select ();
		return $this->db->get_one ();
	}
	function tmpInsert($data){
		$this->db->from ( $this->t_user_avatartmp );
		$this->db->set ($data);
		$this->db->insert ();
		return $this->db->is_success();
	}
	function tmpUpdate($data, $k, $v = null){
		$this->db->from ( $this->t_user_avatartmp );
		$this->db->where ( $k, $v );
		$this->db->set ($data);
		$this->db->update ();
		return $this->db->is_success();
	}
	function tmpDelete($k, $v = null){
		$this->db->from ( $this->t_user_avatartmp );
		$this->db->where ( $k, $v );
		$this->db->delete ();
		return $this->db->is_success();
	}
	
	/* src */
	function src($v){
		$defs = array(
			'2' => 'gender_2.png',
			'1' => 'gender_1.png',
			'0' => 'gender_0.png'
		);
		$uid = my_array_value('uid', $v);
		$gender = my_array_value('gender', $v);
		$gender = (_g('validate')->num($gender) ? $gender : 0);
		$data = null;
		
		if(_g('validate')->pnum($uid)){
			$data = $this->find('uid', $uid);
		}
		if(!my_is_array($data)){
			$uri = (_g('template')->dir('user') . '/image/');
			return ($uri . $defs[$gender]);
		}else{
			return (sdir('uploadfile') . '/' . $data['src']);
		}
	} 
}
?>