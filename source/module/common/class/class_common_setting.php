<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}
class class_common_setting extends geshai_model {
	public $t_common_setting = 'common_setting';
	
	function __construct() {
		parent::__construct ();
	}
	function class_common_setting() {
		$this->__construct ();
	}
	
	function find($k = null, $v = null) {
		$this->db->from ( $this->t_common_setting );
		$this->db->where ( $k, $v );
		$this->db->select ();
		return $this->db->get_one();
	}
	
	function finds($k = null, $v = null) {
		$this->db->from ( $this->t_common_setting );
		$this->db->where ( $k, $v );
		$this->db->select ();
		if(!$this->db->is_success()){
			return array();
		}
		$result = $this->db->get_list ();
		$arr = array();
		while ( $rs = $this->db->fetch_array ( $result ) ) {
			$arr[$rs['skey']] = $rs ['sval'];
		}
		return $arr;
	}
	
	function save($datas) {
		if (!my_is_array( $datas ) ) {
			return false;
		}
		foreach ( $datas as $v ) {
			/* is exist */
			$sRs = $this->find(array('module'=> $v[0], 'stype'=> $v[1], 'skey'=> $v[2]));
			if(!$this->db->is_success($sRs)){
				return false;
			}
			/* data */
			$arr = array (
					'module' => $v [0],
					'stype' => $v [1],
					'skey' => $v [2],
					'sval' => $v [3] 
			);
			$this->db->from ( $this->t_common_setting );
			if (my_is_array ( $sRs ) ) {
				$this->db->where ( 'settingid', $sRs ['settingid'] );
				$this->db->set ( $arr );
				$this->db->update ();
			} else {
				$this->db->set ( $arr );
				$this->db->insert ();
			}
			if(!$this->db->is_success($sRs)){
				return false;
			}
		}
		return true;
	}
}
?>