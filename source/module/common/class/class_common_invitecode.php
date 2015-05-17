<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}
class class_common_invitecode extends class_model {
	public $table_common_invitecode = 'common_invitecode';
	
	/* 析构函数 */
	function __construct() {
		parent::__construct ();
	}
	function class_common_invitecode() {
		$this->__construct ();
	}
	
	/* 单个查询 */
	function invitecode_query($_key, $_val = NULL) {
		$this->db->from ( $this->table_common_invitecode );
		$this->db->where ( $_key, $_val );
		$result = $this->db->select ();
		if ($result == $this->db->cw) {
			return $result;
		}
		$result = $this->db->get_one ();
		return $result;
	}
	/* 更新 */
	function invitecode_update($data, $_key, $_val = NULL) {
		$this->db->from ( $this->table_common_invitecode );
		$this->db->where ( $_key, $_val );
		$this->db->set ( $data );
		$result = $this->db->update ();
		return $result;
	}
}
?>