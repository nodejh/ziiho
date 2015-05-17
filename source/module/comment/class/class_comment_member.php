<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}

loader ( 'class:class_comment', 'comment', true );
class class_comment_member extends class_comment {
	
	/* 析构函数 */
	function __construct() {
		parent::__construct ();
	}
	function class_comment_member() {
		$this->__construct ();
	}
	
	/* 添加 */
	function comment_add($smodule, $idtype, $sid, $commentid, $content, $touid) {
		/* 回调参数 */
		$callFunc = msg_func ();
		$callFunc_b = msg_func ( 'callFunc_b' );
		
		/* 评论模块 */
		$currModule = _M ();
		/* uid */
		$uid = get_user ( 'uid' );
		/* 默认楼层 */
		$floorid = 1;
		/* 楼层内容 */
		$floors = NULL;
		/* 获取配置 */
		$baseSet = get_db_set ( array (
				'smodule' => $currModule,
				'stype' => comment_value_get ( 'set_field', 'set', 'field' ) 
		) );
		if ($baseSet == $this->db->cw) {
			showmsg ( lang ( 'global:dbexception' ), NULL, $callFunc );
		}
		if (check_is_array ( $baseSet ) < 1) {
			showmsg ( lang ( 'global:get_db_set_null' ), NULL, $callFunc );
		}
		/* 评论功能是否关闭 */
		$fnallow = config_val ( 'fn_allow', $baseSet );
		if (yesno_val ( $fnallow, 'field' ) != yesno_val ( 'normal', 'field' )) {
			showmsg ( lang ( 'comment:fn_closed' ), NULL, $callFunc );
		}
		$statusField = config_val ( 'status', $baseSet );
		$status = comment_status ( $statusField );
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
		/* commentid */
		if (check_num ( $commentid ) < 1) {
			showmsg ( lang ( 'comment:commentid_fail' ), NULL, $callFunc );
		}
		/* idtype */
		if (check_en_ep ( $idtype, 1, 50 ) < 1) {
			showmsg ( lang ( 'comment:idtype_fail' ), NULL, $callFunc );
		}
		/* 回复uid */
		if (check_num ( $touid ) < 1) {
			showmsg ( lang ( 'comment:touid_fail' ), NULL, $callFunc );
		}
		/* 如果为回复,则检查评论是否存在 */
		if (check_nums ( $commentid ) == 1) {
			$commentRs = $this->comment_query ( array (
					'commentid' => $commentid,
					'status' => comment_status ( 'normal' ) 
			) );
			if ($commentRs == $this->db->cw) {
				showmsg ( lang ( 'global:dbexception' ), NULL, $callFunc );
			}
			if (check_is_array ( $commentRs ) < 1) {
				showmsg ( lang ( 'comment:commentid_noexist' ), NULL, $callFunc );
			}
			/* 楼层编号 */
			$floorid = op2num ( $commentRs ['floorid'], 1 );
			/* 楼层内容 */
			if (empty ( $commentRs ['floors'] )) {
				$floors = $commentRs ['commentid'];
			} else {
				$floors = $commentRs ['floors'] . ',' . $commentRs ['commentid'];
			}
		}
		/* 主题是否存在 */
		$SubCheckFunc = 'inc_' . $smodule . '_check_for_comment';
		$SubCheckFuncFile = ($this->_global ['app'] ['path_source']) . ('module/' . $smodule . '/inc/' . $SubCheckFunc) . ($this->_global ['app'] ['ext_php']);
		if (check_is_file ( $SubCheckFuncFile ) < 1) {
			showmsg ( lang ( 'comment:sid_check_noexist' ), NULL, $callFunc );
		} else {
			include $SubCheckFuncFile;
		}
		if (check_is_fun ( $SubCheckFunc ) < 1) {
			showmsg ( lang ( 'comment:sid_check_noexist' ), NULL, $callFunc );
		}
		$SubRs = $SubCheckFunc ( $sid );
		if ($SubRs == $this->db->cw) {
			showmsg ( lang ( 'global:dbexception' ), NULL, $callFunc );
		}
		if (check_is_array ( $SubRs ) < 1) {
			showmsg ( lang ( 'comment:sid_noexist' ), NULL, $callFunc );
		}
		/* 初始化参数 */
		$dataArr = array (
				'commentids' => $commentid,
				'module' => $smodule,
				'idtype' => $idtype,
				'sid' => $sid,
				'uid' => $uid,
				'content' => html_special ( $content ),
				'ip' => getip (),
				'ctime' => $this->sys_time,
				'touid' => $touid,
				'floorid' => $floorid,
				'floors' => $floors,
				'status' => $status 
		);
		$result = $this->db->db_insert ( $this->table_comment, $dataArr );
		unset ( $dataArr );
		if ($result == $this->db->cw) {
			showmsg ( lang ( 'global:dbexception' ), NULL, $callFunc );
		}
		showmsg ( lang ( 'global:dbsuccess' ), NULL, $callFunc_b );
	}
	/* 删除 */
	function comment_del($commentid) {
		/* 回调参数 */
		$callFunc = msg_func ();
		$callFunc_b = msg_func ( 'callFunc_b' );
		
		$uid = get_user ( 'uid' );
		
		if (check_nums ( $commentid ) < 1) {
			showmsg ( lang ( 'comment:commentid_fail' ), NULL, $callFunc );
		}
		$commentRs = $this->comment_query ( array (
				'commentid' => $commentid,
				'uid' => $uid 
		) );
		if ($commentRs == $this->db->cw) {
			showmsg ( lang ( 'global:dbexception' ), NULL, $callFunc );
		}
		if (check_is_array ( $commentRs ) < 1) {
			showmsg ( lang ( 'comment:commentid_noexist' ), NULL, $callFunc );
		}
		$result = $this->db->db_delete ( $this->table_comment, 'commentid', $commentid );
		if ($commentRs == $this->db->cw) {
			showmsg ( lang ( 'global:dbexception' ), NULL, $callFunc );
		}
		showmsg ( lang ( 'global:dbsuccess' ), NULL, $callFunc_b );
	}
}
?>