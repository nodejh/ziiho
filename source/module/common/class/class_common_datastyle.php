<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}

loader ( 'class:class_common_datablock', 'common', true );
class class_common_datastyle extends class_common_datablock {
	
	/* 析构函数 */
	function __construct() {
		parent::__construct ();
	}
	function class_common_datastyle() {
		$this->__construct ();
	}
	
	/* 列表 */
	function datastyle_lists($_module = NULL, $page_size = 20, $page_nums = 7, $page = 1, $orderby = 1) {
		$orderby = order_val ( $orderby );
		$this->db->from ( $this->table_common_datastyle );
		$this->db->where ( $_key, $_val );
		$this->db->where ( 'module', $_module );
		/* 获取总数 */
		$total_num = $this->db->count_num ();
		/* 计算分页 */
		$pg = pagephow ( $total_num, $page_size, $page_nums, $page );
		$this->db->limit ( $pg ['first_count'], $pg ['page_size'] );
		$this->db->order_by ( 'listorder', $orderby );
		$result = $this->db->select ();
		if ($result == $this->db->cw) {
			return $result;
		}
		$result = $this->db->get_list ();
		return array (
				$pg,
				$result 
		);
	}
	/* 添加检查 */
	function datastyle_add_check($module) {
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
		$val = $func ( 'datastyle_set_url', 'add', 'val' );
		/* 跳转 */
		domsg ( lang ( 'common_adm:datacall_success' ), $val, $msg_call_b );
		return NULL;
	}
	/* 添加 */
	function datastyle_add($module, $data = NULL, $paramback = NULL) {
		/* 回调参数 */
		$msg_call_url = msg_param ();
		$msg_call = msg_func ();
		$msg_call_c = msg_func ( 'msg_call_c' );
		$msg_call_param = msg_callback_param ();
		
		/* 获取参数 */
		$listorder = post_param ( 'listorder' );
		$title = post_param ( 'title' );
		$content = post_param ( 'content' );
		/* 检查参数 */
		if (check_num ( $listorder ) < 1) {
			$listorder = 0;
		}
		if (str_len ( $title ) < 1) {
			domsg ( lang ( 'common_adm:datastyle_title_null' ), NULL, $msg_call );
			exit ();
		}
		/* 操作者 */
		$uid = get_user ( 'uid' );
		/* 时间 */
		$ctime = $this->sys_time;
		/* 初始化数据 */
		$data_arr = array (
				'module' => $module,
				'uid' => $uid,
				'listorder' => $listorder,
				'title' => $title,
				'content' => $content,
				'ctime' => $ctime 
		);
		$result = $this->db->db_insert ( $this->table_common_datastyle, $data_arr, true );
		unset ( $data_arr );
		if ($result == $this->db->cw) {
			domsg ( lang ( 'common_adm:datastyle_exception' ), NULL, $msg_call );
			return NULL;
		}
		$paramback = array (
				'msg_id' => $result,
				'msg_dourl' => array_key_val ( 'dourl', $paramback ) 
		);
		domsg ( lang ( 'common_adm:datastyle_success' ), $msg_call_url, $msg_call_c, $paramback );
		return NULL;
	}
	/* 编辑 */
	function datastyle_edit($data = NULL) {
		/* 回调参数 */
		$msg_call_url = msg_param ();
		$msg_call = msg_func ();
		$msg_call_b = msg_func ( 'msg_call_b' );
		$msg_call_param = msg_callback_param ();
		
		/* 获取参数 */
		$dsid = post_param ( 'dsid' );
		$listorder = post_param ( 'listorder' );
		$title = post_param ( 'title' );
		$content = post_param ( 'content' );
		
		/* 检查参数 */
		if (check_nums ( $dsid ) < 1) {
			domsg ( lang ( 'common_adm:datastyle_dsid_fail' ), NULL, $msg_call );
			exit ();
		}
		if (check_num ( $listorder ) < 1) {
			$listorder = 0;
		}
		if (str_len ( $title ) < 1) {
			domsg ( lang ( 'common_adm:datastyle_title_null' ), NULL, $msg_call );
			exit ();
		}
		/* 检查是否存在 */
		$result = $this->datastyle_query ( 'dsid', $dsid );
		if ($result == $this->db->cw) {
			domsg ( lang ( 'common_adm:datastyle_exception' ), NULL, $msg_call );
			exit ();
		}
		if (check_is_array ( $result ) < 1) {
			domsg ( lang ( 'common_adm:datastyle_dsid_no_exists' ), $msg_call_url, $msg_call_b, $msg_call_param );
			exit ();
		}
		/* 初始化数据 */
		$data_arr = array (
				'listorder' => $listorder,
				'title' => $title,
				'content' => $content 
		);
		$result = $this->db->db_update ( $this->table_common_datastyle, $data_arr, 'dsid', $dsid );
		unset ( $data_arr );
		if ($result == $this->db->cw) {
			domsg ( lang ( 'common_adm:datastyle_exception' ), NULL, $msg_call );
			exit ();
		}
		domsg ( lang ( 'common_adm:datastyle_success' ), $msg_call_url, $msg_call_b, $msg_call_param );
		return NULL;
	}
	/* 排序 */
	function datastyle_updateorder($dsid, $listorder) {
		/* 回调参数 */
		$msg_call_url = msg_param ();
		$msg_call = msg_func ();
		$msg_call_b = msg_func ( 'msg_call_b' );
		$msg_call_param = msg_callback_param ();
		
		if (check_is_array ( $dsid ) < 1) {
			domsg ( lang ( 'common_adm:datastyle_list_dsid_null' ), NULL, $msg_call );
			return NULL;
		}
		for($i = 0; $i < array_number ( $dsid ); $i ++) {
			$dsid [$i] = trim_addslashes ( $dsid [$i] );
			$listorder [$i] = trim_addslashes ( $listorder [$i] );
			
			if (check_nums ( $dsid [$i] ) < 1) {
				domsg ( lang ( 'common_adm:datastyle_list_dsid_null' ), $msg_call_url, $msg_call_b );
				return NULL;
			}
			/* 检查是否存在 */
			$rs = $this->datastyle_query ( 'dsid', $dsid [$i] );
			if ($rs == $this->db->cw) {
				domsg ( lang ( 'common_adm:datastyle_list_exception' ), $msg_call_url, $msg_call_b );
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
			$result = $this->db->db_update ( $this->table_common_datastyle, $data_arr, 'dsid', $dsid [$i] );
			if ($result == $this->db->cw) {
				domsg ( lang ( 'common_adm:datastyle_list_exception' ), $msg_call_url, $msg_call_b );
				return NULL;
			}
		}
		domsg ( lang ( 'common_adm:datastyle_success' ), $msg_call_url, $msg_call_b );
		return NULL;
	}
	/* 删除 */
	function datastyle_del($dsid) {
		/* 回调参数 */
		$msg_call_url = msg_param ();
		$msg_call = msg_func ();
		$msg_call_b = msg_func ( 'msg_call_b' );
		$msg_call_param = msg_callback_param ();
		
		if (check_is_array ( $dsid ) < 1) {
			domsg ( lang ( 'admin:param_id_null' ), $msg_call_url, $msg_call_b );
			return NULL;
		}
		for($i = 0; $i < array_number ( $dsid ); $i ++) {
			$dsid [$i] = trim_addslashes ( $dsid [$i] );
			if (check_nums ( $dsid [$i] ) < 1) {
				domsg ( lang ( 'admin:param_ids_fail' ), $msg_call_url, $msg_call_b );
				return NULL;
			}
			$result = $this->datastyle_query ( 'dsid', $dsid [$i] );
			if ($result == $this->db->cw) {
				domsg ( lang ( 'admin:dbexceptions' ), $msg_call_url, $msg_call_b );
				return NULL;
			}
			if (check_is_array ( $result ) < 1) {
				continue;
			}
			/* 删除编译文件 */
			delf ( common_datablock_file ( $dsid [$i] ) );
			/* 删除 */
			$result = $this->db->db_delete ( $this->table_common_datastyle, 'dsid', $dsid [$i] );
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