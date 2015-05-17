<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}
class class_common_sense_type extends class_model {
	public $table_common_sense_type = 'common_sense_type';
	/* 表态动作类 */
	public $sense_obj = NULL;
	
	/* 析构函数 */
	function __construct() {
		parent::__construct ();
	}
	function class_common_sense_type() {
		$this->__construct ();
	}
	
	/* 表态动作类 */
	function set_sense_obj() {
		$this->sense_obj = loader ( 'class:class_common_sense', _M (), true, true );
	}
	/* 组查询 */
	function type_query($_key, $_val = NULL) {
		$this->db->from ( $this->table_common_sense_type );
		$this->db->where ( $_key, $_val );
		$result = $this->db->select ();
		if ($result == $this->db->cw) {
			return $result;
		}
		$result = $this->db->get_one ();
		return $result;
	}
	/* 列表 */
	function type_list($page_size = 20, $page_nums = 7, $page = 1) {
		$orderby = order_val ();
		$this->db->from ( $this->table_common_sense_type );
		/* 获取总数 */
		$total_num = $this->db->count_num ();
		/* 计算分页 */
		$pg = pagephow ( $total_num, $page_size, $page_nums, $page );
		$this->db->order_by ( 'listorder', $orderby );
		$this->db->limit ( $pg ['first_count'], $pg ['page_size'] );
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
	/* 添加类型 */
	function baseadd($listorder, $module, $title) {
		/* 回调参数 */
		$url = msg_param ();
		$callFunc = msg_func ();
		$callFunc_b = msg_func ( 'callFunc_b' );
		
		/* 检查模块类型是否合法 */
		if (check_enl_el ( $module ) < 1) {
			showmsg ( lang ( 'common:sensetype_module_fail' ), NULL, $callFunc );
		}
		if (str_len ( $title ) < 1) {
			showmsg ( lang ( 'common:sensetype_title_null' ), NULL, $callFunc );
		}
		if (check_num ( $listorder ) < 1) {
			$listorder = 0;
		}
		/* 检查类型是否存在 */
		$result = $this->type_query ( 'module', $module );
		if ($result == $this->db->cw) {
			showmsg ( lang ( 'global:dbexception' ), NULL, $callFunc );
		}
		if (check_is_array ( $result ) == 1) {
			showmsg ( lang ( 'common:sensetype_module_exist' ), NULL, $callFunc );
		}
		/* 初始化数据 */
		$data_arr = array (
				'module' => $module,
				'uid' => get_user ( 'uid' ),
				'listorder' => $listorder,
				'title' => $title,
				'ctime' => $this->sys_time 
		);
		$result = $this->db->db_insert ( $this->table_common_sense_type, $data_arr );
		unset ( $data_arr );
		if ($result == $this->db->cw) {
			showmsg ( lang ( 'global:dbexception' ), NULL, $callFunc );
		}
		showmsg ( lang ( 'global:dbsuccess' ), $url, $callFunc_b );
	}
	/* 编辑 */
	function baseedit($sensetypeid, $listorder, $module, $title) {
		/* 回调参数 */
		$url = msg_param ();
		$callFunc = msg_func ();
		$callFunc_b = msg_func ( 'callFunc_b' );
		
		/* 类型id参数 */
		if (check_is_array ( $sensetypeid ) < 1) {
			showmsg ( lang ( 'global:param_ids_null' ), NULL, $callFunc );
		}
		for($i = 0; $i < array_number ( $sensetypeid ); $i ++) {
			$sensetypeid [$i] = trim_addslashes ( $sensetypeid [$i] );
			$listorder [$i] = trim_addslashes ( $listorder [$i] );
			$module [$i] = trim_addslashes ( $module [$i] );
			$title [$i] = trim_addslashes ( $title [$i] );
			/* 类型id参数 */
			if (check_nums ( $sensetypeid [$i] ) < 1) {
				showmsg ( lang ( 'global:param_ids_fail' ), $url, $callFunc_b );
			}
			/* 检查模块类型是否合法 */
			if (check_enl_el ( $module [$i] ) < 1) {
				showmsg ( lang ( 'common:sensetype_modules_fail' ), $url, $callFunc_b );
			}
			/* 名称是否为空 */
			if (str_len ( $title [$i] ) < 1) {
				showmsg ( lang ( 'common:sensetype_titles_null' ), $url, $callFunc_b );
			}
			/* 检查模块类型是否存在 */
			$this->db->from ( $this->table_common_sense_type );
			$this->db->where_more ( 'sensetypeid', $sensetypeid [$i], '!=' );
			$this->db->where ( 'module', $module [$i] );
			$this->db->select ();
			$qm = $this->db->get_one ();
			if ($qm == $this->db->cw) {
				showmsg ( lang ( 'global:dbexceptions' ), $url, $callFunc_b );
			}
			if (check_is_array ( $qm ) == 1) {
				showmsg ( lang ( 'common:sensetype_modules_exist' ), $url, $callFunc_b );
			}
			/* 检查类型是否存在 */
			$result = $this->type_query ( 'sensetypeid', $sensetypeid [$i] );
			if ($result == $this->db->cw) {
				showmsg ( lang ( 'global:dbexceptions' ), $url, $callFunc_b );
			}
			if (check_is_array ( $result ) < 1) {
				continue;
			}
			if (check_num ( $listorder [$i] ) < 1) {
				$listorder [$i] = $result ['listorder'];
			}
			/* 初始化数据 */
			$data_arr = array (
					'module' => $module [$i],
					'listorder' => $listorder [$i],
					'title' => $title [$i] 
			);
			$result = $this->db->db_update ( $this->table_common_sense_type, $data_arr, 'sensetypeid', $sensetypeid [$i] );
			unset ( $data_arr );
			if ($result == $this->db->cw) {
				showmsg ( lang ( 'global:dbexceptions' ), $url, $callFunc_b );
			}
		}
		showmsg ( lang ( 'global:dbsuccess' ), $url, $callFunc_b );
	}
	/* 删除 */
	function del($sensetypeid) {
		/* 回调参数 */
		$url = msg_param ();
		$callFunc = msg_func ();
		$callFunc_b = msg_func ( 'callFunc_b' );
		
		/* 类型id参数 */
		if (check_is_array ( $sensetypeid ) < 1) {
			showmsg ( lang ( 'global:param_ids_null' ), NULL, $callFunc );
		}
		/* 初始化表态动作类 */
		$this->set_sense_obj ();
		
		/* 开始事务 */
		$this->db->trans_begin ();
		
		for($i = 0; $i < array_number ( $sensetypeid ); $i ++) {
			$sensetypeid [$i] = trim_addslashes ( $sensetypeid [$i] );
			/* 类型id参数 */
			if (check_nums ( $sensetypeid [$i] ) < 1) {
				/* 回滚事务 */
				$this->db->trans_rollback_end ();
				showmsg ( lang ( 'global:param_ids_fail' ), $url, $callFunc_b );
			}
			/* 检查类型是否存在 */
			$result = $this->type_query ( 'sensetypeid', $sensetypeid [$i] );
			if ($result == $this->db->cw) {
				/* 回滚事务 */
				$this->db->trans_rollback_end ();
				showmsg ( lang ( 'global:dbexceptions' ), $url, $callFunc_b );
			}
			if (check_is_array ( $result ) < 1) {
				continue;
			}
			/* 统计表态动作 */
			$this->db->from ( $this->sense_obj->table_common_sense );
			$this->db->where ( 'sensetypeid', $sensetypeid [$i] );
			$sense_num = $this->db->count_num ();
			$this->db->select ();
			if ($sense_num == $this->db->cw) {
				/* 回滚事务 */
				$this->db->trans_rollback_end ();
				showmsg ( lang ( 'global:dbexceptions' ), $url, $callFunc_b );
			}
			if (check_nums ( $sense_num ) == 1) {
				$result = $this->db->db_delete ( $this->sense_obj->table_common_sense, 'sensetypeid', $sensetypeid [$i] );
				if ($result == $this->db->cw) {
					/* 回滚事务 */
					$this->db->trans_rollback_end ();
					showmsg ( lang ( 'global:dbexceptions' ), $url, $callFunc_b );
				}
			}
			/* 删除类型 */
			$result = $this->db->db_delete ( $this->table_common_sense_type, 'sensetypeid', $sensetypeid [$i] );
			if ($result == $this->db->cw) {
				/* 回滚事务 */
				$this->db->trans_rollback_end ();
				showmsg ( lang ( 'global:dbexceptions' ), $url, $callFunc_b );
			}
			/* 提交事务 */
			$this->db->trans_commit ();
		}
		/* 结束事务 */
		$this->db->trans_end ();
		showmsg ( lang ( 'global:dbsuccess' ), $url, $callFunc_b );
	}
}
?>