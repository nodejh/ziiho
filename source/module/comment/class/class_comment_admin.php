<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}

loader ( 'class:class_comment', 'comment', true );
class class_comment_admin extends class_comment {
	
	/* 析构函数 */
	function __construct() {
		parent::__construct ();
	}
	function class_comment_admin() {
		$this->__construct ();
	}
	
	/* 编辑 */
	function comment_edit($commentid, $content) {
		/* 回调参数 */
		$callbackUrl = msg_param ();
		$callFunc = msg_func ();
		$callFunc_b = msg_func ( 'callFunc_b' );
		
		/* commentid */
		if (check_nums ( $commentid ) < 1) {
			showmsg ( lang ( 'comment:commentid_fail' ), NULL, $callFunc );
		}
		/* 获取配置 */
		$baseSet = get_db_set ( array (
				'smodule' => 'comment',
				'stype' => comment_value_get ( 'set_field', 'set', 'field' ) 
		) );
		if ($baseSet == $this->db->cw) {
			showmsg ( lang ( 'global:dbexception' ), NULL, $callFunc );
		}
		if (check_is_array ( $baseSet ) < 1) {
			showmsg ( lang ( 'global:get_db_set_null' ), NULL, $callFunc );
		}
		$minlen = config_val ( 'content_minlen', $baseSet );
		$maxlen = config_val ( 'content_maxlen', $baseSet );
		/* 检查内容长度 */
		$contentStrLen = str_len ( str_stripslashes ( $content ) );
		if (check_is_len ( str_stripslashes ( $content ), $minlen, $maxlen ) < 1) {
			showmsg ( lang ( 'comment:content_len_info', array (
					$minlen,
					$maxlen 
			) ), NULL, $callFunc );
		}
		/* 评论是否存在 */
		$commentRs = $this->comment_query ( 'commentid', $commentid );
		if ($commentRs == $this->db->cw) {
			showmsg ( lang ( 'global:dbexception' ), NULL, $callFunc );
		}
		if (check_is_array ( $commentRs ) < 1) {
			showmsg ( lang ( 'comment:commentid_noexist' ), $callbackUrl, $callFunc );
		}
		/* 初始化参数 */
		$dataArr = array (
				'content' => html_special ( $content ) 
		);
		$result = $this->db->db_update ( $this->table_comment, $dataArr, 'commentid', $commentid );
		unset ( $dataArr );
		if ($result == $this->db->cw) {
			showmsg ( lang ( 'global:dbexception' ), NULL, $callFunc );
		}
		showmsg ( lang ( 'global:dbsuccess' ), $callbackUrl, $callFunc_b );
	}
	/* 状态 */
	function comment_status($commentid, $status) {
		/* 回调参数 */
		$callbackUrl = msg_param ();
		$callFunc = msg_func ();
		$callFunc_b = msg_func ( 'callFunc_b' );
		
		if (check_is_array ( $commentid ) < 1) {
			showmsg ( lang ( 'global:param_ids_null' ), NULL, $callFunc );
		}
		$status = comment_status ( $status );
		if (check_num ( $status ) < 1) {
			showmsg ( lang ( 'comment:status_fail' ), NULL, $callFunc );
		}
		for($i = 0; $i < array_number ( $commentid ); $i ++) {
			$commentid [$i] = trim_addslashes ( $commentid [$i] );
			if (check_nums ( $commentid [$i] ) < 1) {
				showmsg ( lang ( 'global:param_ids_fail' ), $callbackUrl, $callFunc_b );
			}
			$commentRs = $this->comment_query ( array (
					'commentid' => $commentid [$i] 
			) );
			if ($commentRs == $this->db->cw) {
				showmsg ( lang ( 'global:dbexceptions' ), $callbackUrl, $callFunc_b );
			}
			if (check_is_array ( $commentRs ) < 1) {
				continue;
			}
			$dataArr = array (
					'status' => $status 
			);
			$result = $this->db->db_update ( $this->table_comment, $dataArr, 'commentid', $commentid [$i] );
			unset ( $dataArr );
			if ($commentRs == $this->db->cw) {
				showmsg ( lang ( 'global:dbexceptions' ), $callbackUrl, $callFunc_b );
			}
		}
		showmsg ( lang ( 'global:dbsuccess' ), $callbackUrl, $callFunc_b );
	}
	/* 删除 */
	function comment_del($commentid) {
		/* 回调参数 */
		$callbackUrl = msg_param ();
		$callFunc = msg_func ();
		$callFunc_b = msg_func ( 'callFunc_b' );
		
		if (check_is_array ( $commentid ) < 1) {
			showmsg ( lang ( 'global:param_ids_null' ), NULL, $callFunc );
		}
		for($i = 0; $i < array_number ( $commentid ); $i ++) {
			$commentid [$i] = trim_addslashes ( $commentid [$i] );
			if (check_nums ( $commentid [$i] ) < 1) {
				showmsg ( lang ( 'global:param_ids_fail' ), $callbackUrl, $callFunc_b );
			}
			$commentRs = $this->comment_query ( array (
					'commentid' => $commentid [$i] 
			) );
			if ($commentRs == $this->db->cw) {
				showmsg ( lang ( 'global:dbexceptions' ), $callbackUrl, $callFunc_b );
			}
			if (check_is_array ( $commentRs ) < 1) {
				continue;
			}
			$result = $this->db->db_delete ( $this->table_comment, 'commentid', $commentid [$i] );
			if ($commentRs == $this->db->cw) {
				showmsg ( lang ( 'global:dbexceptions' ), $callbackUrl, $callFunc_b );
			}
		}
		showmsg ( lang ( 'global:dbsuccess' ), $callbackUrl, $callFunc_b );
	}
}
?>