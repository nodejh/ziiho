<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}

loader ( 'class:class_common_template', 'common', true );
class class_common_template_admin extends class_common_template {
	
	/* 析构函数 */
	function __construct() {
		parent::__construct ();
	}
	function class_common_template_admin() {
		$this->__construct ();
	}
	
	/* 模板添加 */
	function baseadd($listorder, $title, $path, $description, $disabled) {
		/* 回调参数 */
		$redirectUrl = msg_param ();
		$callFunc = msg_func ();
		$callFunc_b = msg_func ( 'callFunc_b' );
		
		if (str_len ( $title ) < 1) {
			showmsg ( lang ( 'common:template_add_title_null' ), NULL, $callFunc );
		}
		if (check_en ( $path ) < 1) {
			showmsg ( lang ( 'common:template_add_path_fail' ), NULL, $callFunc );
		}
		if (check_num ( $listorder ) < 1) {
			$listorder = 0;
		}
		if (check_num ( $disabled ) < 1) {
			$disabled = yesno_val ( 'check' );
		}
		/* 初始化数据 */
		$data_arr = array (
				'listorder' => $listorder,
				'title' => $title,
				'path' => $path,
				'description' => $description,
				'disabled' => $disabled,
				'ctime' => $this->sys_time 
		);
		$result = $this->db->db_insert ( $this->table_common_template, $data_arr );
		unset ( $data_arr );
		if ($result == $this->db->cw) {
			showmsg ( lang ( 'global:dbexception' ), NULL, $callFunc );
		}
		showmsg ( lang ( 'global:dbsuccess' ), $redirectUrl, $callFunc_b );
	}
	/* 模板编辑 */
	function baseedit($templateid, $listorder, $title, $path, $description, $disabled) {
		/* 回调参数 */
		$redirectUrl = msg_param ();
		$callFunc = msg_func ();
		$callFunc_b = msg_func ( 'callFunc_b' );
		
		if (check_is_array ( $templateid ) < 1) {
			showmsg ( lang ( 'global:param_ids_null' ), NULL, $callFunc );
		}
		for($i = 0; $i < array_number ( $templateid ); $i ++) {
			$templateid [$i] = trim_addslashes ( $templateid [$i] );
			$listorder [$i] = trim_addslashes ( $listorder [$i] );
			$title [$i] = trim_addslashes ( $title [$i] );
			$path [$i] = trim_addslashes ( $path [$i] );
			$description [$i] = trim_addslashes ( $description [$i] );
			$disabled [$i] = (check_num ( $disabled [$i] ) < 1) ? 0 : $disabled [$i];
			if (check_num ( $templateid [$i] ) < 1) {
				showmsg ( lang ( 'global:param_ids_fail' ), $redirectUrl, $callFunc_b );
			}
			/* 检查是否存在 */
			$qrs = $this->template_query ( 'templateid', $templateid [$i] );
			if ($qrs == $this->db->cw) {
				showmsg ( lang ( 'global:dbexceptions' ), $redirectUrl, $callFunc_b );
			}
			if (check_is_array ( $qrs ) < 1) {
				continue;
			}
			if (str_len ( $title [$i] ) < 1) {
				$title [$i] = $qrs ['title'];
			}
			if (check_en ( $path [$i] ) < 1) {
				$path [$i] = $qrs ['path'];
			}
			if (check_num ( $listorder [$i] ) < 1) {
				$listorder [$i] = $qrs ['listorder'];
			}
			if (check_num ( $disabled [$i] ) < 1) {
				$disabled [$i] = $qrs ['disabled'];
			}
			$data_arr = array (
					'listorder' => $listorder [$i],
					'title' => $title [$i],
					'path' => $path [$i],
					'description' => $description [$i],
					'disabled' => $disabled [$i] 
			);
			$result = $this->db->db_update ( $this->table_common_template, $data_arr, 'templateid', $templateid [$i] );
			unset ( $data_arr );
			if ($result == $this->db->cw) {
				showmsg ( lang ( 'global:dbexceptions' ), $redirectUrl, $callFunc_b );
			}
		}
		showmsg ( lang ( 'global:dbsuccess' ), $redirectUrl, $callFunc_b );
	}
	/* 模板删除 */
	function del($templateid) {
		/* 回调参数 */
		$redirectUrl = msg_param ();
		$callFunc = msg_func ();
		$callFunc_b = msg_func ( 'callFunc_b' );
		
		if (check_is_array ( $templateid ) < 1) {
			showmsg ( lang ( 'global:param_ids_null' ), NULL, $callFunc );
		}
		for($i = 0; $i < array_number ( $templateid ); $i ++) {
			if (check_nums ( $templateid [$i] ) < 1) {
				showmsg ( lang ( 'global:param_ids_fail' ), $redirectUrl, $callFunc_b );
			}
			/* 检查是否存在 */
			$qrs = $this->template_query ( 'templateid', $templateid [$i] );
			if ($qrs == $this->db->cw) {
				showmsg ( lang ( 'global:dbexceptions' ), $redirectUrl, $callFunc_b );
			}
			if (check_is_array ( $qrs ) < 1) {
				continue;
			}
			$result = $this->db->db_delete ( $this->table_common_template, 'templateid', $templateid [$i] );
			if ($result == $this->db->cw) {
				showmsg ( lang ( 'global:dbexceptions' ), $redirectUrl, $callFunc_b );
			}
		}
		showmsg ( lang ( 'global:dbsuccess' ), $redirectUrl, $callFunc_b );
	}
}
?>