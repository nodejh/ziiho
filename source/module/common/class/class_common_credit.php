<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}
class class_common_credit extends class_model {
	public $table_common_credit_rule = 'common_credit_rule';
	public $table_common_credit_change = 'common_credit_change';
	
	/* 析构函数 */
	function __construct() {
		parent::__construct ();
	}
	function class_common_credit() {
		$this->__construct ();
	}
	
	/* ------------------积分兑换----------------- */
	function credit_change_query($_key, $_val = NULL) {
		$this->db->from ( $this->table_common_credit_change );
		$this->db->where ( $_key, $_val );
		$result = $this->db->select ();
		if ($result == $this->db->cw) {
			return $result;
		}
		$result = $this->db->get_one ();
		return $result;
	}
	/* ------------------积分规则----------------- */
	function credit_rule_query($_key, $_val = NULL) {
		$this->db->from ( $this->table_common_credit_rule );
		$this->db->where ( $_key, $_val );
		$result = $this->db->select ();
		if ($result == $this->db->cw) {
			return $result;
		}
		$result = $this->db->get_one ();
		return $result;
	}
}
?>