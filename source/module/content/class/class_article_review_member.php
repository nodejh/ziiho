<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}
class class_article_review_member extends class_model {
	public $table_article = 'article';
	public $table_article_review = 'article_review';
	
	/* 析构函数 */
	function __construct() {
		parent::__construct ();
	}
	function class_article_review_member() {
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
	/* 查询主题 */
	function article_query($aid) {
		if (check_nums ( $aid ) < 1) {
			return $aid;
		}
		$status = article_status ( 'normal' );
		
		$this->db->from ( $this->table_article );
		$this->db->where ( 'aid', $aid );
		$this->db->where ( 'status', $status );
		$reuslt = $this->db->select ();
		if ($reuslt == $this->db->cw) {
			return $reuslt;
		}
		$reuslt = $this->db->get_one ();
		return $reuslt;
	}
	/* 评论保存 */
	function review_save($sid, $content) {
		sleep ( 1 );
		$uid = get_user ( 'uid' );
		if (check_nums ( $uid ) < 1) {
			domsg ( lang ( 'article_review:review_add_uid_no_access' ), NULL, 'article_review_save_msg' );
			return NULL;
		}
		if (check_nums ( $sid ) < 1) {
			domsg ( lang ( 'article_review:review_add_sid_fail' ), NULL, 'article_review_save_msg' );
			return NULL;
		}
		$content_len = str_len ( str_stripslashes ( $content ) );
		if ($content_len < 1) {
			domsg ( lang ( 'article_review:review_add_content_null' ), NULL, 'article_review_save_msg' );
			return NULL;
		}
		$minlen = 1;
		$maxlen = 100;
		if ($content_len < $minlen || $content_len > $maxlen) {
			$lang_str = replace_str ( lang ( 'article_review:review_add_content_len_fail' ), '{minlen}', $minlen );
			$lang_str = replace_str ( $lang_str, '{maxlen}', $maxlen );
			domsg ( $lang_str, NULL, 'article_review_save_msg' );
			return NULL;
		}
		/* 检查主题是否存在 */
		$article = $this->article_query ( $sid );
		if ($article == $this->db->cw) {
			domsg ( lang ( 'article_review:review_add_exception' ), NULL, 'article_review_save_msg' );
			return NULL;
		}
		if (check_is_array ( $article ) < 1) {
			domsg ( lang ( 'article_review:review_add_sid_no_exists' ), NULL, 'alertbg' );
			return NULL;
		}
		unset ( $article );
		/* 初始化数据 */
		$data_arr = array (
				'rids' => 0,
				'sid' => $sid,
				'uid' => $uid,
				'touid' => 0,
				'floorid' => 1,
				'content' => $content,
				'ip' => getip (),
				'ctime' => $this->sys_time,
				'status' => 0 
		);
		/* 评论 */
		$this->db->from ( $this->table_article_review );
		$this->db->set ( $data_arr );
		$result = $this->db->insert ();
		if ($result == $this->db->cw) {
			domsg ( lang ( 'article_review:review_add_exception' ), NULL, 'article_review_save_msg' );
			return NULL;
		}
		domsg ( lang ( 'article_review:review_add_success' ), modelurl ( 301 ), 'article_review_save_msg' );
		return NULL;
	}
	/* 回复保存 */
	function reply_save($rid, $content) {
		sleep ( 1 );
		$uid = get_user ( 'uid' );
		if (check_nums ( $uid ) < 1) {
			domsg ( lang ( 'article_review:reply_add_uid_no_access' ), NULL, 'article_reply_save_msg' );
			return NULL;
		}
		/* 检查回复id */
		if (check_nums ( $rid ) < 1) {
			domsg ( lang ( 'article_review:reply_add_rid_fail' ), NULL, 'article_reply_save_msg' );
			return NULL;
		}
		/* 检查回复内容 */
		$content_len = str_len ( str_stripslashes ( $content ) );
		if ($content_len < 1) {
			domsg ( lang ( 'article_review:reply_add_content_null' ), NULL, 'article_reply_save_msg' );
			return NULL;
		}
		$minlen = 1;
		$maxlen = 100;
		if ($content_len < $minlen || $content_len > $maxlen) {
			$lang_str = replace_str ( lang ( 'article_review:reply_add_content_len_fail' ), '{minlen}', $minlen );
			$lang_str = replace_str ( $lang_str, '{maxlen}', $maxlen );
			domsg ( $lang_str, NULL, 'article_reply_save_msg' );
			return NULL;
		}
		
		/* 查询回复id */
		$review = $this->review_query ( 'rid', $rid );
		if ($review == $this->db->cw) {
			domsg ( lang ( 'article_review:reply_add_exception' ), NULL, 'article_reply_save_msg' );
			return NULL;
		}
		if (check_is_array ( $review ) < 1) {
			domsg ( lang ( 'article_review:reply_add_rid_no_exists' ), NULL, 'article_reply_save_msg' );
			return NULL;
		}
		/* 会员所回复的该楼层 */
		$floorid = (( int ) $review ['floorid']) + 1;
		/* 初始化数据 */
		$floors = (str_len ( $review ['floors'] ) < 1) ? $review ['rid'] : ($review ['floors'] . ',' . $review ['rid']);
		$data_arr = array (
				'rids' => $rid,
				'sid' => $review ['sid'],
				'uid' => $uid,
				'touid' => $review ['uid'],
				'floorid' => $floorid,
				'floors' => $floors,
				'content' => $content,
				'ip' => getip (),
				'ctime' => $this->sys_time,
				'status' => 0 
		);
		/* 回复 */
		$this->db->from ( $this->table_article_review );
		$this->db->set ( $data_arr );
		unset ( $data_arr );
		$result = $this->db->insert ();
		if ($result == $this->db->cw) {
			domsg ( lang ( 'article_review:reply_add_exception' ), NULL, 'article_reply_save_msg' );
			return NULL;
		}
		domsg ( lang ( 'article_review:reply_add_success' ), modelurl ( 301 ), 'article_reply_save_msg' );
		return NULL;
	}
	/* 删除 */
	function review_delete($rid) {
		sleep ( 1 );
		$uid = get_user ( 'uid' );
		if (check_nums ( $uid ) < 1) {
			domsg ( lang ( 'article_review:review_del_uid_no_access' ), NULL, 'article_review_del_msg' );
			return NULL;
		}
		if (check_nums ( $rid ) < 1) {
			domsg ( lang ( 'article_review:review_del_rid_fail' ), NULL, 'article_review_del_msg' );
			return NULL;
		}
		$review = $this->review_query ( 'rid', $rid );
		if ($review == $this->db->cw) {
			domsg ( lang ( 'article_review:review_del_exception' ), NULL, 'article_review_del_msg' );
			return NULL;
		}
		if (check_is_array ( $review ) < 1) {
			domsg ( lang ( 'article_review:review_del_rid_no_exists' ), NULL, 'article_review_del_msg' );
			return NULL;
		}
		$this->db->from ( $this->table_article_review );
		$this->db->where ( 'rid', $rid );
		$result = $this->db->delete ();
		if ($result == $this->db->cw) {
			domsg ( lang ( 'article_review:review_del_exception' ), NULL, 'article_review_del_msg' );
			return NULL;
		}
		domsg ( lang ( 'article_review:review_del_success' ), NULL, 'article_review_del_msg', array (
				'msg_status' => 'success' 
		) );
		return NULL;
	}
}
?>