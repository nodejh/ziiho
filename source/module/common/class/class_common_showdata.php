<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}
class class_common_showdata extends class_model {
	public $table_common_showdata = 'common_showdata';
	
	/* 析构函数 */
	function __construct() {
		parent::__construct ();
	}
	function class_common_showdata() {
		$this->__construct ();
	}
	
	/* 展示数据查询 */
	function data_query($_key, $_val = NULL) {
		$this->db->from ( $this->table_common_showdata );
		$this->db->where ( $_key, $_val );
		$result = $this->db->select ();
		if ($result == $this->db->cw) {
			return $result;
		}
		$result = $this->db->get_one ();
		return $result;
	}
	/* 添加 */
	function add($listorder, $title, $url, $cgroupid, $covertype, $coverimage, $status, $description) {
		/* 回调参数 */
		$callBackUrl = msg_param ();
		$callFunc = msg_func ();
		$callFunc_b = msg_func ( 'callFunc_b' );
		
		$uid = get_user ( 'uid' );
		$_module = _M ();
		
		if (str_len ( $title ) < 1) {
			showmsg ( lang ( 'common:showdata_title_null' ), NULL, $callFunc );
		}
		if (check_num ( $cgroupid ) < 1) {
			showmsg ( lang ( 'common:showdata_cgroupid_fail' ), NULL, $callFunc );
		}
		if (check_num ( $covertype ) < 1) {
			showmsg ( lang ( 'common:showdata_covertype_fail' ), NULL, $callFunc );
		}
		$title = sub_str ( $title, 0, 180 );
		if (check_num ( $listorder ) < 1) {
			$listorder = 0;
		}
		if (str_len ( $url ) >= 1) {
			$url = url_pre_append ( $url );
		}
		if (check_num ( $status ) < 1) {
			$status = yesno_val ( 'check' );
		}
		/* 是否存在临时图片 */
		$tempFileRs = common_temp_attachment_query ( array (
				'module' => $_module,
				'idtype' => 'cdataid',
				'uid' => $uid 
		) );
		if ($tempFileRs == $this->db->cw) {
			showmsg ( lang ( 'global:dbexception' ), NULL, $callFunc );
		}
		$isTempFileRs = 0;
		if (check_is_array ( $tempFileRs ) == 1) {
			$isTempFileRs = 1;
		}
		/* 如果为网络图片,则删除已上传的临时图片 */
		if ($covertype != yesno_val ( 'check' ) && $isTempFileRs == 1) {
			$tempFileSrc = show_uf ( $tempFileRs ['file_name'], true );
			if (check_is_file ( $tempFileSrc ) == 1) {
				/* 清除图 */
				serachfile_del ( $tempFileSrc . '*', false );
				/* 检查目录是否为空 */
				$tempFileSrcArr = get_fs ( $tempFileSrc, true );
				check_null_dir ( $tempFileSrcArr ['dir_name'], true );
				unset ( $tempFileSrcArr );
			}
		} else if ($covertype == yesno_val ( 'check' ) && $isTempFileRs == 1) {
			/* 获取临时图片 */
			$coverimage = $tempFileRs ['file_name'];
		}
		/* 删除临时图片记录 */
		if ($isTempFileRs == 1) {
			$result = common_temp_attachment_del ( 'attachid', $tempFileRs ['attachid'] );
			if ($result == $this->db->cw) {
				showmsg ( lang ( 'global:dbexception' ), NULL, $callFunc );
			}
		}
		/* 初始化数据 */
		$dataArr = array (
				'cgroupid' => $cgroupid,
				'listorder' => $listorder,
				'title' => $title,
				'url' => $url,
				'description' => $description,
				'covertype' => $covertype,
				'coverimage' => $coverimage,
				'ctime' => $this->sys_time,
				'status' => $status 
		);
		$result = $this->db->db_insert ( $this->table_common_showdata, $dataArr );
		unset ( $dataArr );
		if ($result == $this->db->cw) {
			showmsg ( lang ( 'global:dbexception' ), NULL, $callFunc );
		}
		showmsg ( lang ( 'global:dbsuccess' ), $callBackUrl, $callFunc_b );
	}
	/* 编辑 */
	function edit($cdataid, $listorder, $title, $url, $cgroupid, $covertype, $coverimage, $status, $description) {
		/* 回调参数 */
		$callBackUrl = msg_param ();
		$callFunc = msg_func ();
		$callFunc_b = msg_func ( 'callFunc_b' );
		
		if (check_num ( $cdataid ) < 1) {
			showmsg ( lang ( 'common:showdata_cdataid_fail' ), NULL, $callFunc );
		}
		if (str_len ( $title ) < 1) {
			showmsg ( lang ( 'common:showdata_title_null' ), NULL, $callFunc );
		}
		if (check_num ( $cgroupid ) < 1) {
			showmsg ( lang ( 'common:showdata_cgroupid_fail' ), NULL, $callFunc );
		}
		if (check_num ( $covertype ) < 1) {
			showmsg ( lang ( 'common:showdata_covertype_fail' ), NULL, $callFunc );
		}
		/* 检查是否存在 */
		$showDataRs = $this->data_query ( 'cdataid', $cdataid );
		if ($showDataRs == $this->db->cw) {
			showmsg ( lang ( 'global:dbexception' ), NULL, $callFunc );
		}
		if (check_is_array ( $showDataRs ) < 1) {
			showmsg ( lang ( 'common:showdata_cdataid_noexist' ), $callBackUrl, $callFunc_b );
		}
		/* 如果为网络图片,则删除已上传的附件 */
		if ($covertype != yesno_val ( 'check' )) {
			$fileSrc = show_uf ( $showDataRs ['coverimage'], true );
			if (check_is_file ( $fileSrc ) == 1) {
				/* 清除图 */
				serachfile_del ( $fileSrc . '*', false );
				/* 检查目录是否为空 */
				$fileSrcArr = get_fs ( $fileSrc, true );
				check_null_dir ( $fileSrcArr ['dir_name'], true );
				unset ( $fileSrcArr );
			}
		} else {
			$coverimage = $showDataRs ['coverimage'];
		}
		/* 检查参数 */
		$title = sub_str ( $title, 0, 180 );
		if (check_num ( $listorder ) < 1) {
			$listorder = $showDataRs ['listorder'];
		}
		if (str_len ( $url ) >= 1) {
			$url = url_pre_append ( $url );
		}
		if (check_num ( $status ) < 1) {
			$status = yesno_val ( 'check' );
		}
		unset ( $showDataRs );
		
		/* 初始化数据 */
		$dataArr = array (
				'cgroupid' => $cgroupid,
				'listorder' => $listorder,
				'title' => $title,
				'url' => $url,
				'description' => $description,
				'covertype' => $covertype,
				'coverimage' => $coverimage,
				'status' => $status 
		);
		$result = $this->db->db_update ( $this->table_common_showdata, $dataArr, 'cdataid', $cdataid );
		unset ( $dataArr );
		if ($result == $this->db->cw) {
			showmsg ( lang ( 'global:dbexception' ), NULL, $callFunc );
		}
		showmsg ( lang ( 'global:dbsuccess' ), $callBackUrl, $callFunc_b );
	}
	/* 基本编辑 */
	function baseedit($cdataid, $listorder, $status) {
		/* 回调参数 */
		$url = msg_param ();
		$callFunc = msg_func ();
		$callFunc_b = msg_func ( 'callFunc_b' );
		
		if (check_is_array ( $cdataid ) < 1) {
			showmsg ( lang ( 'global:param_ids_null' ), NULL, $callFunc );
		}
		for($i = 0; $i < array_number ( $cdataid ); $i ++) {
			$cdataid [$i] = trim_addslashes ( $cdataid [$i] );
			$listorder [$i] = trim_addslashes ( $listorder [$i] );
			$status [$i] = trim_addslashes ( $status [$i] );
			if (check_nums ( $cdataid [$i] ) < 1) {
				showmsg ( lang ( 'global:param_ids_fail' ), $url, $callFunc_b );
			}
			/* 检查是否存在 */
			$result = $this->data_query ( 'cdataid', $cdataid [$i] );
			if ($result == $this->db->cw) {
				showmsg ( lang ( 'global:dbexceptions' ), $url, $callFunc_b );
			}
			if (check_is_array ( $result ) < 1) {
				continue;
			}
			if (check_num ( $listorder [$i] ) < 1) {
				$listorder [$i] = $result ['listorder'];
			}
			if (check_num ( $status [$i] ) < 1) {
				$status [$i] = $result ['status'];
			}
			/* 初始化数据,更新 */
			$data_arr = array (
					'listorder' => $listorder [$i],
					'status' => $status [$i] 
			);
			$result = $this->db->db_update ( $this->table_common_showdata, $data_arr, 'cdataid', $cdataid [$i] );
			unset ( $data_arr );
			if ($result == $this->db->cw) {
				showmsg ( lang ( 'global:dbexceptions' ), $url, $callFunc_b );
			}
		}
		showmsg ( lang ( 'global:dbsuccess' ), $url, $callFunc_b );
	}
	/* 删除 */
	function del($cdataid) {
		/* 回调参数 */
		$url = msg_param ();
		$callFunc = msg_func ();
		$callFunc_b = msg_func ( 'callFunc_b' );
		
		if (check_is_array ( $cdataid ) < 1) {
			showmsg ( lang ( 'global:param_id_null' ), NULL, $callFunc );
		}
		for($i = 0; $i < array_number ( $cdataid ); $i ++) {
			$cdataid [$i] = trim_addslashes ( $cdataid [$i] );
			if (check_nums ( $cdataid [$i] ) < 1) {
				showmsg ( lang ( 'global:param_ids_fail' ), $url, $callFunc_b );
			}
			/* 检查是否存在 */
			$showDataRs = $this->data_query ( 'cdataid', $cdataid [$i] );
			if ($showDataRs == $this->db->cw) {
				showmsg ( lang ( 'global:dbexceptions' ), $url, $callFunc_b );
			}
			if (check_is_array ( $showDataRs ) < 1) {
				continue;
			}
			/* 删除附件 */
			if ($showDataRs ['covertype'] == yesno_val ( 'check' )) {
				$fileSrc = show_uf ( $showDataRs ['coverimage'], true );
				if (check_is_file ( $fileSrc ) == 1) {
					/* 清除图 */
					serachfile_del ( $fileSrc . '*', false );
					/* 检查目录是否为空 */
					$fileSrcArr = get_fs ( $fileSrc, true );
					check_null_dir ( $fileSrcArr ['dir_name'], true );
					unset ( $fileSrcArr );
				}
			}
			$result = $this->db->db_delete ( $this->table_common_showdata, 'cdataid', $cdataid [$i] );
			if ($result == $this->db->cw) {
				showmsg ( lang ( 'global:dbexceptions' ), $url, $callFunc_b );
			}
		}
		showmsg ( lang ( 'global:dbsuccess' ), $url, $callFunc_b );
	}
	/* 封面上传 */
	function coverupload($filearr, $uid, $cdataid) {
		sleep ( 1 );
		/* 回调参数 */
		$callFunc = post_param ( 'callFunc' );
		$callFunc_b = post_param ( 'callFunc_b' );
		
		$_module = _M ();
		/* 是否有上传 */
		if (check_is_array ( $filearr ) < 1) {
			showmsg ( lang ( 'global:upload_file_null' ), NULL, $callFunc );
		}
		/* 幻灯参数 */
		if (check_num ( $cdataid ) < 1) {
			showmsg ( lang ( 'common:showdata_cdataid_fail' ), NULL, $callFunc );
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
		
		$isShowDataRs = 0;
		$temp_attachid = 0;
		/* 幻灯是否存在 */
		if (check_nums ( $cdataid ) == 1) {
			$showdataRs = $this->data_query ( 'cdataid', $cdataid );
			if ($showdataRs == $this->db->cw) {
				showmsg ( lang ( 'global:dbexception' ), NULL, $callFunc );
			}
			if (check_is_array ( $showdataRs ) < 1) {
				showmsg ( lang ( 'common:showdata_cdataid_noexist' ), NULL, $callFunc );
			}
			/* 删除原来的图片 */
			$oldFileSrc = show_uf ( $showdataRs ['coverimage'], true );
			if (check_is_file ( $oldFileSrc ) == 1) {
				/* 清除图 */
				serachfile_del ( $oldFileSrc . '*', false );
				/* 检查目录是否为空 */
				$oldFileSrcArr = get_fs ( $oldFileSrc, true );
				check_null_dir ( $oldFileSrcArr ['dir_name'], true );
				unset ( $oldFileSrcArr );
			}
			$isShowDataRs = 1;
		} else {
			/* 是否存在临时图片 */
			$tempFileRs = common_temp_attachment_query ( array (
					'module' => $_module,
					'idtype' => 'cdataid',
					'uid' => $uid 
			) );
			if ($tempFileRs == $this->db->cw) {
				showmsg ( lang ( 'global:dbexception' ), NULL, $callFunc );
			}
			if (check_is_array ( $tempFileRs ) == 1) {
				/* 删除原来的图片 */
				$oldFileSrc = show_uf ( $tempFileRs ['file_name'], true );
				if (check_is_file ( $oldFileSrc ) == 1) {
					/* 清除图 */
					serachfile_del ( $oldFileSrc . '*', false );
					/* 检查目录是否为空 */
					$oldFileSrcArr = get_fs ( $oldFileSrc, true );
					check_null_dir ( $oldFileSrcArr ['dir_name'], true );
					unset ( $oldFileSrcArr );
				}
				$temp_attachid = $tempFileRs ['attachid'];
			}
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
		$dir_config = de_file_dir ( common_value_get ( 'showdata_path', 'path' ) );
		if (create_dir ( $root_dir, $dir_config ) < 1) {
			showmsg ( lang ( 'global:upload_file_dir_noexist' ), NULL, $callFunc );
		}
		/* 获取文件名 */
		$filenamestr = get_file_name ( $filearr ['name'] );
		/* 重定义文件名 */
		$file_name_ext = get_file_ext ( $filearr ['name'] );
		$new_name_str = getrand ( 8, 0 ) . '0' . $ctime;
		$new_file_name = $dir_config . DS . $new_name_str . '.' . $file_name_ext;
		
		/* 如果幻灯不存在,则存放为临时 */
		if ($isShowDataRs != 1) {
			$dataArr = array (
					'module' => $_module,
					'idtype' => 'cdataid',
					'uid' => $uid,
					'file_name' => $new_file_name,
					'file_type' => $file_name_ext,
					'ctime' => $this->sys_time 
			);
			if ($temp_attachid < 1) {
				$result = common_temp_attachment_add ( $dataArr );
			} else {
				$result = common_temp_attachment_edit ( $dataArr, 'attachid', $temp_attachid );
			}
		} else {
			$dataArr = array (
					'covertype' => yesno_val ( 'check' ),
					'coverimage' => $new_file_name 
			);
			$result = $this->db->db_update ( $this->table_common_showdata, $dataArr, 'cdataid', $cdataid );
		}
		unset ( $dataArr );
		if ($result == $this->db->cw) {
			showmsg ( lang ( 'global:dbexception' ), NULL, $callFunc );
		}
		/* 上传处理 */
		if (! move_uploaded_file ( $filearr ['tmp_name'], $root_dir . $new_file_name )) {
			showmsg ( lang ( 'global:upload_file_error' ), NULL, $callFunc );
		}
		showmsg ( lang ( 'global:upload_success' ), NULL, $callFunc_b, array (
				'src' => show_uf ( $new_file_name ) 
		) );
	}
}
?>