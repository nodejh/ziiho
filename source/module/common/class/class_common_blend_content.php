<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}
class class_common_blend_content extends class_model {
	public $table_common_blend_content = 'common_blend_content';
	
	/* 析构函数 */
	function __construct() {
		parent::__construct ();
	}
	function class_common_blend_content() {
		$this->__construct ();
	}
	
	/* 主题查询 */
	function blend_content_query($_key, $_val = NULL) {
		$this->db->from ( $this->table_common_blend_content );
		$this->db->where ( $_key, $_val );
		$result = $this->db->select ();
		if ($result == $this->db->cw) {
			return $result;
		}
		$result = $this->db->get_one ();
		return $result;
	}
	/* 添加 */
	function blend_content_add($_key, $_val = NULL) {
		$this->db->from ( $this->table_common_blend_content );
		$this->db->set ( $_key, $_val );
		$result = $this->db->insert ();
		return $result;
	}
	/* 删除 */
	function blend_content_del($_key, $_val = NULL) {
		$this->db->from ( $this->table_common_blend_content );
		$this->db->where ( $_key, $_val );
		$result = $this->db->delete ();
		return $result;
	}
}
?>