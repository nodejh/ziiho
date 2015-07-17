<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}

loader ( 'class:class_common_credit', 'common', true );
class class_member_credit extends class_common_credit {
	public $table_member_credit = 'member_credit';
	public $creditCore = 'credit0';
	
	/* 析构函数 */
	function __construct() {
		parent::__construct ();
	}
	function class_member_credit() {
		$this->__construct ();
	}
	function member_credit_query($_key, $_val = NULL) {
		$this->db->from ( $this->table_member_credit );
		$this->db->where ( $_key, $_val );
		$result = $this->db->select ();
		if ($result == $this->db->cw) {
			return $result;
		}
		$result = $this->db->get_one ();
		return $result;
	}
	/* 添加 */
	function member_credit_add($_key, $_val = NULL) {
		$this->db->from ( $this->table_member_credit );
		$this->db->set ( $_key, $_val );
		$result = $this->db->insert ();
		return $result;
	}
	/* 更新 */
	function member_credit_update($data, $_key, $_val = NULL) {
		$this->db->from ( $this->table_member_credit );
		$this->db->where ( $_key, $_val );
		$this->db->set ( $data );
		$result = $this->db->update ();
		return $result;
	}
}
?>