<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}
class class_article_label extends class_model {
	public $table_article_label = 'article_label';
	public $table_article_labelid = 'article_labelid';
	
	/* 析构函数 */
	function __construct() {
		parent::__construct ();
	}
	function class_article_label() {
		$this->__construct ();
	}
	
	/* 条件查询 */
	function label_query($_key, $_val = NULL) {
		$this->db->from ( $this->table_article_label );
		$this->db->where ( $_key, $_val );
		$result = $this->db->select ();
		if ($result == $this->db->cw) {
			return $result;
		}
		$result = $this->db->get_one ();
		return $result;
	}
	/* 条件查询选择的标签 */
	function labelid_query($_key, $_val = NULL) {
		$this->db->from ( $this->table_article_labelid );
		$this->db->where ( $_key, $_val );
		$result = $this->db->select ();
		if ($result == $this->db->cw) {
			return $result;
		}
		$result = $this->db->get_one ();
		return $result;
	}
	/* 列表 */
	function lists($page_size = 20, $page_nums = 7, $page = 1) {
		$orderby = order_val ();
		$this->db->from ( $this->table_article_label );
		/* 获取总数 */
		$total_num = $this->db->count_num ();
		/* 计算分页 */
		$pg = pagephow ( $total_num, $page_size, $page_nums, $page );
		$this->db->limit ( $pg ['first_count'], $pg ['page_size'] );
		$this->db->order_by ( 'labelid', $orderby );
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
	/* 所属文章的聚合标签 */
	function labelidlist($aid = NULL, $page_size = 20, $page_nums = 7, $page = 1) {
		if (check_nums ( $aid ) < 1) {
			return NULL;
		}
		$orderby = order_val ( 1 );
		$this->db->from ( $this->table_article_labelid );
		$this->db->where ( 'aid', $aid );
		/* 获取总数 */
		$total_num = $this->db->count_num ();
		/* 计算分页 */
		$pg = pagephow ( $total_num, $page_size, $page_nums, $page );
		$this->db->limit ( $pg ['first_count'], $pg ['page_size'] );
		$this->db->order_by ( 'labelid', $orderby );
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