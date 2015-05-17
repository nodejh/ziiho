<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}
class class_common_badword_filter extends class_model {
	public $table_common_badword_filter = 'common_badword_filter';
	
	/* 析构函数 */
	function __construct() {
		parent::__construct ();
	}
	function class_common_badword_filter() {
		$this->__construct ();
	}
	
	/* 敏感词查询 */
	function filter_query($_key, $_val = NULL) {
		$this->db->from ( $this->table_common_badword_filter );
		$this->db->where ( $_key, $_val );
		$result = $this->db->select ();
		if ($result == $this->db->cw) {
			return $result;
		}
		$result = $this->db->get_one ();
		return $result;
	}
	/* 添加 */
	function baseadd($listorder, $badword, $filterword) {
		/* 回调参数 */
		$url = msg_param ();
		$callFunc = msg_func ();
		$callFunc_b = msg_func ( 'callFunc_b' );
		
		if (str_len ( $badword ) < 1) {
			showmsg ( lang ( 'common:wordfilter_badword_null' ), NULL, $callFunc );
		}
		if (check_nums ( $listorder ) < 1) {
			$listorder = 0;
		}
		/* 初始化数据 */
		$data_arr = array (
				'listorder' => $listorder,
				'badword' => $badword,
				'filterword' => $filterword,
				'ctime' => $this->sys_time 
		);
		$result = $this->db->db_insert ( $this->table_common_badword_filter, $data_arr );
		unset ( $data_arr );
		if ($result == $this->db->cw) {
			showmsg ( lang ( 'global:dbexception' ), NULL, $callFunc );
		}
		showmsg ( lang ( 'global:dbsuccess' ), $url, $callFunc_b );
	}
	/* 更新 */
	function baseedit($cwordid, $listorder, $badword, $filterword) {
		/* 回调参数 */
		$url = msg_param ();
		$callFunc = msg_func ();
		$callFunc_b = msg_func ( 'callFunc_b' );
		
		if (check_is_array ( $cwordid ) < 1) {
			showmsg ( lang ( 'global:param_id_null' ), NULL, $callFunc );
		}
		for($i = 0; $i < array_number ( $cwordid ); $i ++) {
			$cwordid [$i] = trim_addslashes ( $cwordid [$i] );
			$listorder [$i] = trim_addslashes ( $listorder [$i] );
			$badword [$i] = trim_addslashes ( $badword [$i] );
			$filterword [$i] = trim_addslashes ( $filterword [$i] );
			if (check_nums ( $cwordid [$i] ) < 1) {
				showmsg ( lang ( 'global:param_ids_fail' ), $url, $callFunc_b );
			}
			/* 检查是否存在 */
			$qrs = $this->filter_query ( 'cwordid', $cwordid [$i] );
			if ($qrs == $this->db->cw) {
				showmsg ( lang ( 'global:dbexceptions' ), $url, $callFunc_b );
			}
			if (check_is_array ( $qrs ) < 1) {
				continue;
			}
			if (check_num ( $listorder [$i] ) < 1) {
				$listorder [$i] = $qrs ['listorder'];
			}
			if (str_len ( $badword [$i] ) < 1) {
				$badword [$i] = $qrs ['badword'];
			}
			/* 初始化数据 */
			$data_arr = array (
					'listorder' => $listorder [$i],
					'badword' => $badword [$i],
					'filterword' => $filterword [$i] 
			);
			$result = $this->db->db_update ( $this->table_common_badword_filter, $data_arr, 'cwordid', $cwordid [$i] );
			unset ( $data_arr );
			if ($result == $this->db->cw) {
				showmsg ( lang ( 'global:dbexceptions' ), $url, $callFunc_b );
			}
		}
		showmsg ( lang ( 'global:dbsuccess' ), $url, $callFunc_b );
	}
	/* 删除 */
	function del($cwordid) {
		/* 回调参数 */
		$url = msg_param ();
		$callFunc = msg_func ();
		$callFunc_b = msg_func ( 'callFunc_b' );
		
		if (check_is_array ( $cwordid ) < 1) {
			showmsg ( lang ( 'global:param_id_null' ), NULL, $callFunc );
		}
		for($i = 0; $i < array_number ( $cwordid ); $i ++) {
			$cwordid [$i] = trim_addslashes ( $cwordid [$i] );
			if (check_nums ( $cwordid [$i] ) < 1) {
				showmsg ( lang ( 'global:param_ids_fail' ), $url, $callFunc_b );
			}
			/* 检查是否存在 */
			$result = $this->filter_query ( 'cwordid', $cwordid [$i] );
			if ($result == $this->db->cw) {
				showmsg ( lang ( 'global:dbexceptions' ), $url, $callFunc_b );
			}
			if (check_is_array ( $result ) < 1) {
				continue;
			}
			/* 删除 */
			$result = $this->db->db_delete ( $this->table_common_badword_filter, 'cwordid', $cwordid [$i] );
			if ($result == $this->db->cw) {
				showmsg ( lang ( 'global:dbexceptions' ), $url, $callFunc_b );
			}
		}
		showmsg ( lang ( 'global:dbsuccess' ), $url, $callFunc_b );
	}
}
?>