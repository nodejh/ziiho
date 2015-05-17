<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}
class class_common_temp_attachment extends class_model {
	public $table_common_temp_attachment = 'common_temp_attachment';
	
	/* 析构函数 */
	function __construct() {
		parent::__construct ();
	}
	function class_common_temp_attachment() {
		$this->__construct ();
	}
	
	/* 查询 */
	function temp_attachment_query($_key, $_val = NULL, $islist = false) {
		$this->db->from ( $this->table_common_temp_attachment );
		$this->db->where ( $_key, $_val );
		$result = $this->db->select ();
		if ($result == $this->db->cw) {
			return $result;
		}
		if ($islist !== true) {
			$result = $this->db->get_one ();
		} else {
			$result = $this->db->get_list ();
		}
		return $result;
	}
	/* 查询图片数量 */
	function temp_attachment_count($_key, $_val = NULL) {
		$this->db->from ( $this->table_common_temp_attachment );
		$this->db->where ( $_key, $_val );
		$result = $this->db->count_num ();
		$this->db->clear_sql ();
		return $result;
	}
	/* 添加 */
	function temp_attachment_add($data, $isinsertid = false) {
		$result = $this->db->db_insert ( $this->table_common_temp_attachment, $data, $isinsertid );
		return $result;
	}
	/* 编辑 */
	function temp_attachment_edit($data, $_key, $_val = NULL) {
		$result = $this->db->db_update ( $this->table_common_temp_attachment, $data, $_key, $_val );
		return $result;
	}
	/* 删除 */
	function temp_attachment_del($_key, $_val = NULL) {
		$result = $this->db->db_delete ( $this->table_common_temp_attachment, $_key, $_val );
		return $result;
	}
}
?>