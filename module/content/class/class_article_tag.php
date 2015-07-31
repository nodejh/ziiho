<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}
class class_article_tag extends class_model {
	public $table_article_tagname = 'article_tagname';
	public $table_article_tag = 'article_tag';
	
	/* 析构函数 */
	function __construct() {
		parent::__construct ();
	}
	function class_article_tag() {
		$this->__construct ();
	}
	
	/* -----------------标签名------------------- */
	/*标签名条件查询*/
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
	/* 标签名列表 */
	function tagname_list($page_size = 20, $page_nums = 7, $page = 1, $orderby = 'ASC') {
		$disabled = yesno_val ( 'normal' );
		$this->db->from ( $this->table_article_tagname );
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
	/* -----------------关联标签------------------- */
	/*关联标签条件查询*/
	function tag_query($_key, $_val = NULL) {
		$this->db->from ( $this->table_article_tag );
		$this->db->where ( $_key, $_val );
		$result = $this->db->select ();
		if ($result == $this->db->cw) {
			return $result;
		}
		$result = $this->db->get_one ();
		return $result;
	}
	/* 关联标签列表 */
	function tag_list($_key, $_val = NULL) {
		$this->db->from ( $this->table_article_tag );
		$this->db->where ( $_key, $_val );
		$result = $this->db->select ();
		if ($result == $this->db->cw) {
			return $result;
		}
		$result = $this->db->get_list ();
		$arr = NULL;
		while ( $rs = $this->db->fetch_array ( $result ) ) {
			$arr [] = $rs ['tid'];
		}
		return $arr;
	}
}
?>