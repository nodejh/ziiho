<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}

loader ( 'class:class_member_area', 'member', true );
class class_member_area_admin extends class_member_area {
	
	/* 析构函数 */
	function __construct() {
		parent::__construct ();
	}
	function class_member_area_admin() {
		$this->__construct ();
	}
	
	/* 简单添加 */
	function baseadd($aid, $listorder, $title) {
		/* 回调参数 */
		$url = msg_param ();
		$callFunc = msg_func ();
		$callFunc_b = msg_func ( 'callFunc_b' );
		
		if (check_num ( $aid ) < 1) {
			showmsg ( lang ( 'member_adm:area_parent_fail' ), NULL, $callFunc );
		}
		if (str_len ( $title ) < 1) {
			showmsg ( lang ( 'member_adm:area_title_null' ), NULL, $callFunc );
		}
		if (check_num ( $listorder ) < 1) {
			$listorder = 0;
		}
		/* 如果选择了地区,则检查是否存在 */
		if (check_nums ( $aid ) == 1) {
			$ars = $this->area_query ( 'aid', $aid );
			if ($ars == $this->db->cw) {
				showmsg ( lang ( 'admin:dbexception' ), NULL, $callFunc );
			}
			if (check_is_array ( $ars ) < 1) {
				showmsg ( lang ( 'member_adm:area_parent_notexist' ), NULL, $callFunc );
			}
			unset ( $ars );
		}
		/* 初始化数据 */
		$data_arr = array (
				'aids' => $aid,
				'listorder' => $listorder,
				'title' => $title,
				'ctime' => $this->sys_time 
		);
		$this->db->from ( $this->table_member_area );
		$this->db->set ( $data_arr );
		unset ( $data_arr );
		$area_result = $this->db->insert ();
		if ($area_result == $this->db->cw) {
			showmsg ( lang ( 'admin:dbexception' ), NULL, $callFunc );
		}
		$this->area_write ();
		$url = url ( 'index', 'mod/member/ac/admin/op/area/ao/area/aid/' . $aid );
		showmsg ( lang ( 'admin:dbsuccess' ), $url, $callFunc_b );
	}
	/* 简单编辑 */
	function baseedit($aid, $listorder, $title) {
		/* 回调参数 */
		$url = msg_param ();
		$callFunc = msg_func ();
		$callFunc_b = msg_func ( 'callFunc_b' );
		
		if (check_is_array ( $aid ) < 1) {
			showmsg ( lang ( 'admin:param_ids_null' ), NULL, $callFunc );
		}
		for($i = 0; $i < array_number ( $aid ); $i ++) {
			$aid [$i] = trim_addslashes ( $aid [$i] );
			$listorder [$i] = trim_addslashes ( $listorder [$i] );
			$title [$i] = trim_addslashes ( $title [$i] );
			if (check_nums ( $aid [$i] ) < 1) {
				showmsg ( lang ( 'admin:param_ids_fail' ), $url, $callFunc_b );
			}
			/* 查询是否存在 */
			$ars = $this->area_query ( 'aid', $aid [$i] );
			if ($ars == $this->db->cw) {
				showmsg ( lang ( 'admin:dbexceptions' ), $url, $callFunc_b );
			}
			if (check_is_array ( $ars ) < 1) {
				continue;
			}
			if (str_len ( $title [$i] ) < 1) {
				$title [$i] = $ars ['title'];
			}
			if (check_num ( $listorder [$i] ) < 1) {
				$listorder [$i] = $ars ['listorder'];
			}
			unset ( $ars );
			
			/* 初始化数据 */
			$data_arr = array (
					'listorder' => $listorder [$i],
					'title' => $title [$i] 
			);
			$this->db->from ( $this->table_member_area );
			$this->db->where ( 'aid', $aid [$i] );
			$this->db->set ( $data_arr );
			unset ( $data_arr );
			$area_result = $this->db->update ();
			if ($area_result == $this->db->cw) {
				showmsg ( lang ( 'admin:dbexceptions' ), $url, $callFunc_b );
			}
		}
		$this->area_write ();
		showmsg ( lang ( 'admin:dbsuccess' ), $url, $callFunc_b );
	}
	/* 添加设置 */
	function addset($listorder, $title, $aids) {
		/* 回调参数 */
		$url = msg_param ();
		$callFunc = msg_func ();
		$callFunc_b = msg_func ( 'callFunc_b' );
		
		if (str_len ( $title ) < 1) {
			showmsg ( lang ( 'member_adm:area_title_null' ), NULL, $callFunc );
		}
		if (check_num ( $aids ) < 1) {
			showmsg ( lang ( 'member_adm:area_parent_fail' ), NULL, $callFunc );
		}
		if (check_num ( $listorder ) < 1) {
			$listorder = 0;
		}
		/* 如果选择了地区,则检查是否存在 */
		if (check_nums ( $aids ) == 1) {
			$ars = $this->area_query ( 'aid', $aids );
			if ($ars == $this->db->cw) {
				showmsg ( lang ( 'admin:dbexception' ), NULL, $callFunc );
			}
			if (check_is_array ( $ars ) < 1) {
				showmsg ( lang ( 'member_adm:area_parent_notexist' ), NULL, $callFunc );
			}
		}
		/* 初始化数据 */
		$data_arr = array (
				'aids' => $aids,
				'listorder' => $listorder,
				'title' => $title,
				'ctime' => $this->sys_time 
		);
		$result = $this->db->db_insert ( $this->table_member_area, $data_arr );
		unset ( $data_arr );
		if ($result == $this->db->cw) {
			showmsg ( lang ( 'admin:dbexception' ), NULL, $callFunc );
		}
		$this->area_write ();
		$url = url ( 'index', 'mod/member/ac/admin/op/area/ao/area/aid/' . $aids );
		showmsg ( lang ( 'admin:dbsuccess' ), $url, $callFunc_b );
	}
	/* 编辑设置 */
	function editset($aid, $listorder, $title, $aids) {
		/* 回调参数 */
		$url = msg_param ();
		$callFunc = msg_func ();
		$callFunc_b = msg_func ( 'callFunc_b' );
		
		if (check_nums ( $aid ) < 1) {
			showmsg ( lang ( 'member_adm:area_aid_fail' ), NULL, $callFunc );
		}
		if (str_len ( $title ) < 1) {
			showmsg ( lang ( 'member_adm:area_title_null' ), NULL, $callFunc );
		}
		if (check_num ( $aids ) < 1) {
			showmsg ( lang ( 'member_adm:area_parent_fail' ), NULL, $callFunc );
		}
		/* 检查是否存在 */
		$ars = $this->area_query ( 'aid', $aid );
		if ($ars == $this->db->cw) {
			showmsg ( lang ( 'admin:dbexception' ), NULL, $callFunc );
		}
		if (check_is_array ( $ars ) < 1) {
			showmsg ( lang ( 'member_adm:area_aid_notexist' ), $url, $callFunc_b );
		}
		if (check_num ( $listorder ) < 1) {
			$listorder = $ars ['listorder'];
		}
		unset ( $ars );
		
		/* 检查选择的分类是否存在 */
		if ($aid != $aids) {
			if (check_nums ( $aids ) == 1) {
				$ars = $this->area_query ( 'aid', $aids );
				if ($ars == $this->db->cw) {
					showmsg ( lang ( 'admin:dbexception' ), NULL, $callFunc );
				}
				if (check_is_array ( $ars ) < 1) {
					showmsg ( lang ( 'member_adm:area_parent_notexist' ), NULL, $callFunc );
				}
				unset ( $ars );
			}
		}
		/* 初始化数据 */
		$data_arr = array (
				'aids' => $aids,
				'listorder' => $listorder,
				'title' => $title 
		);
		if ($aid == $aids) {
			unset ( $data_arr ['aids'] );
		}
		$result = $this->db->db_update ( $this->table_member_area, $data_arr, 'aid', $aid );
		unset ( $data_arr );
		if ($result == $this->db->cw) {
			showmsg ( lang ( 'admin:dbexception' ), NULL, $callFunc );
		}
		$this->area_write ();
		showmsg ( lang ( 'admin:dbsuccess' ), $url, $callFunc_b );
	}
	/* 删除 */
	function del($aid) {
		/* 回调参数 */
		$url = msg_param ();
		$callFunc = msg_func ();
		$callFunc_b = msg_func ( 'callFunc_b' );
		
		if (check_is_array ( $aid ) < 1) {
			showmsg ( lang ( 'admin:param_ids_null' ), NULL, $callFunc );
		}
		for($i = 0; $i < array_number ( $aid ); $i ++) {
			$aid [$i] = trim_addslashes ( $aid [$i] );
			if (check_nums ( $aid [$i] ) < 1) {
				showmsg ( lang ( 'admin:param_ids_fail' ), $url, $callFunc_b );
			}
			/* 查询是否存在 */
			$ars = $this->area_query ( 'aid', $aid [$i] );
			if ($ars == $this->db->cw) {
				showmsg ( lang ( 'admin:dbexceptions' ), $url, $callFunc_b );
			}
			if (check_is_array ( $ars ) < 1) {
				continue;
			}
			unset ( $ars );
			
			/* 获取子id */
			$str_aid = $this->area_child_id ( $aid [$i] );
			if ($str_aid == $this->db->cw) {
				showmsg ( lang ( 'admin:dbexceptions' ), $url, $callFunc_b );
			}
			$str_aid = explode_str ( $str_aid, ',' );
			
			/* 删除执行 */
			$this->db->from ( $this->table_member_area );
			$this->db->where_in ( 'aid', $str_aid );
			$area_result = $this->db->delete ();
			if ($area_result == $this->db->cw) {
				showmsg ( lang ( 'admin:dbexceptions' ), $url, $callFunc_b );
			}
		}
		$this->area_write ();
		showmsg ( lang ( 'admin:dbsuccess' ), $url, $callFunc_b );
	}
	/* 缓存生成 */
	function area_write() {
		$this->db->from ( $this->table_member_area );
		$this->db->order_by ( 'listorder' );
		$result = $this->db->select ();
		if ($result == $this->db->cw) {
			return $result;
		}
		$result = $this->db->get_list ();
		$cont = NULL;
		while ( $val = $this->db->fetch_array ( $result ) ) {
			/* 地区生成 */
			if ($cont != NULL)
				$sign_str = ',';
			$cont .= $sign_str . '[' . $val ['aid'] . ',' . $val ['aids'] . ",'" . $val ['title'] . "']";
		}
		$file_title = $this->_global ['app'] ['path_data'] . 'datafile' . DS . 'member_area.js';
		$cont = "function member_area(){var data_arr = new Array(" . $cont . ");return data_arr;};";
		template_write ( $file_title, $cont );
	}
}
?>