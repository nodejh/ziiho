<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}
class class_comment extends class_model {
	public $table_comment = 'comment';
	
	/* 析构函数 */
	function __construct() {
		parent::__construct ();
	}
	function class_comment() {
		$this->__construct ();
	}
	
	/* 条件查询 */
	function comment_query($_key, $_val = NULL) {
		$this->db->from ( $this->table_comment );
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