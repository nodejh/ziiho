<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}
class class_article extends class_model {
	public $table_article = 'article';
	public $table_article_content = 'article_content';
	public $table_article_label = 'article_label';
	public $table_article_labelid = 'article_labelid';
	public $table_article_picture = 'article_picture';
	public $table_article_tag = 'article_tag';
	
	/* 析构函数 */
	function __construct() {
		parent::__construct ();
	}
	function class_article() {
		$this->__construct ();
	}
	
	/* 条件查询 */
	function article_query($_key, $_val = NULL) {
		$this->db->from ( $this->table_article );
		$this->db->where ( $_key, $_val );
		$result = $this->db->select ();
		if ($result == $this->db->cw) {
			return $result;
		}
		$result = $this->db->get_one ();
		return $result;
	}
	/* 内容查询 */
	function article_content_query($aid) {
		if (check_nums ( $aid ) < 1) {
			return $aid;
		}
		$this->db->from ( $this->table_article_content );
		$this->db->where ( 'aid', $aid );
		$reuslt = $this->db->select ();
		if ($reuslt == $this->db->cw) {
			return $reuslt;
		}
		$reuslt = $this->db->get_one ();
		return $reuslt;
	}
	/* 获取一条草稿 */
	function article_draft_query($uid) {
		$status = article_status ( 'draft' );
		$orderby = order_val ( 2 );
		$this->db->from ( $this->table_article );
		$this->db->where ( 'uid', $uid );
		$this->db->where ( 'status', $status );
		$this->db->order_by ( 'aid', $orderby );
		$result = $this->db->select ();
		if ($result == $this->db->cw) {
			return $result;
		}
		$result = $this->db->get_one ();
		return $result;
	}
	/* 更新点击率 */
	function article_view_count($aid, $views = 0) {
		if (array_key_val ( 'aid_views_add', $_SESSION ) == $aid) {
			return $views;
		}
		if (check_nums ( $aid ) < 1) {
			return $views;
		}
		if (check_num ( $views ) < 1) {
			return $views;
		}
		$v = ((( int ) $views) + 1);
		$this->db->from ( $this->table_article );
		$this->db->where ( 'aid', $aid );
		$this->db->set ( 'views', $v );
		$result = $this->db->update ();
		if ($result == $this->db->cw) {
			return $views;
		}
		$_SESSION ['aid_views_add'] = $aid;
		return $v;
	}
	/* 相关阅读 */
	function article_keywords_be($aid, $keywords, $limit = 5, $orderby = 'DESC') {
		if (check_nums ( $aid ) < 1) {
			return NULL;
		}
		if (check_is_array ( $keywords ) < 1) {
			return NULL;
		}
		$keywords = array_join_str ( '|', $keywords );
		$w_search = ('(.*' . $keywords . '.*)$');
		/* 匹配查询 */
		$this->db->from ( $this->table_article );
		$this->db->where_more ( 'aid', $aid, '!=' );
		$this->db->where_match ( 'title', $w_search );
		/* $this->db->distinct('aid'); */
		/*$this->db->group_by('aid');*/
		$count_num = $this->db->count_num ();
		$this->db->order_by ( 'aid', $orderby );
		$this->db->limit ( 0, $limit );
		$result = $this->db->select ();
		if ($result == $this->db->cw) {
			return NULL;
		}
		$result = $this->db->get_list ();
		
		$result = array (
				$count_num,
				$result 
		);
		return $result;
	}
}
?>