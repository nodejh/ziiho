<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}
class class_common_emotional extends class_model {
	public $table_common_emotional = 'common_emotional';
	/* 组类 */
	public $group = NULL;
	
	/* 析构函数 */
	function __construct() {
		parent::__construct ();
	}
	function class_common_emotional() {
		$this->__construct ();
	}
	
	/* 表情查询 */
	function emotional_query($_key, $_val = NULL) {
		$this->db->from ( $this->table_common_emotional );
		$this->db->where ( $_key, $_val );
		$result = $this->db->select ();
		if ($result == $this->db->cw) {
			return $result;
		}
		$result = $this->db->get_one ();
		return $result;
	}
	/* 添加表情 */
	function upload($filearr, $uid, $emotgroupid) {
		sleep ( 1 );
		/* 回调参数 */
		$callFunc = post_param ( 'callFunc' );
		$callFunc_b = post_param ( 'callFunc_b' );
		
		/* 分组参数 */
		if (check_nums ( $emotgroupid ) < 1) {
			showmsg ( lang ( 'common:emotional_emotgroupid_fail' ), NULL, $callFunc );
		}
		/* 操作会员 */
		if (check_nums ( $uid ) < 1) {
			showmsg ( lang ( 'member:uid_fail' ), NULL, $callFunc );
		}
		/* 查询用户 */
		$member_qrs = member_query ( $uid );
		if (check_is_array ( $member_qrs ) < 1) {
			showmsg ( lang ( 'member:uid_noexist' ), NULL, $callFunc );
		}
		/* 是否有上传 */
		if (check_is_array ( $filearr ) < 1) {
			showmsg ( lang ( 'global:upload_file_null' ), NULL, $callFunc );
		}
		/* 获取文件信息 */
		$filename_type = getimagesize ( $filearr ['tmp_name'] );
		/* 图片宽 */
		$file_width = $filename_type [0];
		/* 图片高 */
		$file_height = $filename_type [1];
		/* 图片类型 */
		$file_type = $filename_type ['mime'];
		
		/* 检查文件类型 */
		$filetypes = get_array_key ( config_value_get ( 'imgageuploadtype' ) );
		if (check_img_type ( $file_type, $filetypes ) < 1) {
			$fail_str = array_join_str ( ',', $filetypes );
			showmsg ( lang ( 'global:upload_file_type_info', $fail_str ), NULL, $callFunc );
		}
		
		/* 获取上传文件大小 */
		$file_size = ceil ( $filearr ['size'] / 1024 );
		$fs_config = op2num ( config_value_get ( 'imgageuploadsize', 'size' ), 1024, '3' );
		if ($file_size > $fs_config) {
			$langstr = config_value_get ( 'imgageuploadsize', 'size' );
			showmsg ( lang ( 'global:upload_file_size_info', $langstr ), NULL, $callFunc );
		}
		/* 检查上传文件尺寸width,height */
		$fs_width = 1;
		$fs_height = 1;
		if ($file_width < $fs_width || $file_height < $fs_height) {
			showmsg ( lang ( 'global:upload_imagesize_info', array (
					$fs_width,
					$fs_height 
			) ), NULL, $callFunc );
		}
		
		/* 系统时间 */
		$ctime = $this->sys_time;
		/* 指定文件保存路径 */
		$root_dir = $this->_global ['app'] ['path_uploadfile'];
		$dir_config = de_file_dir ( common_value_get ( 'emotional_path', 'path' ) );
		if (create_dir ( $root_dir, $dir_config ) < 1) {
			showmsg ( lang ( 'global:upload_file_dir_noexist' ), NULL, $callFunc );
		}
		/* 获取文件名 */
		$filenamestr = get_file_name ( $filearr ['name'] );
		/* 重定义文件名 */
		$file_name_ext = get_file_ext ( $filearr ['name'] );
		$new_name_str = getrand ( 8, 0 ) . '0' . $ctime;
		$new_file_name = $dir_config . DS . $new_name_str . '.' . $file_name_ext;
		
		/* 添加记录 */
		$dataArr = array (
				'emotgroupid' => $emotgroupid,
				'uid' => $uid,
				'listorder' => 0,
				'title' => $filenamestr,
				'description' => $filenamestr,
				'file_name' => $new_file_name,
				'file_type' => $file_name_ext,
				'ctime' => $ctime 
		);
		$result = $this->db->db_insert ( $this->table_common_emotional, $dataArr );
		unset ( $dataArr );
		if ($result == $this->db->cw) {
			showmsg ( lang ( 'global:dbexception' ), NULL, $callFunc );
		}
		/* 上传处理 */
		if (! move_uploaded_file ( $filearr ['tmp_name'], $root_dir . $new_file_name )) {
			showmsg ( lang ( 'global:upload_file_error' ), NULL, $callFunc );
		}
		showmsg ( lang ( 'global:upload_success' ), NULL, $callFunc_b );
	}
	/* 列表编辑 */
	function baseedit($emotid, $listorder, $title, $description) {
		/* 回调参数 */
		$url = msg_param ();
		$callFunc = msg_func ();
		$callFunc_b = msg_func ( 'callFunc_b' );
		
		/* 表情参数 */
		if (check_is_array ( $emotid ) < 1) {
			showmsg ( lang ( 'global:param_ids_null' ), NULL, $callFunc );
		}
		for($i = 0; $i < array_number ( $emotid ); $i ++) {
			$emotid [$i] = trim_addslashes ( $emotid [$i] );
			$listorder [$i] = trim_addslashes ( $listorder [$i] );
			$title [$i] = trim_addslashes ( $title [$i] );
			$description [$i] = trim_addslashes ( $description [$i] );
			/* 参数 */
			if (check_nums ( $emotid [$i] ) < 1) {
				showmsg ( lang ( 'global:param_ids_fail' ), $url, $callFunc_b );
			}
			/* 名称是否为空 */
			if (str_len ( $title [$i] ) < 1) {
				showmsg ( lang ( 'common:emotional_titles_null' ), $url, $callFunc_b );
			}
			/* 检查是否存在 */
			$result = $this->emotional_query ( 'emotid', $emotid [$i] );
			if ($result == $this->db->cw) {
				showmsg ( lang ( 'common:dbexceptions' ), $url, $callFunc_b );
			}
			if (check_is_array ( $result ) < 1) {
				continue;
			}
			if (check_num ( $listorder [$i] ) < 1) {
				$listorder [$i] = $result ['listorder'];
			}
			/* 初始化数据 */
			$data_arr = array (
					'listorder' => $listorder [$i],
					'title' => $title [$i],
					'description' => $description [$i] 
			);
			$result = $this->db->db_update ( $this->table_common_emotional, $data_arr, 'emotid', $emotid [$i] );
			if ($result == $this->db->cw) {
				showmsg ( lang ( 'common:dbexceptions' ), $url, $callFunc_b );
			}
		}
		showmsg ( lang ( 'global:dbsuccess' ), $url, $callFunc_b );
	}
	/* 移动 */
	function move($emotid, $emotgroupid) {
		/* 回调参数 */
		$url = msg_param ();
		$callFunc = msg_func ();
		$callFunc_b = msg_func ( 'callFunc_b' );
		
		/* 表情参数 */
		if (check_is_array ( $emotid ) < 1) {
			showmsg ( lang ( 'global:param_ids_null' ), NULL, $callFunc );
		}
		/* 检查组参数 */
		if (check_nums ( $emotgroupid ) < 1) {
			showmsg ( lang ( 'common:emotional_emotgroupid_fail' ), NULL, $callFunc );
		}
		for($i = 0; $i < array_number ( $emotid ); $i ++) {
			$emotid [$i] = trim_addslashes ( $emotid [$i] );
			/* 参数 */
			if (check_nums ( $emotid [$i] ) < 1) {
				showmsg ( lang ( 'global:param_ids_fail' ), $url, $callFunc_b );
			}
			/* 检查是否存在 */
			$result = $this->emotional_query ( 'emotid', $emotid [$i] );
			if ($result == $this->db->cw) {
				showmsg ( lang ( 'global:dbexceptions' ), $url, $callFunc_b );
			}
			if (check_is_array ( $result ) < 1) {
				continue;
			}
			/* 如果和原来的分组相等,则忽略 */
			if ($result ['emotgroupid'] == $emotgroupid) {
				continue;
			}
			/* 初始化数据 */
			$data_arr = array (
					'emotgroupid' => $emotgroupid 
			);
			$result = $this->db->db_update ( $this->table_common_emotional, $data_arr, 'emotid', $emotid [$i] );
			unset ( $data_arr );
			if ($result == $this->db->cw) {
				showmsg ( lang ( 'global:dbexceptions' ), $url, $callFunc_b );
			}
		}
		showmsg ( lang ( 'global:dbsuccess' ), $url, $callFunc_b );
	}
	/* 删除 */
	function del($emotid) {
		/* 回调参数 */
		$url = msg_param ();
		$callFunc = msg_func ();
		$callFunc_b = msg_func ( 'callFunc_b' );
		
		/* 组id参数 */
		if (check_is_array ( $emotid ) < 1) {
			showmsg ( lang ( 'global:param_ids_null' ), NULL, $callFunc );
		}
		for($i = 0; $i < array_number ( $emotid ); $i ++) {
			$emotid [$i] = trim_addslashes ( $emotid [$i] );
			/* 组id参数 */
			if (check_nums ( $emotid [$i] ) < 1) {
				showmsg ( lang ( 'global:param_ids_fail' ), $url, $callFunc_b );
			}
			/* 检查组是否存在 */
			$result = $this->emotional_query ( 'emotid', $emotid [$i] );
			if ($result == $this->db->cw) {
				showmsg ( lang ( 'global:dbexceptions' ), $url, $callFunc_b );
			}
			if (check_is_array ( $result ) < 1) {
				continue;
			}
			/* 删除文件 */
			$file_src = show_uf ( $result ['file_name'], true );
			if (check_is_file ( $file_src ) == 1) {
				/* 删除图片 */
				delf ( $file_src );
				/* 获取图片目录 */
				$file_arr = get_fs ( $file_src, true );
				/* 检查目录是否为空 */
				check_null_dir ( $file_arr ['dir_name'], true );
				unset ( $file_arr );
			}
			/* 删除记录 */
			$result = $this->db->db_delete ( $this->table_common_emotional, 'emotid', $emotid [$i] );
			if ($result == $this->db->cw) {
				showmsg ( lang ( 'global:dbexceptions' ), $url, $callFunc_b );
			}
		}
		showmsg ( lang ( 'global:dbsuccess' ), $url, $callFunc_b );
	}
}
?>