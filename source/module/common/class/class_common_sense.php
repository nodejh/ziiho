<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}
class class_common_sense extends class_model {
	public $table_common_sense = 'common_sense';
	/* 类型类 */
	public $sense_type_obj = NULL;
	
	/* 析构函数 */
	function __construct() {
		parent::__construct ();
	}
	function class_common_sense() {
		$this->__construct ();
	}
	
	/* 类型类 */
	function set_sense_type_obj() {
		$this->sense_type_obj = loader ( 'class:class_common_sense_type', _M (), true, true );
	}
	/* 表情查询 */
	function sense_query($_key, $_val = NULL) {
		$this->db->from ( $this->table_common_sense );
		$this->db->where ( $_key, $_val );
		$result = $this->db->select ();
		if ($result == $this->db->cw) {
			return $result;
		}
		$result = $this->db->get_one ();
		return $result;
	}
	/* 添加 */
	function baseadd($sensetypeid, $listorder, $title, $filename, $disabled) {
		/* 回调参数 */
		$callFunc = msg_func ();
		$callFunc_b = msg_func ( 'callFunc_b' );
		/* 检查类型 */
		if (check_nums ( $sensetypeid ) < 1) {
			showmsg ( lang ( 'common:sense_sensetypeid_fail' ), NULL, $callFunc );
		}
		if (str_len ( $title ) < 1) {
			showmsg ( lang ( 'common:sense_title_null' ), NULL, $callFunc );
		}
		if (str_len ( $filename ) < 1) {
			showmsg ( lang ( 'common:sense_filename_null' ), NULL, $callFunc );
		}
		if (check_num ( $listorder ) < 1) {
			$listorder = 0;
		}
		if (check_num ( $disabled ) < 1) {
			$disabled = yesno_val ( 'check' );
		}
		/* 初始化类型类 */
		$this->set_sense_type_obj ();
		/* 检查类型是否存在 */
		$sensetype = $this->sense_type_obj->type_query ( 'sensetypeid', $sensetypeid );
		if ($sensetype == $this->db->cw) {
			showmsg ( lang ( 'global:dbexception' ), NULL, $callFunc );
		}
		if (check_is_array ( $sensetype ) < 1) {
			showmsg ( lang ( 'common:sense_sensetypeid_noexist' ), NULL, $callFunc );
		}
		/* 获取允许添加个数 */
		$cf_num = common_value_get ( 'sense_num', 'num' );
		$this->db->from ( $this->table_common_sense );
		$this->db->where ( 'sensetypeid', $sensetypeid );
		$result = $this->db->count_num ();
		$this->db->clear_sql ();
		if ($result == $this->db->cw) {
			showmsg ( lang ( 'global:dbexception' ), NULL, $callFunc );
		}
		if ($result >= $cf_num) {
			showmsg ( lang ( 'common:sense_num_message', $cf_num ), NULL, $callFunc );
		}
		
		/* uid */
		$uid = get_user ( 'uid' );
		/* 初始化数据 */
		$data_arr = array (
				'uid' => $uid,
				'sensetypeid' => $sensetypeid,
				'listorder' => $listorder,
				'title' => $title,
				'filename' => $filename,
				'ctime' => $this->sys_time,
				'disabled' => $disabled 
		);
		$result = $this->db->db_insert ( $this->table_common_sense, $data_arr );
		if ($result == $this->db->cw) {
			showmsg ( lang ( 'global:dbexception' ), NULL, $callFunc );
		}
		/* 返回url */
		$url = url ( 'index', 'mod/common/ac/admin/op/sense/ao/sense/bo/sense/sensetypeid/' . $sensetypeid );
		showmsg ( lang ( 'global:dbsuccess' ), $url, $callFunc_b );
	}
	/* 编辑 */
	function baseedit($senseid, $listorder, $title, $filename, $disabled) {
		/* 回调参数 */
		$url = msg_param ();
		$callFunc = msg_func ();
		$callFunc_b = msg_func ( 'callFunc_b' );
		
		/* 表情参数 */
		if (check_is_array ( $senseid ) < 1) {
			showmsg ( lang ( 'global:param_ids_null' ), NULL, $callFunc );
		}
		for($i = 0; $i < array_number ( $senseid ); $i ++) {
			$senseid [$i] = trim_addslashes ( $senseid [$i] );
			$listorder [$i] = trim_addslashes ( $listorder [$i] );
			$title [$i] = trim_addslashes ( $title [$i] );
			$filename [$i] = trim_addslashes ( $filename [$i] );
			$disabled [$i] = trim_addslashes ( $disabled [$i] );
			/* 参数 */
			if (check_nums ( $senseid [$i] ) < 1) {
				showmsg ( lang ( 'global:param_ids_fail' ), $url, $callFunc_b );
			}
			/* 检查是否存在 */
			$result = $this->sense_query ( 'senseid', $senseid [$i] );
			if ($result == $this->db->cw) {
				showmsg ( lang ( 'global:dbexceptions' ), $url, $callFunc_b );
			}
			if (check_is_array ( $result ) < 1) {
				continue;
			}
			if (check_num ( $listorder [$i] ) < 1) {
				$listorder [$i] = $result ['listorder'];
			}
			if (str_len ( $title [$i] ) < 1) {
				$title [$i] = $result ['title'];
			}
			if (str_len ( $filename [$i] ) < 1) {
				$filename [$i] = $result ['filename'];
			}
			if (check_num ( $disabled [$i] ) < 1) {
				$disabled [$i] = $result ['disabled'];
			}
			/* 初始化数据 */
			$data_arr = array (
					'listorder' => $listorder [$i],
					'title' => $title [$i],
					'filename' => $filename [$i],
					'disabled' => $disabled [$i] 
			);
			$result = $this->db->db_update ( $this->table_common_sense, $data_arr, 'senseid', $senseid [$i] );
			if ($result == $this->db->cw) {
				showmsg ( lang ( 'global:dbexceptions' ), $url, $callFunc_b );
			}
		}
		showmsg ( lang ( 'global:dbsuccess' ), $url, $callFunc_b );
	}
	/* 删除 */
	function del($senseid) {
		/* 回调参数 */
		$url = msg_param ();
		$callFunc = msg_func ();
		$callFunc_b = msg_func ( 'callFunc_b' );
		
		/* id参数 */
		if (check_is_array ( $senseid ) < 1) {
			showmsg ( lang ( 'global:param_ids_null' ), NULL, $callFunc );
		}
		for($i = 0; $i < array_number ( $senseid ); $i ++) {
			$senseid [$i] = trim_addslashes ( $senseid [$i] );
			/* id参数 */
			if (check_nums ( $senseid [$i] ) < 1) {
				showmsg ( lang ( 'global:param_ids_fail' ), $url, $callFunc_b );
			}
			/* 检查是否存在 */
			$result = $this->sense_query ( 'senseid', $senseid [$i] );
			if ($result == $this->db->cw) {
				showmsg ( lang ( 'global:dbexceptions' ), $url, $callFunc_b );
			}
			if (check_is_array ( $result ) < 1) {
				continue;
			}
			/* 删除记录 */
			$result = $this->db->db_delete ( $this->table_common_sense, 'senseid', $senseid [$i] );
			if ($result == $this->db->cw) {
				showmsg ( lang ( 'global:dbexceptions' ), $url, $callFunc_b );
			}
		}
		showmsg ( lang ( 'global:dbsuccess' ), $url, $callFunc_b );
	}
}
?>