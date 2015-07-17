<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}
class class_common_emotional_group extends class_model {
	public $table_common_emotional_group = 'common_emotional_group';
	
	/* 析构函数 */
	function __construct() {
		parent::__construct ();
	}
	function class_common_emotional_group() {
		$this->__construct ();
	}
	
	/* 组查询 */
	function group_query($_key, $_val = NULL) {
		$this->db->from ( $this->table_common_emotional_group );
		$this->db->where ( $_key, $_val );
		$result = $this->db->select ();
		if ($result == $this->db->cw) {
			return $result;
		}
		$result = $this->db->get_one ();
		return $result;
	}
	/* 列表 */
	function group_list($page_size = 20, $page_nums = 7, $page = 1) {
		$orderby = order_val ();
		$this->db->from ( $this->table_common_emotional_group );
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
	/* 添加分组 */
	function baseadd($listorder, $title) {
		/* 回调参数 */
		$url = msg_param ();
		$callFunc = msg_func ();
		$callFunc_b = msg_func ( 'callFunc_b' );
		
		if (str_len ( $title ) < 1) {
			showmsg ( lang ( 'common:emotionalgroup_title_null' ), NULL, $callFunc );
		}
		if (check_num ( $listorder ) < 1) {
			$listorder = 0;
		}
		/* 初始化数据 */
		$data_arr = array (
				'uid' => get_user ( 'uid' ),
				'listorder' => $listorder,
				'title' => $title,
				'ctime' => $this->sys_time 
		);
		$result = $this->db->db_insert ( $this->table_common_emotional_group, $data_arr );
		if ($result == $this->db->cw) {
			showmsg ( lang ( 'global:dbexception' ), NULL, $callFunc );
		}
		showmsg ( lang ( 'global:dbsuccess' ), $url, $callFunc_b );
	}
	/* 编辑 */
	function baseedit($emotgroupid, $listorder, $title) {
		/* 回调参数 */
		$url = msg_param ();
		$callFunc = msg_func ();
		$callFunc_b = msg_func ( 'callFunc_b' );
		
		/* 组id参数 */
		if (check_is_array ( $emotgroupid ) < 1) {
			showmsg ( lang ( 'global:param_ids_null' ), NULL, $callFunc );
		}
		for($i = 0; $i < array_number ( $emotgroupid ); $i ++) {
			$emotgroupid [$i] = trim_addslashes ( $emotgroupid [$i] );
			$listorder [$i] = trim_addslashes ( $listorder [$i] );
			$title [$i] = trim_addslashes ( $title [$i] );
			/* 组id参数 */
			if (check_nums ( $emotgroupid [$i] ) < 1) {
				showmsg ( lang ( 'global:param_ids_fail' ), $url, $callFunc_b );
			}
			/* 名称是否为空 */
			if (str_len ( $title [$i] ) < 1) {
				showmsg ( lang ( 'global:emotionalgroup_titles_null' ), $url, $callFunc_b );
			}
			/* 检查组是否存在 */
			$result = $this->group_query ( 'emotgroupid', $emotgroupid [$i] );
			if ($result == $this->db->cw) {
				showmsg ( lang ( 'global:dbexceptions' ), $url, $callFunc_b );
			}
			if (check_is_array ( $result ) < 1) {
			}
			if (check_num ( $listorder [$i] ) < 1) {
				$listorder [$i] = $result ['listorder'];
			}
			/* 初始化数据 */
			$data_arr = array (
					'listorder' => $listorder [$i],
					'title' => $title [$i] 
			);
			$result = $this->db->db_update ( $this->table_common_emotional_group, $data_arr, 'emotgroupid', $emotgroupid [$i] );
			if ($result == $this->db->cw) {
				showmsg ( lang ( 'global:dbexceptions' ), $url, $callFunc_b );
			}
		}
		showmsg ( lang ( 'global:dbsuccess' ), $url, $callFunc_b );
	}
	/* 删除 */
	function del($emotgroupid) {
		/* 回调参数 */
		$url = msg_param ();
		$callFunc = msg_func ();
		$callFunc_b = msg_func ( 'callFunc_b' );
		
		/* 组id参数 */
		if (check_is_array ( $emotgroupid ) < 1) {
			showmsg ( lang ( 'global:param_ids_null' ), NULL, $callFunc );
		}
		for($i = 0; $i < array_number ( $emotgroupid ); $i ++) {
			$emotgroupid [$i] = trim_addslashes ( $emotgroupid [$i] );
			/* 组id参数 */
			if (check_nums ( $emotgroupid [$i] ) < 1) {
				showmsg ( lang ( 'global:param_ids_fail' ), $url, $callFunc_b );
			}
			/* 检查组是否存在 */
			$result = $this->group_query ( 'emotgroupid', $emotgroupid [$i] );
			if ($result == $this->db->cw) {
				showmsg ( lang ( 'global:dbexceptions' ), $url, $callFunc_b );
			}
			if (check_is_array ( $result ) < 1) {
				continue;
			}
			$result = $this->db->db_delete ( $this->table_common_emotional_group, 'emotgroupid', $emotgroupid [$i] );
			if ($result == $this->db->cw) {
				showmsg ( lang ( 'global:dbexceptions' ), $url, $callFunc_b );
			}
		}
		showmsg ( lang ( 'global:dbsuccess' ), $url, $callFunc_b );
	}
}
?>