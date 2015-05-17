<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}

loader ( 'class:class_article_tag', 'article', true );
class class_article_tag_admin extends class_article_tag {
	
	/* 析构函数 */
	function __construct() {
		parent::__construct ();
	}
	function class_article_tag_admin() {
		$this->__construct ();
	}
	
	/* 简单添加 */
	function baseadd($listorder, $title, $disabled) {
		/* 回调参数 */
		$callbackUrl = msg_param ();
		$callFunc = msg_func ();
		$callFunc_b = msg_func ( 'callFunc_b' );
		
		if (check_num ( $listorder ) < 1) {
			$listorder = 0;
		}
		if (check_num ( $disabled ) < 1) {
			$disabled = yesno_val ( 'check' );
		}
		if (str_len ( $title ) < 1) {
			showmsg ( lang ( 'article:tag_title_null' ), NULL, $callFunc );
		}
		$dataArr = array (
				'listorder' => $listorder,
				'title' => $title,
				'ctime' => $this->sys_time,
				'disabled' => $disabled 
		);
		$result = $this->db->db_insert ( $this->table_article_tagname, $dataArr );
		unset ( $dataArr );
		if ($result == $this->db->cw) {
			showmsg ( lang ( 'global:dbexception' ), NULL, $callFunc );
		}
		
		showmsg ( lang ( 'global:dbsuccess' ), $callbackUrl, $callFunc_b );
	}
	/* 简单编辑 */
	function baseedit($tid, $listorder, $title, $disabled) {
		/* 回调参数 */
		$callbackUrl = msg_param ();
		$callFunc = msg_func ();
		$callFunc_b = msg_func ( 'callFunc_b' );
		
		if (check_is_array ( $tid ) < 1) {
			showmsg ( lang ( 'global:param_ids_null' ), NULL, $callFunc );
		}
		for($i = 0; $i < array_number ( $tid ); $i ++) {
			$tid [$i] = trim_addslashes ( $tid [$i] );
			$listorder [$i] = trim_addslashes ( $listorder [$i] );
			$title [$i] = trim_addslashes ( $title [$i] );
			$disabled [$i] = trim_addslashes ( $disabled [$i] );
			if (check_nums ( $tid [$i] ) < 1) {
				showmsg ( lang ( 'global:param_ids_fail' ), $callbackUrl, $callFunc_b );
			}
			/* 是否存在 */
			$qrs = $this->tagname_query ( 'tid', $tid [$i] );
			if ($qrs == $this->db->cw) {
				showmsg ( lang ( 'global:dbexceptions' ), $callbackUrl, $callFunc_b );
			}
			if (check_is_array ( $qrs ) < 1) {
				continue;
			}
			if (check_num ( $listorder [$i] ) < 1) {
				$listorder [$i] = $qrs ['listorder'];
			}
			if (str_len ( $title [$i] ) < 1) {
				$title [$i] = $qrs ['title'];
			}
			if (check_num ( $disabled [$i] ) < 1) {
				$disabled [$i] = yesno_val ( 'check' );
			}
			/* 初始化参数 */
			$dataArr = array (
					'listorder' => $listorder [$i],
					'title' => $title [$i],
					'disabled' => $disabled [$i] 
			);
			$result = $this->db->db_update ( $this->table_article_tagname, $dataArr, 'tid', $tid [$i] );
			unset ( $dataArr );
			if ($result == $this->db->cw) {
				showmsg ( lang ( 'global:dbexceptions' ), $callbackUrl, $callFunc_b );
			}
		}
		showmsg ( lang ( 'global:dbsuccess' ), $callbackUrl, $callFunc_b );
	}
	/* 删除 */
	function del($tid) {
		/* 回调参数 */
		$callbackUrl = msg_param ();
		$callFunc = msg_func ();
		$callFunc_b = msg_func ( 'callFunc_b' );
		
		if (check_is_array ( $tid ) < 1) {
			showmsg ( lang ( 'global:param_ids_null' ), NULL, $callFunc );
		}
		
		$this->db->trans_begin ();
		
		for($i = 0; $i < array_number ( $tid ); $i ++) {
			$tid [$i] = trim_addslashes ( $tid [$i] );
			if (check_nums ( $tid [$i] ) < 1) {
				$this->db->trans_rollback_end ();
				showmsg ( lang ( 'global:param_ids_fail' ), $callbackUrl, $callFunc_b );
			}
			/* 标签是否存在 */
			$qrs = $this->tagname_query ( 'tid', $tid [$i] );
			if ($qrs == $this->db->cw) {
				$this->db->trans_rollback_end ();
				showmsg ( lang ( 'global:dbexceptions' ), $callbackUrl, $callFunc_b );
			}
			if (check_is_array ( $qrs ) < 1) {
				continue;
			}
			
			/* 如果存在关联标签,则删除 */
			$this->db->from ( $this->table_article_tag );
			$this->db->where ( 'tid', $tid [$i] );
			$this->db->select ();
			$result = $this->db->get_one ();
			if ($result == $this->db->cw) {
				$this->db->trans_rollback_end ();
				showmsg ( lang ( 'global:dbexceptions' ), $callbackUrl, $callFunc_b );
			}
			if (check_is_array ( $result ) == 1) {
				$result = $this->db->db_delete ( $this->table_article_tag, 'tid', $tid [$i] );
				if ($result == $this->db->cw) {
					$this->db->trans_rollback_end ();
					showmsg ( lang ( 'admin:dbexceptions' ), $callbackUrl, $callFunc_b );
				}
			}
			
			/* 删除标签 */
			$result = $this->db->db_delete ( $this->table_article_tagname, 'tid', $tid [$i] );
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