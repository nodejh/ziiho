<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}

loader ( 'class:class_common_nav', 'common', true );
class class_common_nav_admin extends class_common_nav {
	
	/* 析构函数 */
	function __construct() {
		parent::__construct ();
	}
	function class_common_nav_admin() {
		$this->__construct ();
	}
	
	/* 导航获取 */
	function nav_all($template, $navtype = NULL, $old_navid = NULL, $is_move = false) {
		if (check_num ( $old_navid ) < 1) {
			$old_navid = 0;
		}
		$this->db->from ( $this->table_common_nav );
		$this->db->where ( 'navtype', $navtype );
		$this->db->order_by ( 'listorder' );
		$result = $this->db->select ();
		if ($result == $this->db->cw) {
			return $result;
		}
		$result = $this->db->get_list ();
		while ( $val = $this->db->fetch_array ( $result ) ) {
			$navids [$val ['navids']] [] = $val ['navid'];
			$navid [$val ['navid']] = $val ['navid'];
			$navids_arr [$val ['navid']] = $val ['navids'];
			$listorder [$val ['navid']] = $val ['listorder'];
			$title [$val ['navid']] = $val ['title'];
			$navurl [$val ['navid']] = $val ['navurl'];
			$disabled [$val ['navid']] = $val ['disabled'];
		}
		$content = $this->_nav_all ( $navids [0], $navids, $navid, $navids_arr, $listorder, $title, $navurl, $disabled, $template, $old_navid, $is_move );
		return $content;
	}
	/* 导航获取显示 */
	function _nav_all($parents, $navids, $navid, $navids_arr, $listorder, $title, $navurl, $disabled, $template, $old_navid, $is_move, $indent = 0) {
		if (is_array ( $parents )) {
			foreach ( $parents as $parent ) {
				$arr = "array('indent'=>'{$indent}','navid'=>'{$navid[$parent]}','navids'=>'{$navids_arr[$parent]}','listorder'=>'{$listorder[$parent]}','title'=>'{$title[$parent]}','navurl'=>'{$navurl[$parent]}','disabled'=>'{$disabled[$parent]}','description'=>'{$description[$parent]}','disabled'=>'{$disabled[$parent]}','old_navid'=>'{$old_navid}');";
				$content .= get_fetch ( $template, array (
						'arr' => $arr 
				) );
				/* 遍历父id下的子id */
				
				if (array_key_exists ( $parent, $navids )) {
					$content .= $this->_nav_all ( $navids [$parent], $navids, $navid, $navids_arr, $listorder, $title, $navurl, $disabled, $template, $old_navid, $is_move, ($indent + 1) );
				}
			}
		}
		return $content;
	}
	/* 导航_添加设置 */
	function main_addset($new_navid, $module, $listorder, $title, $navurl, $ofkey, $ofval, $navxy, $target, $disabled) {
		/* 回调参数 */
		$url = msg_param ();
		$callFunc = msg_func ();
		$callFunc_b = msg_func ( 'callFunc_b' );
		
		if (check_num ( $new_navid ) < 1) {
			showmsg ( lang ( 'global:param_id_fail' ), NULL, $callFunc );
		}
		if (str_len ( $title ) < 1) {
			showmsg ( lang ( 'common:nav_title_null' ), NULL, $callFunc );
		}
		/* 查询上级导航是否存在 */
		if (check_nums ( $new_navid ) == 1) {
			$result = $this->nav_query ( 'navid', $new_navid );
			if ($result == $this->db->cw) {
				showmsg ( lang ( 'global:dbexception' ), NULL, $callFunc );
			}
			if (check_is_array ( $result ) < 1) {
				tmsg ( lang ( 'common:nav_parent_notexist' ), $url, $callFunc_b );
			}
		}
		if (check_num ( $listorder ) < 1) {
			$listorder = 0;
		}
		if (check_num ( $disabled ) < 1) {
			$disabled = yesno_val ( 'check' );
		}
		/* 导航类型 */
		$navtype = common_nav_type ( 'main' );
		/* 初始化数据 */
		$data_arr = array (
				'navids' => $new_navid,
				'module' => $module,
				'listorder' => $listorder,
				'title' => $title,
				'navurl' => $navurl,
				'navtype' => $navtype,
				'ofkey' => $ofkey,
				'ofval' => $ofval,
				'navxy' => $navxy,
				'target' => $target,
				'disabled' => $disabled,
				'ctime' => $this->sys_time 
		);
		$result = $this->db->db_insert ( $this->table_common_nav, $data_arr );
		if ($result == $this->db->cw) {
			showmsg ( lang ( 'global:dbexception' ), NULL, $callFunc );
		}
		showmsg ( lang ( 'global:dbsuccess' ), $url, $callFunc_b );
	}
	/* 导航_编辑 */
	function main_editset($navid, $new_navid, $module, $listorder, $title, $navurl, $ofkey, $ofval, $navxy, $target, $disabled) {
		/* 回调参数 */
		$url = msg_param ();
		$callFunc = msg_func ();
		$callFunc_b = msg_func ( 'callFunc_b' );
		
		if (check_nums ( $navid ) < 1) {
			showmsg ( lang ( 'global:param_id_fail' ), NULL, $callFunc );
		}
		/* 检查导航位置参数 */
		if (check_num ( $new_navid ) < 1) {
			showmsg ( lang ( 'common:nav_parent_fail' ), NULL, $callFunc );
		}
		if (str_len ( $title ) < 1) {
			showmsg ( lang ( 'common:nav_title_null' ), NULL, $callFunc );
		}
		$listorder = (check_num ( $listorder ) < 1) ? 0 : $listorder;
		$disabled = (check_num ( $disabled ) < 1) ? 0 : $disabled;
		
		/* 检查是否存在 */
		$result = $this->nav_query ( 'navid', $navid );
		if ($result == $this->db->cw) {
			showmsg ( lang ( 'global:dbexception' ), NULL, $callFunc );
		}
		if (check_is_array ( $result ) < 1) {
			showmsg ( lang ( 'global:param_id_notexist' ), $url, $callFunc_b );
		}
		$old_navids = $result ['navids'];
		/* 导航新归类是否存在 */
		if ($navid != $new_navid && check_nums ( $new_navid ) == 1) {
			$result = $this->nav_query ( 'navid', $new_navid );
			if ($result == $this->db->cw) {
				showmsg ( lang ( 'global:dbexception' ), NULL, $callFunc );
			}
			if (check_is_array ( $result ) < 1) {
				showmsg ( lang ( 'common:nav_parent_notexist' ), $url, $callFunc_b );
			}
		}
		/* 初始化数据 */
		$data_arr = array (
				'navids' => $new_navid,
				'module' => $module,
				'listorder' => $listorder,
				'title' => $title,
				'navurl' => $navurl,
				'ofkey' => $ofkey,
				'ofval' => $ofval,
				'navxy' => $navxy,
				'target' => $target,
				'disabled' => $disabled 
		);
		/* 检查是否需要设置位置 */
		if ($navid == $new_navid || $old_navids == $new_navid) {
			unset ( $data_arr ['navids'] );
		}
		$result = $this->db->db_update ( $this->table_common_nav, $data_arr, 'navid', $navid );
		unset ( $data_arr );
		if ($result == $this->db->cw) {
			showmsg ( lang ( 'global:dbexception' ), NULL, $callFunc );
		}
		showmsg ( lang ( 'global:dbsuccess' ), $url, $callFunc_b );
	}
	/* 列表编辑 */
	function main_listedit($navid, $listorder, $title, $navurl, $disabled) {
		/* 回调参数 */
		$url = msg_param ();
		$callFunc = msg_func ();
		$callFunc_b = msg_func ( 'callFunc_b' );
		
		if (check_is_array ( $navid ) < 1) {
			showmsg ( lang ( 'global:param_ids_null' ), NULL, $callFunc );
		}
		for($i = 0; $i < array_number ( $navid ); $i ++) {
			$navid [$i] = trim_addslashes ( $navid [$i] );
			$listorder [$i] = trim_addslashes ( $listorder [$i] );
			$title [$i] = trim_addslashes ( $title [$i] );
			$navurl [$i] = trim_addslashes ( $navurl [$i] );
			$disabled [$i] = trim_addslashes ( $disabled [$i] );
			if (check_nums ( $navid [$i] ) < 1) {
				showmsg ( lang ( 'global:param_ids_fail' ), $url, $callFunc_b );
			}
			/* 查询是否存在 */
			$qrs = $this->nav_query ( 'navid', $navid [$i] );
			if ($qrs == $this->db->cw) {
				showmsg ( lang ( 'global:dbexceptions' ), $url, $callFunc_b );
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
			if (str_len ( $navurl [$i] ) < 1) {
				$navurl [$i] = $qrs ['navurl'];
			}
			if (check_num ( $disabled [$i] ) < 1) {
				$disabled [$i] = $qrs ['disabled'];
			}
			/* 初始化数据 */
			$data_arr = array (
					'listorder' => $listorder [$i],
					'title' => $title [$i],
					'navurl' => $navurl [$i],
					'disabled' => $disabled [$i] 
			);
			$result = $this->db->db_update ( $this->table_common_nav, $data_arr, 'navid', $navid [$i] );
			if ($result == $this->db->cw) {
				showmsg ( lang ( 'global:dbexceptions' ), $url, $callFunc_b );
			}
		}
		showmsg ( lang ( 'global:dbsuccess' ), $url, $callFunc_b );
	}
	/* 导航_删除 */
	function main_del($navid) {
		/* 回调参数 */
		$url = msg_param ();
		$callFunc = msg_func ();
		$callFunc_b = msg_func ( 'callFunc_b' );
		
		if (check_is_array ( $navid ) < 1) {
			showmsg ( lang ( 'global:param_ids_null' ), NULL, $callFunc );
		}
		for($i = 0; $i < array_number ( $navid ); $i ++) {
			$navid [$i] = trim_addslashes ( $navid [$i] );
			if (check_nums ( $navid [$i] ) < 1) {
				showmsg ( lang ( 'global:param_ids_fail' ), $url, $callFunc_b );
			}
			/* 是否存在 */
			$result = $this->nav_query ( 'navid', $navid [$i] );
			if ($result == $this->db->cw) {
				showmsg ( lang ( 'global:dbexceptions' ), $url, $callFunc_b );
			}
			if (check_is_array ( $result ) < 1) {
				continue;
			}
			$navtype = $result ['navtype'];
			unset ( $result );
			
			/* 获取子id */
			$ids = $this->nav_child_id ( $navtype, $navid [$i] );
			if ($ids == $this->db->cw) {
				showmsg ( lang ( 'global:dbexceptions' ), $url, $callFunc_b );
			}
			$ids = explode_str ( $ids, ',' );
			/* 删除 */
			$this->db->from ( $this->table_common_nav );
			$this->db->where_in ( 'navid', $ids );
			$result = $this->db->delete ();
			if ($result == $this->db->cw) {
				showmsg ( lang ( 'global:dbexceptions' ), $url, $callFunc_b );
			}
		}
		showmsg ( lang ( 'global:dbsuccess' ), $url, $callFunc_b );
	}
}
?>