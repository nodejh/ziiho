<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}
class class_article_review_admin extends class_article_review {
	
	/* 析构函数 */
	function __construct() {
		parent::__construct ();
	}
	function class_article_review_admin() {
		$this->__construct ();
	}
	
	/* 状态编辑 */
	function review_status($rid, $status) {
		/* 回调参数 */
		$msg_call_url = msg_param ();
		$msg_call = msg_func ();
		$msg_call_b = msg_func ( 'msg_call_b' );
		$msg_call_param = msg_callback_param ();
		
		if (check_is_array ( $rid ) < 1) {
			domsg ( lang ( 'admin:param_id_null' ), NULL, $msg_call );
			return NULL;
		}
		/* 检查状态参数 */
		if (check_en ( $status ) < 1) {
			domsg ( lang ( 'admin:review_status_fail' ), NULL, $msg_call );
			return NULL;
		}
		$status = article_review_status ( $status );
		if (check_num ( $status ) < 1) {
			domsg ( lang ( 'admin:review_status_fail' ), NULL, $msg_call );
			return NULL;
		}
		foreach ( $rid as $v ) {
			if (check_nums ( $v ) < 1) {
				domsg ( lang ( 'admin:param_ids_fail' ), $msg_call_url, $msg_call_b );
				return NULL;
			}
			$review = $this->review_query ( 'rid', $v );
			if ($review == $this->db->cw) {
				domsg ( lang ( 'admin:dbexceptions' ), $msg_call_url, $msg_call_b );
				return NULL;
			}
			if (check_is_array ( $review ) < 1) {
				continue;
			}
			$result = $this->db->db_update ( $this->table_article_review, array (
					'status' => $status 
			), 'rid', $v );
			if ($result == $this->db->cw) {
				domsg ( lang ( 'admin:dbexceptions' ), $msg_call_url, $msg_call_b );
				return NULL;
			}
		}
		domsg ( lang ( 'admin:dbsuccess' ), $msg_call_url, $msg_call_b );
		return NULL;
	}
	/* 评论编辑 */
	function review_edit($rid, $content) {
		/* 回调参数 */
		$msg_call_url = msg_param ();
		$msg_call = msg_func ();
		$msg_call_b = msg_func ( 'msg_call_b' );
		$msg_call_param = msg_callback_param ();
		
		if (check_nums ( $rid ) < 1) {
			domsg ( lang ( 'admin:param_id_fail' ), NULL, $msg_call );
			return NULL;
		}
		if (str_len ( $content ) < 1) {
			domsg ( lang ( 'admin:review_content_fail' ), NULL, $msg_call );
			return NULL;
		}
		
		/* 检查是否存在 */
		$review = $this->review_query ( 'rid', $rid );
		if ($review == $this->db->cw) {
			domsg ( lang ( 'admin:dbexception' ), NULL, $msg_call );
			return NULL;
		}
		if (check_is_array ( $review ) < 1) {
			domsg ( lang ( 'admin:review_noexist' ), $msg_call_url, $msg_call_b );
			return NULL;
		}
		unset ( $review );
		
		/* 编辑操作 */
		$this->db->from ( $this->table_article_review );
		$this->db->where ( 'rid', $rid );
		$this->db->set ( 'content', $content );
		$result = $this->db->update ();
		if ($result == $this->db->cw) {
			domsg ( lang ( 'admin:dbexception' ), NULL, $msg_call );
			return NULL;
		}
		domsg ( lang ( 'admin:dbsuccess' ), $msg_call_url, $msg_call_b );
		return NULL;
	}
	/* 删除 */
	function review_delete($rid) {
		/* 回调参数 */
		$msg_call_url = msg_param ();
		$msg_call = msg_func ();
		$msg_call_b = msg_func ( 'msg_call_b' );
		$msg_call_param = msg_callback_param ();
		
		if (check_is_array ( $rid ) < 1) {
			domsg ( lang ( 'admin:param_id_null' ), NULL, $msg_call );
			return NULL;
		}
		foreach ( $rid as $v ) {
			if (check_nums ( $v ) < 1) {
				domsg ( lang ( 'admin:param_id_fail' ), $msg_call_url, $msg_call_b );
				return NULL;
			}
			$review = $this->review_query ( 'rid', $v );
			if ($review == $this->db->cw) {
				domsg ( lang ( 'admin:dbexceptions' ), $msg_call_url, $msg_call_b );
				return NULL;
			}
			if (check_is_array ( $review ) < 1) {
				continue;
			}
			$this->db->from ( $this->table_article_review );
			$this->db->where ( 'rid', $v );
			$result = $this->db->delete ();
			if ($result == $this->db->cw) {
				domsg ( lang ( 'admin:dbexceptions' ), $msg_call_url, $msg_call_b );
				return NULL;
			}
		}
		domsg ( lang ( 'admin:dbsuccess' ), $msg_call_url, $msg_call_b );
		return NULL;
	}
}
?>