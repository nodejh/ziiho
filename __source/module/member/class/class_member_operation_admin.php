<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}
class class_member_operation_admin extends class_model {
	public $member = NULL;
	public $member_group = NULL;
	public $menu = NULL;
	public $admin = NULL;
	
	/* 析构函数 */
	function __construct() {
		parent::__construct ();
	}
	function class_member_operation_admin() {
		$this->__construct ();
	}
	
	/* 设置会员对象 */
	function set_member_obj() {
		$this->member = loader ( 'class:class_member', 'member', true, true );
	}
	/* 设置会员组对象 */
	function set_member_group_obj() {
		$this->member_group = loader ( 'class:class_member_group', 'member', true, true );
	}
	/* 设置后台菜单对象 */
	function set_menu_obj() {
		$this->menu = loader ( 'class:class_admin_menu', 'admin', true, true );
	}
	/* 设置管理员对象 */
	function set_admin_obj() {
		$this->admin = loader ( 'class:class_admin', 'admin', true, true );
	}
	/* 会员操作项 */
	function member_operation_query($_key, $_val = NULL) {
		$this->db->from ( $this->table_member_operation );
		$this->db->where ( $_key, $_val );
		$result = $this->db->select ();
		if ($result == $this->db->cw) {
			return $result;
		}
		$result = $this->db->get_one ();
		return $result;
	}
	/* 会员系统组设置 */
	function system_group($set_uid, $system_groupid, $menu_id) {
		/* 回调参数 */
		$url = msg_param ();
		$callFunc = msg_func ();
		$callFunc_b = msg_func ( 'callFunc_b' );
		
		$uid = get_user ( 'uid' );
		/* 检查用户uid */
		if (check_nums ( $set_uid ) < 1) {
			showmsg ( lang ( 'member:set_uid_fail' ), NULL, $callFunc );
		}
		/* 检查组system_groupid */
		if (check_num ( $system_groupid ) < 1) {
			showmsg ( lang ( 'member:set_system_groupid_fail' ), NULL, $callFunc );
		}
		
		/* 初始类 */
		$this->set_member_obj ();
		$this->set_member_group_obj ();
		$this->set_menu_obj ();
		$this->set_admin_obj ();
		
		/* 开始事务 */
		$this->db->trans_begin ();
		
		/* 检查用户是否存在 */
		$mquery = $this->member->member_query ( 'uid', $set_uid );
		if ($mquery == $this->db->cw) {
			/* 回滚事务 */
			$this->db->trans_rollback_end ();
			showmsg ( lang ( 'global:dbexception' ), NULL, $callFunc );
		}
		if (check_is_array ( $mquery ) < 1) {
			/* 回滚事务 */
			$this->db->trans_rollback_end ();
			showmsg ( lang ( 'member:set_uid_notexist' ), NULL, $callFunc );
		}
		
		/* 检查管理组是否存在 */
		if (check_nums ( $system_groupid ) == 1) {
			$gquery = $this->member_group->group_query ( 'groupid', $system_groupid );
			if ($gquery == $this->db->cw) {
				/* 回滚事务 */
				$this->db->trans_rollback_end ();
				showmsg ( lang ( 'global:dbexception' ), NULL, $callFunc );
			}
			if (check_is_array ( $gquery ) < 1) {
				/* 回滚事务 */
				$this->db->trans_rollback_end ();
				showmsg ( lang ( 'member:set_system_groupid_notexist' ), NULL, $callFunc );
			}
		}
		
		/* 检查会员是否存在管理菜单 */
		$menuofrs = $this->menu->menu_ofquery ( 'uid', $set_uid );
		if ($menuofrs == $this->db->cw) {
			/* 回滚事务 */
			$this->db->trans_rollback_end ();
			showmsg ( lang ( 'global:dbexception' ), NULL, $callFunc );
		}
		/* 删除需要更新的管理菜单 */
		if (check_is_array ( $menuofrs ) == 1) {
			$this->db->from ( $this->menu->table_admin_menuof );
			/* 检查是否取消管理菜单 */
			if (check_nums ( $system_groupid ) == 1) {
				if (array_number ( $menu_id ) >= 1) {
					$this->db->where_not_in ( 'menu_id', $menu_id );
				}
			}
			$this->db->where ( 'uid', $set_uid );
			$result = $this->db->delete ();
			if ($result == $this->db->cw) {
				/* 回滚事务 */
				$this->db->trans_rollback_end ();
				showmsg ( lang ( 'global:dbexception' ), NULL, $callFunc );
			}
		}
		
		/* 更新会员主表系统组 */
		if ($mquery ['system_groupid'] != $system_groupid) {
			$result = $this->member->member_update ( array (
					'system_groupid' => $system_groupid 
			), 'uid', $set_uid );
			if ($result == $this->db->cw) {
				/* 回滚事务 */
				$this->db->trans_rollback_end ();
				showmsg ( lang ( 'global:dbexception' ), NULL, $callFunc );
			}
		}
		/* 处理管理员表 */
		$adminrs = $this->admin->admin_query ( 'uid', $set_uid );
		if ($adminrs == $this->db->cw) {
			/* 回滚事务 */
			$this->db->trans_rollback_end ();
			showmsg ( lang ( 'global:dbexception' ), NULL, $callFunc );
		}
		if (check_is_array ( $adminrs ) == 1) {
			/* 更新管理员组 */
			if (check_nums ( $system_groupid ) == 1) {
				if ($adminrs ['groupid'] != $system_groupid) {
					$result = $this->admin->admin_update ( array (
							'groupid' => $system_groupid 
					), 'uid', $set_uid );
					if ($result == $this->db->cw) {
						/* 回滚事务 */
						$this->db->trans_rollback_end ();
						showmsg ( lang ( 'global:dbexception' ), NULL, $callFunc );
					}
				}
			} else {
				/* 删除管理员 */
				$result = $this->admin->admin_del ( 'uid', $set_uid );
				if ($result == $this->db->cw) {
					/* 回滚事务 */
					$this->db->trans_rollback_end ();
					showmsg ( lang ( 'global:dbexception' ), NULL, $callFunc );
				}
			}
		} else {
			/* 新增管理员 */
			if (check_nums ( $system_groupid ) == 1) {
				$admin_add_data = array (
						'uid' => $set_uid,
						'groupid' => $system_groupid,
						'dateline' => - 1 
				);
				$result = $this->admin->admin_add ( $admin_add_data );
				if ($result == $this->db->cw) {
					/* 回滚事务 */
					$this->db->trans_rollback_end ();
					showmsg ( lang ( 'global:dbexception' ), NULL, $callFunc );
				}
			}
		}
		
		/* 更新管理菜单 */
		if (check_nums ( $system_groupid ) == 1) {
			if (check_is_array ( $menu_id ) == 1) {
				foreach ( $menu_id as $v ) {
					$v = trim_addslashes ( $v );
					if (check_nums ( $v ) < 1) {
						/* 回滚事务 */
						$this->db->trans_rollback_end ();
						showmsg ( lang ( 'member:set_menu_id_fail' ), NULL, $callFunc );
					}
					
					/* 查询管理菜单是否存在 */
					$result = $this->menu->menu_ofquery ( array (
							'menu_id' => $v,
							'uid' => $set_uid 
					) );
					if ($result == $this->db->cw) {
						/* 回滚事务 */
						$this->db->trans_rollback_end ();
						showmsg ( lang ( 'member:set_menu_id_dbexception' ), NULL, $callFunc );
					}
					if (check_is_array ( $result ) == 1) {
						continue;
					}
					/* 菜单是否存在 */
					$result = $this->menu->menu_query ( 'menu_id', $v );
					if ($result == $this->db->cw) {
						/* 回滚事务 */
						$this->db->trans_rollback_end ();
						showmsg ( lang ( 'member:set_menu_id_dbexception' ), NULL, $callFunc );
					}
					if (check_is_array ( $result ) < 1) {
						continue;
					}
					/* 增加管理菜单 */
					$result = $this->menu->menuof_add ( array (
							'menu_id' => $v,
							'uid' => $set_uid 
					) );
					if ($result == $this->db->cw) {
						/* 回滚事务 */
						$this->db->trans_rollback_end ();
						showmsg ( lang ( 'member:set_menu_id_dbexception' ), NULL, $callFunc );
					}
				}
			}
		}
		/* 提交事务 */
		$this->db->trans_commit_end ();
		showmsg ( lang ( 'global:dbsuccess' ), NULL, $callFunc );
	}
	/* 会员禁止 */
	function stop($set_uid, $member_status, $member_stop_term) {
		if (check_nums ( $set_uid ) < 1) {
			showmsg ( lang ( 'member:msearch_stop_set_uid_fail' ), NULL, 'myalert' );
		}
		if (check_num ( $member_status ) < 1) {
			showmsg ( lang ( 'member:msearch_stop_member_status_fail' ), NULL, 'myalert' );
		}
		/* 检查操作的会员是否存在 */
		$mrs = $this->member_query ( 'uid', $set_uid );
		if ($mrs == $this->db->cw) {
			showmsg ( lang ( 'member:msearch_stop_exception' ), NULL, 'myalert' );
		}
		if (check_is_array ( $mrs ) < 1) {
			showmsg ( lang ( 'member:msearch_stop_set_uid_no_exists' ), NULL, 'myalert' );
		}
		unset ( $mrs );
		
		/* 初始操作项 */
		$stop_term = dc_value ( 'member_stop_term' );
		if (check_is_array ( $stop_term ) < 1) {
			showmsg ( lang ( 'member:msearch_stop_member_stop_term_null' ), NULL, 'myalert' );
		}
		$data_arr = array ();
		if (check_is_array ( $member_stop_term ) == 1) {
			foreach ( $stop_term as $v ) {
				if (str_in_array ( $v ['v_val'], $member_stop_term ) < 1) {
					$data_arr [$v ['v_val']] = $v ['v_status'];
				} else {
					$data_arr [$v ['v_val']] = 0;
				}
			}
		} else {
			foreach ( $stop_term as $v ) {
				$data_arr [$v ['v_val']] = $v ['v_status'];
			}
		}
		/* 更新会员状态 */
		$this->db->from ( $this->table_member );
		$this->db->where ( 'uid', $set_uid );
		$this->db->set ( 'status', $member_status );
		$m_result = $this->db->update ();
		if ($m_result == $this->db->cw) {
			showmsg ( lang ( 'member:msearch_stop_exception' ), NULL, 'myalert' );
		}
		
		/* 查询是否存在,不存在则新增 */
		$ors = $this->member_operation_query ( 'uid', $set_uid );
		if ($ors == $this->db->cw) {
			showmsg ( lang ( 'member:msearch_stop_exception' ), NULL, 'myalert' );
		}
		/* 更新操作项 */
		$this->db->from ( $this->table_member_operation );
		if (check_is_array ( $ors ) < 1) {
			$this->db->set ( 'uid', $set_uid );
			$this->db->set ( $data_arr );
			$o_result = $this->db->insert ();
		} else {
			$this->db->where ( 'uid', $set_uid );
			$this->db->set ( $data_arr );
			$o_result = $this->db->update ();
		}
		if ($o_result == $this->db->cw) {
			showmsg ( lang ( 'member:msearch_stop_exception' ), NULL, 'myalert' );
		}
		showmsg ( lang ( 'member:msearch_stop_success' ), NULL, 'myalert' );
	}
	/* 会员添加 */
	function member_add($username, $email, $password, $password2, $admin_groupid) {
		/* 回调参数 */
		$url = msg_param ();
		$callFunc = msg_func ();
		$callFunc_b = msg_func ( 'callFunc_b' );
		
		$module = _M ();
		/* 初始化类 */
		$this->set_member_obj ();
		$this->set_member_group_obj ();
		
		/* 获取配置 */
		$sets = get_db_set ( array (
				'smodule' => $module,
				'stype' => member_value_get ( 'set_field', 'baseset', 'field' ) 
		) );
		if (check_is_array ( $sets ) < 1) {
			showmsg ( lang ( 'member:add_config_null' ), NULL, $callFunc );
		}
		
		/* 用户名长度 */
		$username_min = config_val ( 'username_min', $sets );
		$username_max = config_val ( 'username_max', $sets );
		/* 密码长度 */
		$password_min = config_val ( 'password_min', $sets );
		$password_max = config_val ( 'password_max', $sets );
		
		/* 检查参数值 */
		if (check_en_ep ( $username, $username_min, $username_max ) < 1) {
			showmsg ( lang ( 'member:add_username_fail' ), NULL, $callFunc );
		}
		if (check_email ( $email ) < 1) {
			showmsg ( lang ( 'member:add_email_fail' ), NULL, $callFunc );
		}
		if (check_is_len ( $password, $password_min, $password_max ) < 1) {
			showmsg ( lang ( 'member:add_password_fail' ), NULL, $callFunc );
		}
		$password = md5_str ( $password, 2 );
		/* 确认密码 */
		if (str_len ( $password2 ) < 1) {
			showmsg ( lang ( 'member:add_password2_fail' ), NULL, $callFunc );
		}
		if ($password !== md5_str ( $password2, 2 )) {
			showmsg ( lang ( 'member:add_password_not_equal' ), NULL, $callFunc );
		}
		/* 检查管理组 */
		if (check_num ( $admin_groupid ) < 1) {
			showmsg ( lang ( 'member:add_groupid_fail', member_grouptype ( 'system', 'title' ) ), NULL, $callFunc );
		}
		
		/* 事务开始 */
		$this->db->trans_begin ();
		
		/* 用户名是否存在 */
		$result = $this->member->member_query ( 'username', $username );
		if ($result == $this->db->cw) {
			$this->db->trans_rollback_end ();
			showmsg ( lang ( 'global:dbexception' ), NULL, $callFunc );
		}
		if (check_is_array ( $result ) == 1) {
			$this->db->trans_rollback_end ();
			showmsg ( lang ( 'member:add_username_isexist' ), NULL, $callFunc );
		}
		unset ( $result );
		/* 检查邮箱是否存在 */
		$result = $this->member->member_query ( 'email', $email );
		if ($result == $this->db->cw) {
			$this->db->trans_rollback_end ();
			showmsg ( lang ( 'global:dbexception' ), NULL, $callFunc );
		}
		if (check_is_array ( $result ) == 1) {
			$this->db->trans_rollback_end ();
			showmsg ( lang ( 'member:add_email_isexist' ), NULL, $callFunc );
		}
		unset ( $result );
		
		/* 管理组是否存在 */
		if (check_nums ( $admin_groupid ) == 1) {
			$adminGroupRs = $this->member_group->group_query ( 'groupid', $admin_groupid );
			if ($adminGroupRs == $this->db->cw) {
				$this->db->trans_rollback_end ();
				showmsg ( lang ( 'global:dbexception' ), NULL, $callFunc );
			}
			if (check_is_array ( $adminGroupRs ) < 1) {
				$this->db->trans_rollback_end ();
				showmsg ( lang ( 'member:add_groupid_notexist', member_grouptype ( 'system', 'title' ) ), NULL, $callFunc );
			}
		}
		
		/* 注册时间 */
		$ctime = $this->sys_time;
		/* ip */
		$ip = getip ();
		/* 初始化数据 */
		$dataArr = array (
				'username' => $username,
				'password' => $password,
				'email' => $email,
				'register_time' => $ctime,
				'before_time' => $ctime,
				'last_time' => $ctime,
				'register_ip' => $ip,
				'before_ip' => $ip,
				'last_ip' => $ip,
				'adminid' => $admin_groupid 
		);
		$insertUid = $this->member->member_add ( $dataArr, NULL, true );
		unset ( $dataArr );
		if ($insertUid == $this->db->cw) {
			$this->db->trans_rollback_end ();
			showmsg ( lang ( 'global:dbexception' ), NULL, $callFunc );
		}
		/* 初始化会员组 */
		$groupinitStatus = $this->member_group->group_init ( $insertUid );
		if ($groupinitStatus !== $this->db->zq) {
			$this->db->trans_rollback_end ();
			showmsg ( $groupinitStatus, NULL, $callFunc );
		}
		/* 提交事务 */
		$this->db->trans_commit_end ();
		
		showmsg ( lang ( 'global:dbsuccess' ), NULL, $callFunc_b );
	}
}
?>