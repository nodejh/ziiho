<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}

loader ( 'class:class_article_label', 'article', true );
class class_article_label_admin extends class_article_label {
	
	/* 析构函数 */
	function __construct() {
		parent::__construct ();
	}
	function class_article_label_admin() {
		$this->__construct ();
	}
	
	/* 添加 */
	function baseadd($title) {
		/* 回调参数 */
		$callbackUrl = msg_param ();
		$callFunc = msg_func ();
		$callFunc_b = msg_func ( 'callFunc_b' );
		
		if (str_len ( $title ) < 1) {
			showmsg ( lang ( 'article:label_title_null' ), NULL, $callFunc );
		}
		$dataArr = array (
				'title' => $title,
				'ctime' => $this->sys_time 
		);
		$result = $this->db->db_insert ( $this->table_article_label, $dataArr );
		unset ( $dataArr );
		if ($result == $this->db->cw) {
			showmsg ( lang ( 'global:dbexception' ), NULL, $callFunc );
		}
		showmsg ( lang ( 'global:dbsuccess' ), $callbackUrl, $callFunc_b );
	}
	/* 编辑 */
	function baseedit($labelid, $title) {
		/* 回调参数 */
		$callbackUrl = msg_param ();
		$callFunc = msg_func ();
		$callFunc_b = msg_func ( 'callFunc_b' );
		
		if (check_is_array ( $labelid ) < 1) {
			showmsg ( lang ( 'global:param_ids_null' ), NULL, $callFunc );
		}
		for($i = 0; $i < array_number ( $labelid ); $i ++) {
			$labelid [$i] = trim_addslashes ( $labelid [$i] );
			$title [$i] = trim_addslashes ( $title [$i] );
			if (check_nums ( $labelid [$i] ) < 1) {
				showmsg ( lang ( 'global:param_ids_fail' ), $callbackUrl, $callFunc_b );
			}
			/* 是否存在 */
			$qrs = $this->label_query ( 'labelid', $labelid [$i] );
			if ($qrs == $this->db->cw) {
				showmsg ( lang ( 'global:dbexceptions' ), $callbackUrl, $callFunc_b );
			}
			if (check_is_array ( $qrs ) < 1) {
				continue;
			}
			if (str_len ( $title [$i] ) < 1) {
				$title [$i] = $qrs ['title'];
			}
			/* 编辑 */
			$dataArr = array (
					'title' => $title [$i] 
			);
			$result = $this->db->db_update ( $this->table_article_label, $dataArr, 'labelid', $labelid [$i] );
			unset ( $dataArr );
			if ($result == $this->db->cw) {
				showmsg ( lang ( 'global:dbexceptions' ), $callbackUrl, $callFunc_b );
			}
		}
		showmsg ( lang ( 'global:dbsuccess' ), $callbackUrl, $callFunc_b );
	}
	/* 删除 */
	function del($labelid) {
		/* 回调参数 */
		$callbackUrl = msg_param ();
		$callFunc = msg_func ();
		$callFunc_b = msg_func ( 'callFunc_b' );
		
		if (check_is_array ( $labelid ) < 1) {
			showmsg ( lang ( 'global:param_ids_null' ), NULL, $callFunc );
		}
		
		$this->db->trans_begin ();
		
		for($i = 0; $i < array_number ( $labelid ); $i ++) {
			$labelid [$i] = trim_addslashes ( $labelid [$i] );
			if (check_nums ( $labelid [$i] ) < 1) {
				$this->db->trans_rollback_end ();
				showmsg ( lang ( 'global:param_ids_fail' ), $callbackUrl, $callFunc_b );
			}
			/* 是否存在 */
			$result = $this->label_query ( 'labelid', $labelid [$i] );
			if ($result == $this->db->cw) {
				$this->db->trans_rollback_end ();
				showmsg ( lang ( 'global:dbexceptions' ), $callbackUrl, $callFunc_b );
			}
			if (check_is_array ( $result ) < 1) {
				continue;
			}
			/* 如果存在已选聚合标签,则删除 */
			$result = $this->labelid_query ( 'labelid', $labelid [$i] );
			if ($result == $this->db->cw) {
				$this->db->trans_rollback_end ();
				showmsg ( lang ( 'global:dbexceptions' ), $callbackUrl, $callFunc_b );
			}
			if (check_is_array ( $result ) == 1) {
				$result = $this->db->db_delete ( $this->table_article_labelid, 'labelid', $labelid [$i] );
				if ($result == $this->db->cw) {
					$this->db->trans_rollback_end ();
					showmsg ( lang ( 'global:dbexceptions' ), $callbackUrl, $callFunc_b );
				}
			}
			/* 删除标签 */
			$result = $this->db->db_delete ( $this->table_article_label, 'labelid', $labelid [$i] );
			if ($result == $this->db->cw) {
				$this->db->trans_rollback_end ();
				showmsg ( lang ( 'global:dbexceptions' ), $callbackUrl, $callFunc_b );
			}
			$this->db->trans_commit ();
		}
		$this->db->trans_end ();
		showmsg ( lang ( 'global:dbsuccess' ), $callbackUrl, $callFunc_b );
	}
}
?>