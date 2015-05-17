<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}

loader ( 'class:class_member_tag', 'member', true );
class class_member_tag_admin extends class_member_tag {
	
	/* 析构函数 */
	function __construct() {
		parent::__construct ();
	}
	function class_member_tag_admin() {
		$this->__construct ();
	}
	
	/* 添加 */
	function baseadd($listorder, $title, $disabled) {
		/* 回调参数 */
		$url = msg_param ();
		$callFunc = msg_func ();
		$callFunc_b = msg_func ( 'callFunc_b' );
		
		if (str_len ( $title ) < 1) {
			showmsg ( lang ( 'member_adm:tag_title_null' ), NULL, $callFunc );
		}
		if (check_num ( $listorder ) < 1) {
			$listorder = 0;
		}
		if (check_num ( $disabled ) < 1) {
			$disabled = yesno_val ( 'check' );
		}
		/* 初始化数据 */
		$data_arr = array (
				'listorder' => $listorder,
				'title' => $title,
				'ctime' => $this->sys_time,
				'disabled' => $disabled 
		);
		$result = $this->db->db_insert ( $this->table_member_tag, $data_arr );
		unset ( $data_arr );
		if ($result == $this->db->cw) {
			showmsg ( lang ( 'admin:dbexception' ), NULL, $callFunc );
		}
		showmsg ( lang ( 'admin:dbsuccess' ), $url, $callFunc_b );
	}
	/* 列表编辑 */
	function baseedit($tagid, $listorder, $title, $disabled) {
		/* 回调参数 */
		$url = msg_param ();
		$callFunc = msg_func ();
		$callFunc_b = msg_func ( 'callFunc_b' );
		/* 检查参数 */
		if (check_is_array ( $tagid ) < 1) {
			showmsg ( lang ( 'member_adm:tagtitle_list_edit_tagid_null' ), NULL, $callFunc );
		}
		/* 当前页码 */
		$page = array (
				'page' => post_page () 
		);
		
		for($i = 0; $i < array_number ( $tagid ); $i ++) {
			$tagid [$i] = trim_addslashes ( $tagid [$i] );
			$listorder [$i] = trim_addslashes ( $listorder [$i] );
			$title [$i] = trim_addslashes ( $title [$i] );
			$disabled [$i] = trim_addslashes ( $disabled [$i] );
			if (check_nums ( $tagid [$i] ) < 1) {
				showmsg ( lang ( 'admin:param_ids_fail' ), $url, $callFunc_b );
			}
			/* 检查是否存在 */
			$tagrs = $this->tag_query ( 'tagid', $tagid [$i] );
			if ($tagrs == $this->db->cw) {
				showmsg ( lang ( 'admin:dbexceptions' ), $url, $callFunc_b );
			}
			if (check_is_array ( $tagrs ) < 1) {
				continue;
			}
			if (check_num ( $listorder [$i] ) < 1) {
				$listorder [$i] = $tagrs ['listorder'];
			}
			if (str_len ( $title [$i] ) < 1) {
				$title [$i] = $tagrs ['title'];
			}
			if (check_num ( $disabled [$i] ) < 1) {
				$disabled [$i] = $tagrs ['disabled'];
			}
			/* 初始化数据 */
			$data_arr = array (
					'listorder' => $listorder [$i],
					'title' => $title [$i],
					'disabled' => $disabled [$i] 
			);
			$result = $this->db->db_update ( $this->table_member_tag, $data_arr, 'tagid', $tagid [$i] );
			unset ( $data_arr );
			if ($result == $this->db->cw) {
				showmsg ( lang ( 'admin:dbexceptions' ), $url, $callFunc_b );
			}
		}
		showmsg ( lang ( 'admin:dbsuccess' ), $url, $callFunc_b );
	}
	/* 删除 */
	function del($tagid) {
		/* 回调参数 */
		$url = msg_param ();
		$callFunc = msg_func ();
		$callFunc_b = msg_func ( 'callFunc_b' );
		
		if (check_is_array ( $tagid ) < 1) {
			showmsg ( lang ( 'admin:param_ids_null' ), NULL, $callFunc );
		}
		/* 开始事务 */
		$this->db->trans_begin ();
		
		for($i = 0; $i < array_number ( $tagid ); $i ++) {
			$tagid [$i] = trim_addslashes ( $tagid [$i] );
			if (check_nums ( $tagid [$i] ) < 1) {
				/* 回滚事务 */
				$this->db->trans_rollback_end ();
				showmsg ( lang ( 'admin:param_ids_fail' ), $url, $callFunc_b );
			}
			/* 检查标签名是否存在 */
			$tagrs = $this->tag_query ( 'tagid', $tagid [$i] );
			if ($tagrs == $this->db->cw) {
				/* 回滚事务 */
				$this->db->trans_rollback_end ();
				showmsg ( lang ( 'admin:dbexceptions' ), $url, $callFunc_b );
			}
			if (check_is_array ( $tagrs ) < 1) {
				continue;
			}
			unset ( $tagrs );
			/* 检查会员是否选择该标签 */
			$tagrs = $this->tagof_query ( 'tagid', $tagid [$i] );
			if ($tagrs == $this->db->cw) {
				/* 回滚事务 */
				$this->db->trans_rollback_end ();
				showmsg ( lang ( 'admin:dbexceptions' ), $url, $callFunc_b );
			}
			if (check_is_array ( $tagrs ) == 1) {
				unset ( $tagrs );
				/* 同步删除会员已选择的标签 */
				$result = $this->db->db_delete ( $this->table_member_tagof, 'tagid', $tagid [$i] );
				if ($result == $this->db->cw) {
					/* 回滚事务 */
					$this->db->trans_rollback_end ();
					showmsg ( lang ( 'admin:dbexceptions' ), $url, $callFunc_b );
				}
			}
			/* 删除标签 */
			$result = $this->db->db_delete ( $this->table_member_tag, 'tagid', $tagid [$i] );
			if ($result == $this->db->cw) {
				/* 回滚事务 */
				$this->db->trans_rollback_end ();
				showmsg ( lang ( 'admin:dbexceptions' ), $url, $callFunc_b );
			}
			/* 提交事务 */
			$this->db->trans_commit ();
		}
		/* 结束事务 */
		$this->db->trans_end ();
		showmsg ( lang ( 'admin:dbsuccess' ), $url, $callFunc_b );
	}
}
?>