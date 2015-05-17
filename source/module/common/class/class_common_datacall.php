<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}

loader ( 'class:class_common_datablock', 'common', true );
class class_common_datacall extends class_common_datablock {
	
	/* 析构函数 */
	function __construct() {
		parent::__construct ();
	}
	function class_common_datacall() {
		$this->__construct ();
	}
	
	/* 添加检查 */
	function datacall_add_check($module) {
		/* 回调参数 */
		$msg_call_url = msg_param ();
		$msg_call = msg_func ();
		$msg_call_b = msg_func ( 'msg_call_b' );
		
		if (str_len ( $module ) < 1) {
			domsg ( lang ( 'common_adm:datacall_module_null' ), NULL, $msg_call );
			return NULL;
		}
		if (str_len ( get_module ( $module, 'id' ) ) < 1) {
			domsg ( lang ( 'common_adm:datacall_module_no_exists' ), NULL, $msg_call );
			return NULL;
		}
		/* 选择模块 */
		$func = $module . '_config_value_get';
		if (check_is_fun ( $func ) < 1) {
			domsg ( lang ( 'common_adm:datacall_module_no_exists' ), NULL, $msg_call );
			return NULL;
		}
		$val = $func ( 'datacall_set_url', 'add', 'val' );
		/* 跳转 */
		domsg ( lang ( 'common_adm:datacall_success' ), $val, $msg_call_b );
		return NULL;
	}
	/* 添加 */
	function datacall_add($module, $data, $msg_call, $msg_call_url, $msg_call_c, $paramback = NULL) {
		$listorder = post_param ( 'listorder' );
		$title = post_param ( 'title' );
		$dsid = post_param ( 'dsid' );
		/* 检查参数 */
		if (check_num ( $listorder ) < 1) {
			$listorder = 0;
		}
		if (str_len ( $title ) < 1) {
			domsg ( lang ( 'common_adm:datacall_title_null' ), NULL, $msg_call );
			exit ();
		}
		if (check_nums ( $dsid ) < 1) {
			domsg ( lang ( 'common_adm:datacall_dsid_fail' ), NULL, $msg_call );
			exit ();
		}
		/* 操作者 */
		$uid = get_user ( 'uid' );
		/* 时间 */
		$ctime = $this->sys_time;
		/* 配置数据 */
		$data = (check_is_array ( $data ) == 1) ? en_serialize ( $data ) : $data;
		/* 初始化数据 */
		$data_arr = array (
				'module' => $module,
				'dsid' => $dsid,
				'uid' => $uid,
				'listorder' => $listorder,
				'title' => $title,
				'values' => $data,
				'ctime' => $ctime,
				'btime' => $ctime,
				'etime' => $ctime 
		);
		$result = $this->db->db_insert ( $this->table_common_datacall, $data_arr, true );
		unset ( $data_arr );
		if ($result == $this->db->cw) {
			domsg ( lang ( 'common_adm:datacall_exception' ), NULL, $msg_call );
			return NULL;
		}
		$paramback = array (
				'msg_id' => $result,
				'msg_dourl' => array_key_val ( 'dourl', $paramback ) 
		);
		domsg ( lang ( 'common_adm:datacall_success' ), $msg_call_url, $msg_call_c, $paramback );
		return NULL;
	}
	/* 编辑 */
	function datacall_edit($data, $msg_call, $msg_call_url, $msg_call_b, $paramback = NULL) {
		$dcid = post_param ( 'dcid' );
		$listorder = post_param ( 'listorder' );
		$title = post_param ( 'title' );
		$dsid = post_param ( 'dsid' );
		/* 检查参数 */
		if (check_nums ( $dcid ) < 1) {
			domsg ( lang ( 'common_adm:datacall_dcid_fail' ), NULL, $msg_call );
			exit ();
		}
		if (check_num ( $listorder ) < 1) {
			$listorder = 0;
		}
		if (str_len ( $title ) < 1) {
			domsg ( lang ( 'common_adm:datacall_title_null' ), NULL, $msg_call );
			exit ();
		}
		if (check_nums ( $dsid ) < 1) {
			domsg ( lang ( 'common_adm:datacall_dsid_fail' ), NULL, $msg_call );
			exit ();
		}
		/* 检查是否存在 */
		$result = $this->datacall_query ( 'dcid', $dcid );
		if ($result == $this->db->cw) {
			domsg ( lang ( 'common_adm:datacall_exception' ), NULL, $msg_call );
			exit ();
		}
		if (check_is_array ( $result ) < 1) {
			domsg ( lang ( 'common_adm:datacall_dcid_no_exists' ), $msg_call_url, $msg_call_b, $msg_call_param );
			exit ();
		}
		/* 配置数据 */
		$data = (check_is_array ( $data ) == 1) ? en_serialize ( $data ) : $data;
		/* 初始化数据 */
		$data_arr = array (
				'dsid' => $dsid,
				'listorder' => $listorder,
				'title' => $title,
				'values' => $data 
		);
		$result = $this->db->db_update ( $this->table_common_datacall, $data_arr, 'dcid', $dcid );
		unset ( $data_arr );
		if ($result == $this->db->cw) {
			domsg ( lang ( 'common_adm:datacall_exception' ), NULL, $msg_call );
			exit ();
		}
		domsg ( lang ( 'common_adm:datacall_success' ), $msg_call_url, $msg_call_b, $msg_call_param );
		return NULL;
	}
	/* 排序 */
	function datacall_updateorder($dcid, $listorder) {
		/* 回调参数 */
		$msg_call_url = msg_param ();
		$msg_call = msg_func ();
		$msg_call_b = msg_func ( 'msg_call_b' );
		$msg_call_param = msg_callback_param ();
		
		if (check_is_array ( $dcid ) < 1) {
			domsg ( lang ( 'common_adm:datacall_list_dcid_null' ), NULL, $msg_call );
			return NULL;
		}
		for($i = 0; $i < array_number ( $dcid ); $i ++) {
			$dcid [$i] = trim_addslashes ( $dcid [$i] );
			$listorder [$i] = trim_addslashes ( $listorder [$i] );
			
			if (check_nums ( $dcid [$i] ) < 1) {
				domsg ( lang ( 'common_adm:datacall_list_dcid_null' ), $msg_call_url, $msg_call_b );
				return NULL;
			}
			/* 检查是否存在 */
			$rs = $this->datacall_query ( 'dcid', $dcid [$i] );
			if ($rs == $this->db->cw) {
				domsg ( lang ( 'common_adm:datacall_list_exception' ), $msg_call_url, $msg_call_b );
				return NULL;
			}
			if (check_is_array ( $rs ) < 1) {
				continue;
			}
			
			$old_listorder = $rs ['listorder'];
			if (check_nums ( $listorder [$i] ) < 1) {
				$listorder [$i] = $old_listorder;
			}
			$data_arr = array (
					'listorder' => $listorder [$i] 
			);
			/* 更新 */
			$result = $this->db->db_update ( $this->table_common_datacall, $data_arr, 'dcid', $dcid [$i] );
			if ($result == $this->db->cw) {
				domsg ( lang ( 'common_adm:datacall_list_exception' ), $msg_call_url, $msg_call_b );
				return NULL;
			}
		}
		domsg ( lang ( 'common_adm:datacall_success' ), $msg_call_url, $msg_call_b );
		return NULL;
	}
	/* 删除 */
	function datacall_del($dcid) {
		/* 回调参数 */
		$msg_call_url = msg_param ();
		$msg_call = msg_func ();
		$msg_call_b = msg_func ( 'msg_call_b' );
		$msg_call_param = msg_callback_param ();
		
		if (check_is_array ( $dcid ) < 1) {
			domsg ( lang ( 'admin:param_id_null' ), $msg_call_url, $msg_call_b );
			return NULL;
		}
		for($i = 0; $i < array_number ( $dcid ); $i ++) {
			$dcid [$i] = trim_addslashes ( $dcid [$i] );
			if (check_nums ( $dcid [$i] ) < 1) {
				domsg ( lang ( 'admin:param_ids_fail' ), $msg_call_url, $msg_call_b );
				return NULL;
			}
			$result = $this->datacall_query ( 'dcid', $dcid [$i] );
			if ($result == $this->db->cw) {
				domsg ( lang ( 'admin:dbexceptions' ), $msg_call_url, $msg_call_b );
				return NULL;
			}
			if (check_is_array ( $result ) < 1) {
				continue;
			}
			/* 删除 */
			$result = $this->db->db_delete ( $this->table_common_datacall, 'dcid', $dcid [$i] );
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