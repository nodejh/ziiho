<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}
class class_common_template extends class_model {
	public $table_common_template = 'common_template';
	
	/* 析构函数 */
	function __construct() {
		parent::__construct ();
	}
	function class_common_template() {
		$this->__construct ();
	}
	
	/* 条件查询 */
	function template_query($_key = NULL, $_val = NULL) {
		$this->db->from ( $this->table_common_template );
		$this->db->where ( $_key, $_val );
		$result = $this->db->select ();
		if ($result == $this->db->cw) {
			return $result;
		}
		$result = $this->db->get_one ();
		return $result;
	}
	/* 列表 */
	function template_list($page_size = 20, $page_nums = 7, $page = 1) {
		$disabled = yesno_val ( 'normal' );
		$orderby = order_val ();
		$this->db->from ( $this->table_common_template );
		$this->db->where ( 'disabled', $disabled );
		/* 获取总数 */
		$total_num = $this->db->count_num ();
		/* 计算分页 */
		$pg = pagephow ( $total_num, $page_size, $page_nums, $page );
		$this->db->limit ( $pg ['first_count'], $pg ['page_size'] );
		$this->db->order_by ( 'listorder', $orderby );
		$result = $this->db->select ();
		if ($result == $this->db->cw) {
			return $result;
		}
		$result = $this->db->get_list ();
		return array (
				$pg,
				$result 
		);
	}
}
?>