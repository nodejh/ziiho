<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}
class class_article_urlstatic_admin extends class_model {
	public $table_article_tagname = 'article_tagname';
	public $table_article_tag = 'article_tag';
	
	/* 析构函数 */
	function __construct() {
		parent::__construct ();
	}
	function class_article_urlstatic_admin() {
		$this->__construct ();
	}
	
	/* 条件查询 */
	function tagname_query($_key, $_val = NULL) {
		$this->db->from ( $this->table_article_tagname );
		$this->db->where ( $_key, $_val );
		$result = $this->db->select ();
		if ($result == $this->db->cw) {
			return $result;
		}
		$result = $this->db->get_one ();
		return $result;
	}
	/* 列表 */
	function tagname_list($page_size = 20, $page_nums = 7, $page = 1, $orderby = 'ASC') {
		$this->db->from ( $this->table_article_tagname );
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