<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}
class class_common_showgroup extends class_model {
	public $table_common_showgroup = 'common_showgroup';
	
	/* 析构函数 */
	function __construct() {
		parent::__construct ();
	}
	function class_common_showgroup() {
		$this->__construct ();
	}
	
	/* 展示组查询 */
	function group_query($_key, $_val = NULL) {
		$this->db->from ( $this->table_common_showgroup );
		$this->db->where ( $_key, $_val );
		$result = $this->db->select ();
		if ($result == $this->db->cw) {
			return $result;
		}
		$result = $this->db->get_one ();
		return $result;
	}
	/* 组列表 */
	function group_list($page_size = 20, $page_nums = 7, $page = 1, $orderby = NULL) {
		$this->db->from ( $this->table_common_showgroup );
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
	/* 添加 */
	function baseadd($listorder, $title) {
		/* 回调参数 */
		$url = msg_param ();
		$callFunc = msg_func ();
		$callFunc_b = msg_func ( 'callFunc_b' );
		
		if (str_len ( $title ) < 1) {
			showmsg ( lang ( 'common:showgroup_title_null' ), NULL, $callFunc );
		}
		if (check_nums ( $listorder ) < 1) {
			$listorder = 0;
		}
		/* 初始化数据 */
		$data_arr = array (
				'listorder' => $listorder,
				'title' => $title,
				'ctime' => $this->sys_time 
		);
		$result = $this->db->db_insert ( $this->table_common_showgroup, $data_arr );
		unset ( $data_arr );
		if ($result == $this->db->cw) {
			showmsg ( lang ( 'global:dbexception' ), NULL, $callFunc );
		}
		showmsg ( lang ( 'global:dbsuccess' ), $url, $callFunc_b );
	}
	/* 更新 */
	function baseedit($cgroupid, $listorder, $title) {
		/* 回调参数 */
		$url = msg_param ();
		$callFunc = msg_func ();
		$callFunc_b = msg_func ( 'callFunc_b' );
		
		if (check_is_array ( $cgroupid ) < 1) {
			showmsg ( lang ( 'global:param_id_null' ), NULL, $callFunc );
		}
		for($i = 0; $i < array_number ( $cgroupid ); $i ++) {
			$cgroupid [$i] = trim_addslashes ( $cgroupid [$i] );
			$listorder [$i] = trim_addslashes ( $listorder [$i] );
			$title [$i] = trim_addslashes ( $title [$i] );
			if (check_nums ( $cgroupid [$i] ) < 1) {
				showmsg ( lang ( 'global:param_ids_fail' ), $url, $callFunc_b );
			}
			/* 检查是否存在 */
			$qrs = $this->group_query ( 'cgroupid', $cgroupid [$i] );
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
			/* 初始化数据,更新 */
			$dataArr = array (
					'listorder' => $listorder [$i],
					'title' => $title [$i] 
			);
			$result = $this->db->db_update ( $this->table_common_showgroup, $dataArr, 'cgroupid', $cgroupid [$i] );
			unset ( $dataArr );
			if ($result == $this->db->cw) {
				showmsg ( lang ( 'global:dbexceptions' ), $url, $callFunc_b );
			}
		}
		showmsg ( lang ( 'global:dbsuccess' ), $url, $callFunc_b );
	}
	/* 删除 */
	function del($cgroupid) {
		/* 回调参数 */
		$url = msg_param ();
		$callFunc = msg_func ();
		$callFunc_b = msg_func ( 'callFunc_b' );
		
		if (check_is_array ( $cgroupid ) < 1) {
			showmsg ( lang ( 'global:param_id_null' ), NULL, $callFunc );
		}
		for($i = 0; $i < array_number ( $cgroupid ); $i ++) {
			$cgroupid [$i] = trim_addslashes ( $cgroupid [$i] );
			if (check_nums ( $cgroupid [$i] ) < 1) {
				showmsg ( lang ( 'global:param_ids_fail' ), $url, $callFunc_b );
			}
			/* 检查是否存在 */
			$result = $this->group_query ( 'cgroupid', $cgroupid [$i] );
			if ($result == $this->db->cw) {
				showmsg ( lang ( 'global:dbexceptions' ), $url, $callFunc_b );
			}
			if (check_is_array ( $result ) < 1) {
				continue;
			}
			/* 删除 */
			$result = $this->db->db_delete ( $this->table_common_showgroup, 'cgroupid', $cgroupid [$i] );
			if ($result == $this->db->cw) {
				showmsg ( lang ( 'global:dbexceptions' ), $url, $callFunc_b );
			}
		}
		showmsg ( lang ( 'global:dbsuccess' ), $url, $callFunc_b );
	}
}
?>