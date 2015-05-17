<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}
class class_article_get extends class_article {
	
	/* 析构函数 */
	function __construct() {
		parent::__construct ();
	}
	function class_article_get() {
		$this->__construct ();
	}
	
	/* 默认 */
	function _default_get() {
	}
	
	/* 聚合标签列表 */
	function labellists($data, $param) {
		/* 页码 */
		$page = de_page_param ( array_key_val ( 'page', $param ) );
		/* 聚合标签id */
		$labelid = array_key_val ( 'labelid', $data );
		/* 默认排序 */
		$orderby = 'id,' . order_val ( 2 );
		/* 排序 */
		$orderby = de_dborder ( array_key_val ( 'orderby', $param ), $orderby );
		/* 主题状态 */
		$status = article_status ( 'normal' );
		
		$al = $this->_loader->model ( 'class:class_article_label', 'article', false );
		$this->db->from ( $al->table_article_labelid );
		if (check_num ( $labelid ) == 1) {
			$this->db->where ( 'labelid', $labelid );
		}
		/* 获取总数 */
		$total_num = $this->db->count_num ();
		/* 计算分页 */
		$pg = pagephow ( $total_num, $param ['offset'], $param ['pagenum'], $page, $param ['start'] );
		$this->db->order_by ( $orderby );
		$this->db->limit ( $pg ['first_count'], $pg ['page_size'] );
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
	/* 获取聚合标签名 */
	function labelrs($data, $param) {
		$labelid = array_key_val ( 'labelid', $data );
		$result = NULL;
		if (check_num ( $labelid ) == 1) {
			$al = $this->_loader->model ( 'class:class_article_label', 'article', false );
			$result = $al->label_query ( 'labelid', $labelid );
		}
		return $result;
	}
}
?>