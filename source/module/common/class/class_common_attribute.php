<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}
class class_common_attribute extends class_model {
	public $table_common_attr = 'common_attr';
	
	/* 析构函数 */
	function __construct() {
		parent::__construct ();
	}
	function class_common_attribute() {
		$this->__construct ();
	}
	
	/* 条件查询 */
	function attr_query($_key, $_val = NULL) {
		$this->db->from ( $this->table_common_attr );
		$this->db->where ( $_key, $_val );
		$result = $this->db->select ();
		if ($result == $this->db->cw) {
			return $result;
		}
		$result = $this->db->get_one ();
		return $result;
	}
	/* 列表 */
	function lists($page_size = 50, $page_nums = 7, $page = 1) {
		$orderby = order_val ();
		$this->db->from ( $this->table_common_attr );
		/* 获取总数 */
		$total_num = $this->db->count_num ();
		/* 计算分页 */
		$pg = pagephow ( $total_num, $page_size, $page_nums, $page );
		$this->db->limit ( $pg ['first_count'], $pg ['page_size'] );
		$this->db->order_by ( 'attrid', $orderby );
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
	function baseadd($title) {
		/* 回调参数 */
		$redirecturl = msg_param ();
		$callFunc = msg_func ();
		$callFunc_b = msg_func ( 'callFunc_b' );
		
		if (str_len ( $title ) < 1) {
			showmsg ( lang ( 'common:attr_title_null' ), NULL, $callFunc );
		}
		$data_arr = array (
				'title' => $title,
				'ctime' => $this->sys_time 
		);
		$result = $this->db->db_insert ( $this->table_common_attr, $data_arr );
		if ($result == $this->db->cw) {
			showmsg ( lang ( 'global:dbexception' ), NULL, $callFunc );
		}
		showmsg ( lang ( 'global:dbsuccess' ), $redirecturl, $callFunc_b );
	}
	/* 编辑 */
	function baseedit($attrid, $title) {
		/* 回调参数 */
		$redirecturl = msg_param ();
		$callFunc = msg_func ();
		$callFunc_b = msg_func ( 'callFunc_b' );
		
		if (check_is_array ( $attrid ) < 1) {
			showmsg ( lang ( 'admin:param_id_null' ), NULL, $callFunc );
		}
		for($i = 0; $i < array_number ( $attrid ); $i ++) {
			$attrid [$i] = trim_addslashes ( $attrid [$i] );
			$title [$i] = trim_addslashes ( $title [$i] );
			if (check_nums ( $attrid [$i] ) < 1) {
				showmsg ( lang ( 'global:param_ids_fail' ), $redirecturl, $callFunc_b );
			}
			/* 检查是否存在 */
			$qrs = $this->attr_query ( 'attrid', $attrid [$i] );
			if ($qrs == $this->db->cw) {
				showmsg ( lang ( 'global:dbexceptions' ), $redirecturl, $callFunc_b );
			}
			if (check_is_array ( $qrs ) < 1) {
				continue;
			}
			if (str_len ( $title [$i] ) < 1) {
				$title [$i] = $qrs ['title'];
			}
			/* 编辑 */
			$dataArr = array (
					'title' => $title [$i] 
			);
			$result = $this->db->db_update ( $this->table_common_attr, $dataArr, 'attrid', $attrid [$i] );
			unset ( $dataArr );
			if ($result == $this->db->cw) {
				showmsg ( lang ( 'global:dbexceptions' ), $redirecturl, $callFunc_b );
			}
		}
		showmsg ( lang ( 'global:dbsuccess' ), $redirecturl, $callFunc_b );
	}
	/* 删除 */
	function del($attrid) {
		/* 回调参数 */
		$redirecturl = msg_param ();
		$callFunc = msg_func ();
		$callFunc_b = msg_func ( 'callFunc_b' );
		
		if (check_is_array ( $attrid ) < 1) {
			showmsg ( lang ( 'global:param_id_null' ), NULL, $callFunc );
		}
		for($i = 0; $i < array_number ( $attrid ); $i ++) {
			$attrid [$i] = trim_addslashes ( $attrid [$i] );
			if (check_nums ( $attrid [$i] ) < 1) {
				showmsg ( lang ( 'global:param_ids_fail' ), $redirecturl, $callFunc_b );
			}
			/* 检查是否存在 */
			$result = $this->attr_query ( 'attrid', $attrid [$i] );
			if ($result == $this->db->cw) {
				showmsg ( lang ( 'global:dbexceptions' ), $redirecturl, $callFunc_b );
			}
			if (check_is_array ( $result ) < 1) {
				continue;
			}
			/* 删除标签 */
			$result = $this->db->db_delete ( $this->table_common_attr, 'attrid', $attrid [$i] );
			if ($result == $this->db->cw) {
				showmsg ( lang ( 'global:dbexceptions' ), $redirecturl, $callFunc_b );
			}
		}
		showmsg ( lang ( 'global:dbsuccess' ), $redirecturl, $callFunc_b );
	}
}
?>