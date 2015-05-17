<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}

loader ( 'class:class_member_group', 'member', true );
class class_member_group_admin extends class_member_group {
	
	/* 析构函数 */
	function __construct() {
		parent::__construct ();
	}
	function class_member_group_admin() {
		$this->__construct ();
	}
	
	/* 返回组列表管理页 */
	function group_levelUrl($groupType) {
		$url = url ( 'index', 'mod/member/ac/admin/op/membergroup/ao/level/grouptype/' . $groupType );
		return $url;
	}
	/* 组基本添加 */
	function group_baseadd($grouptype, $title, $credit) {
		/* 回调参数 */
		$callbackUrl = $this->group_levelUrl ( $grouptype );
		$callFunc = msg_func ();
		$callFunc_b = msg_func ( 'callFunc_b' );
		
		if (str_len ( $title ) < 1) {
			showmsg ( lang ( 'member:group_title_null' ), NULL, $callFunc );
		}
		if (check_num ( $credit ) < 1) {
			$credit = 0;
		}
		/* 检查用户组类型 */
		if (str_len ( member_grouptype ( $grouptype ) ) < 1) {
			showmsg ( lang ( 'member:group_grouptype_fail' ), NULL, $callFunc );
		}
		/* 初始化数据 */
		$data_arr = array (
				'title' => $title,
				'ctime' => $this->sys_time,
				'grouptype' => $grouptype,
				'iscore' => yesno_val ( 'normal' ),
				'credit' => $credit 
		);
		$result = $this->db->db_insert ( $this->table_member_group, $data_arr );
		unset ( $data_arr );
		if ($result == $this->db->cw) {
			showmsg ( lang ( 'global:dbexception' ), NULL, $callFunc );
		}
		showmsg ( lang ( 'global:dbsuccess' ), $callbackUrl, $callFunc_b );
	}
	/* 组基本编辑 */
	function group_baseedit($grouptype, $groupid, $title, $credit) {
		/* 回调参数 */
		$callbackUrl = $this->group_levelUrl ( $grouptype );
		$callFunc = msg_func ();
		$callFunc_b = msg_func ( 'callFunc_b' );
		
		if (check_is_array ( $groupid ) < 1) {
			showmsg ( lang ( 'member:group_list_groupid_null' ), NULL, $callFunc );
		}
		for($i = 0; $i < array_number ( $groupid ); $i ++) {
			$groupid [$i] = trim_addslashes ( $groupid [$i] );
			$title [$i] = trim_addslashes ( $title [$i] );
			$credit [$i] = trim_addslashes ( $credit [$i] );
			if (check_nums ( $groupid [$i] ) < 1) {
				showmsg ( lang ( 'member:group_list_groupid_fail' ), $callbackUrl, $callFunc_b );
			}
			/* 查询用户组 */
			$qrs = $this->group_query ( 'groupid', $groupid [$i] );
			if ($qrs == $this->db->cw) {
				showmsg ( lang ( 'global:dbexceptions' ), $callbackUrl, $callFunc_b );
			}
			if (check_is_array ( $qrs ) < 1) {
				continue;
			}
			if (str_len ( $title [$i] ) < 1) {
				$title [$i] = $qrs ['title'];
			}
			if (check_num ( $credit [$i] ) < 1) {
				$credit [$i] = $qrs ['credit'];
			}
			/* 初始化数据 */
			$data_arr = array (
					'title' => $title [$i],
					'credit' => $credit [$i] 
			);
			$result = $this->db->db_update ( $this->table_member_group, $data_arr, 'groupid', $groupid [$i] );
			unset ( $data_arr );
			if ($result == $this->db->cw) {
				showmsg ( lang ( 'global:dbexceptions' ), $callbackUrl, $callFunc_b );
			}
		}
		showmsg ( lang ( 'global:dbsuccess' ), $callbackUrl, $callFunc_b );
	}
	/* 组删除 */
	function group_del($grouptype, $groupid) {
		/* 回调参数 */
		$callbackUrl = $this->group_levelUrl ( $grouptype );
		$callFunc = msg_func ();
		$callFunc_b = msg_func ( 'callFunc_b' );
		
		if (check_is_array ( $groupid ) < 1) {
			showmsg ( lang ( 'member:group_list_groupid_null' ), NULL, $callFunc );
		}
		$coreStatus = yesno_val ( 'check' );
		/* 开始事务 */
		$this->db->trans_begin ();
		
		for($i = 0; $i < array_number ( $groupid ); $i ++) {
			$groupid [$i] = trim_addslashes ( $groupid [$i] );
			if (check_nums ( $groupid [$i] ) < 1) {
				/* 回滚事务 */
				$this->db->trans_rollback_end ();
				showmsg ( lang ( 'member:group_list_groupid_fail' ), $callbackUrl, $callFunc_b );
			}
			/* 查询用户组 */
			$qrs = $this->group_query ( 'groupid', $groupid [$i] );
			if ($qrs == $this->db->cw) {
				/* 回滚事务 */
				$this->db->trans_rollback_end ();
				showmsg ( lang ( 'global:dbexceptions' ), $callbackUrl, $callFunc_b );
			}
			if (check_is_array ( $qrs ) < 1) {
				continue;
			}
			if ($qrs ['iscore'] == $coreStatus) {
				continue;
			}
			unset ( $qrs );
			/* 删除组设置 */
			$result = $this->db->db_delete ( $this->table_member_groupset, 'groupid', $groupid [$i] );
			if ($result == $this->db->cw) {
				/* 回滚事务 */
				$this->db->trans_rollback_end ();
				showmsg ( lang ( 'global:dbexceptions' ), $callbackUrl, $callFunc_b );
			}
			/* 删除 */
			$result = $this->db->db_delete ( $this->table_member_group, 'groupid', $groupid [$i] );
			if ($result == $this->db->cw) {
				/* 回滚事务 */
				$this->db->trans_rollback_end ();
				showmsg ( lang ( 'global:dbexceptions' ), $callbackUrl, $callFunc_b );
			}
			/* 提交事务 */
			$this->db->trans_commit ();
		}
		/* 结束事务 */
		$this->db->trans_end ();
		showmsg ( lang ( 'global:dbsuccess' ), $callbackUrl, $callFunc_b );
	}
	/* 组编辑设置 */
	function group_editset($groupid, $title, $credit, $module, $settingdo) {
		/* 回调参数 */
		$callbackUrl = msg_param ();
		$callFunc = msg_func ();
		$callFunc_b = msg_func ( 'callFunc_b' );
		
		if (check_num ( $groupid ) < 1) {
			showmsg ( lang ( 'member:group_groupid_fail' ), NULL, $callFunc );
		}
		/* 查询用户组 */
		$qrs = $this->group_query ( 'groupid', $groupid );
		if ($qrs == $this->db->cw) {
			showmsg ( lang ( 'global:dbexception' ), NULL, $callFunc );
		}
		if (check_is_array ( $qrs ) < 1) {
			showmsg ( lang ( 'member:group_groupid_no_exists' ), $callbackUrl, $callFunc_b );
		}
		if (str_len ( $title ) < 1) {
			$title = $qrs ['title'];
		}
		if (check_num ( $credit ) < 1) {
			$credit = $qrs ['credit'];
		}
		unset ( $qrs );
		
		/* 初始化数据 */
		$data_arr = array (
				'title' => $title,
				'credit' => $credit 
		);
		$result = $this->db->db_update ( $this->table_member_group, $data_arr, 'groupid', $groupid );
		unset ( $data_arr );
		if ($result == $this->db->cw) {
			showmsg ( lang ( 'global:dbexception' ), NULL, $callFunc );
		}
		/* 组设置 */
		$result = $this->group_settingdo ( $groupid, $module, $settingdo );
		if ($result != $this->db->zq) {
			showmsg ( $result, NULL, $callFunc );
		}
		/* 操作成功 */
		showmsg ( lang ( 'global:dbsuccess' ), NULL, $callFunc );
	}
	/* -------------------设置组-------------------- */
	/*组设置添加*/
	function group_setting_add($data) {
		$this->db->from ( $this->table_member_groupset );
		$this->db->set ( $data );
		$result = $this->db->insert ();
		return $result;
	}
	/* 组设置编辑 */
	function group_setting_update($data, $_key, $_val = NULL) {
		$this->db->from ( $this->table_member_groupset );
		$this->db->where ( $_key, $_val );
		$this->db->set ( $data );
		$result = $this->db->update ();
		return $result;
	}
	/* 组设置检查 */
	function group_settingdo($groupid, $module, $settingdo) {
		/* 检查模块是否存在 */
		if (check_is_array ( get_module ( $module ) ) < 1) {
			return lang ( 'common:module_noexist', $module );
		}
		/* 更新组设置检查 */
		$settingdo = $module . $settingdo;
		loader ( 'admin:helper:' . $settingdo, $module );
		if (check_is_fun ( $settingdo ) < 1) {
			$lang = lang ( 'member:group_allow_helper_notexist', $settingdo );
			return $lang;
		}
		/* 开始更新组设置 */
		$data = $settingdo ( $this );
		if (check_is_array ( $data ) < 1) {
			return $data;
		}
		/* 检查设置是否存在 */
		$groupset = $this->groupset_query ( array (
				'groupid' => $groupid,
				'module' => $module 
		) );
		if ($groupset == $this->db->cw) {
			return lang ( 'global:dbexception' );
		}
		/* 序列化数组成字符 */
		$data = en_serialize ( $data );
		/* 如果不存在则新增设置 */
		if (check_is_array ( $groupset ) < 1) {
			$arr = array (
					'groupid' => $groupid,
					'module' => $module,
					'setting' => $data 
			);
			$result = $this->group_setting_add ( $arr );
		} else {
			$arr = array (
					'setting' => $data 
			);
			$result = $this->group_setting_update ( $arr, array (
					'groupsetid' => $groupset ['groupsetid'] 
			) );
		}
		if ($result != $this->db->zq) {
			return lang ( 'global:dbexception' );
		}
		return $result;
	}
}
?>