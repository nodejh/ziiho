<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}
class class_article_review extends class_model {
	public $table_article = 'article';
	public $table_article_review = 'article_review';
	
	/* 析构函数 */
	function __construct() {
		parent::__construct ();
	}
	function class_article_review() {
		$this->__construct ();
	}
	
	/* 条件查询 */
	function review_query($_key, $_val = NULL) {
		$this->db->from ( $this->table_article_review );
		$this->db->where ( $_key, $_val );
		$reuslt = $this->db->select ();
		if ($reuslt == $this->db->cw) {
			return $reuslt;
		}
		$reuslt = $this->db->get_one ();
		return $reuslt;
	}
	/* 评论统计 */
	function review_count($_key, $_val = NULL) {
		$status = article_review_status ( 'normal' );
		$this->db->from ( $this->table_article_review );
		$this->db->where ( $_key, $_val );
		$this->db->where ( 'sid', $sid );
		$this->db->where ( 'status', $status );
		$total_num = $this->db->count_num ();
		$this->db->clear_sql ();
		if ($total_num == $this->db->cw) {
			return $total_num;
		}
		return $total_num;
	}
	/* 列表 */
	function list_query($sid, $page_size = 20, $page_nums = 7, $page = 1, $orderby = 'DESC') {
		$this->db->from ( $this->table_article_review );
		$this->db->where ( 'sid', $sid );
		// $this->db->where('rids',0);
		$this->db->where ( 'status', 0 );
		/* 获取总数 */
		$total_num = $this->db->count_num ();
		/* 计算分页 */
		$pg = pagephow ( $total_num, $page_size, $page_nums, $page );
		$this->db->limit ( $pg ['first_count'], $pg ['page_size'] );
		$this->db->order_by ( 'rid', $orderby );
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
	/* 回复查询 */
	function reply_query($rid, $page_size = 100, $page_nums = 7, $page = 1, $orderby = 'ASC') {
		if (str_len ( $rid ) < 1) {
			return NULL;
		}
		$rid = explode_str ( $rid, ',' );
		
		$this->db->from ( $this->table_article_review );
		$this->db->where_in ( 'rid', $rid );
		$this->db->where ( 'status', 0 );
		/* 获取总数 */
		$total_num = $this->db->count_num ();
		/* 计算分页 */
		$pg = pagephow ( $total_num, $page_size, $page_nums, $page );
		$this->db->limit ( $pg ['first_count'], $pg ['page_size'] );
		$this->db->order_by ( 'rid', $orderby );
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