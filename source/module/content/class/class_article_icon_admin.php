<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}

loader ( 'class:class_article_icon', 'article', true, true );
class class_article_icon_admin extends class_article_icon {
	
	/* 析构函数 */
	function __construct() {
		parent::__construct ();
	}
	function class_article_icon_admin() {
		$this->__construct ();
	}
	
	/* 添加 */
	function baseadd($listorder, $title, $iconident) {
		/* 回调参数 */
		$callbackUrl = msg_param ();
		$callFunc = msg_func ();
		$callFunc_b = msg_func ( 'callFunc_b' );
		
		if (str_len ( $title ) < 1) {
			showmsg ( lang ( 'article:icon_title_null' ), NULL, $callFunc );
		}
		if (check_num ( $listorder ) < 1) {
			$listorder = 0;
		}
		/* 操作会员 */
		$uid = get_user ( 'uid' );
		/* 状态 */
		$yes = yesno_val ( 'normal' );
		$no = yesno_val ( 'check' );
		/* 查询是否存在 */
		$icon = $this->icon_query ( array (
				'uid' => $uid,
				'status' => $no 
		) );
		if ($icon == $this->db->cw) {
			showmsg ( lang ( 'global:dbexception' ), NULL, $callFunc );
		}
		/* 初始化数据 */
		$dataArr = array (
				'uid' => $uid,
				'listorder' => $listorder,
				'title' => $title,
				'iconident' => $iconident,
				'ctime' => $this->sys_time,
				'status' => $yes 
		);
		if (check_is_array ( $icon ) == 1) {
			unset ( $dataArr ['uid'], $dataArr ['ctime'] );
			$result = $this->db->db_update ( $this->table_article_icon, $dataArr, 'iconid', array_key_val ( 'iconid', $icon ) );
		} else {
			$result = $this->db->db_insert ( $this->table_article_icon, $dataArr );
		}
		unset ( $dataArr );
		if ($result == $this->db->cw) {
			showmsg ( lang ( 'global:dbexception' ), NULL, $callFunc );
		}
		showmsg ( lang ( 'global:dbsuccess' ), $callbackUrl, $callFunc_b );
	}
	/* 编辑 */
	function baseedit($iconid, $listorder, $title, $iconident) {
		/* 回调参数 */
		$callbackUrl = msg_param ();
		$callFunc = msg_func ();
		$callFunc_b = msg_func ( 'callFunc_b' );
		
		if (check_is_array ( $iconid ) < 1) {
			showmsg ( lang ( 'global:param_id_null' ), NULL, $callFunc );
		}
		for($i = 0; $i < array_number ( $iconid ); $i ++) {
			$iconid [$i] = trim_addslashes ( $iconid [$i] );
			$listorder [$i] = trim_addslashes ( $listorder [$i] );
			$title [$i] = trim_addslashes ( $title [$i] );
			$iconident [$i] = trim_addslashes ( $iconident [$i] );
			if (check_nums ( $iconid [$i] ) < 1) {
				showmsg ( lang ( 'global:param_ids_fail' ), $callbackUrl, $callFunc_b );
			}
			/* 检查是否存在 */
			$qrs = $this->icon_query ( 'iconid', $iconid [$i] );
			if ($qrs == $this->db->cw) {
				showmsg ( lang ( 'global:dbexceptions' ), $callbackUrl, $callFunc_b );
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
			/* 编辑 */
			$dataArr = array (
					'listorder' => $listorder [$i],
					'title' => $title [$i],
					'iconident' => $iconident [$i] 
			);
			$result = $this->db->db_update ( $this->table_article_icon, $dataArr, 'iconid', $iconid [$i] );
			unset ( $dataArr );
			if ($result == $this->db->cw) {
				showmsg ( lang ( 'global:dbexceptions' ), $callbackUrl, $callFunc_b );
			}
		}
		showmsg ( lang ( 'global:dbsuccess' ), $callbackUrl, $callFunc_b );
	}
	/* 删除 */
	function del($iconid) {
		/* 回调参数 */
		$callbackUrl = msg_param ();
		$callFunc = msg_func ();
		$callFunc_b = msg_func ( 'callFunc_b' );
		
		if (check_is_array ( $iconid ) < 1) {
			showmsg ( lang ( 'global:param_ids_null' ), NULL, $callFunc );
		}
		for($i = 0; $i < array_number ( $iconid ); $i ++) {
			$iconid [$i] = trim_addslashes ( $iconid [$i] );
			if (check_nums ( $iconid [$i] ) < 1) {
				showmsg ( lang ( 'global:param_ids_fail' ), $callbackUrl, $callFunc_b );
			}
			/* 检查是否存在 */
			$result = $this->icon_query ( 'iconid', $iconid [$i] );
			if ($result == $this->db->cw) {
				showmsg ( lang ( 'global:dbexceptions' ), $callbackUrl, $callFunc_b );
			}
			if (check_is_array ( $result ) < 1) {
				continue;
			}
			/* 删除文件 */
			$filesrc = show_uf ( $result ['filename'], true );
			delf ( $filesrc );
			
			/* 删除图标 */
			$result = $this->db->db_delete ( $this->table_article_icon, 'iconid', $iconid [$i] );
			if ($result == $this->db->cw) {
				showmsg ( lang ( 'global:dbexceptions' ), $callbackUrl, $callFunc_b );
			}
		}
		showmsg ( lang ( 'global:dbsuccess' ), $callbackUrl, $callFunc_b );
	}
	/* 上传 */
	function upload($filearr, $uid, $iconid) {
		/* 回调参数 */
		$callFunc = post_param ( 'callFunc' );
		$callFunc_b = post_param ( 'callFunc_b' );
		
		if (check_nums ( $uid ) < 1) {
			showmsg ( lang ( 'member:uid_fail' ), NULL, $callFunc );
		}
		/* 查询用户 */
		$member_qrs = member_query ( $uid );
		if (check_is_array ( $member_qrs ) < 1) {
			showmsg ( lang ( 'member:uid_noexist' ), NULL, $callFunc );
		}
		if (check_num ( $iconid ) < 1) {
			showmsg ( lang ( 'global:param_id_fail' ), NULL, $callFunc );
		}
		if (check_is_array ( $filearr ) < 1) {
			showmsg ( lang ( 'global:uploadfilenull' ), NULL, $callFunc );
		}
		/* 状态 */
		$no = yesno_val ( 'check' );
		/* 查询是否存在 */
		if (check_nums ( $iconid ) == 1) {
			$icon = $this->icon_query ( 'iconid', $iconid );
		} else {
			$icon = $this->icon_query ( array (
					'uid' => $uid,
					'status' => $no 
			) );
		}
		if ($icon == $this->db->cw) {
			showmsg ( lang ( 'global:dbexception' ), NULL, $callFunc );
		}
		/* 如果记录不存在 */
		if (check_nums ( $iconid ) == 1) {
			if (check_is_array ( $icon ) < 1) {
				showmsg ( lang ( 'global:param_id_noexist' ), NULL, $callFunc );
			}
		}
		/* 获取类型 */
		$filetypearr = config_value_get ( 'imgageuploadtype' );
		$filetypes = get_array_key ( $filetypearr );
		/* 大小 */
		$filesize = config_value_get ( 'imgageuploadsize', 'size' );
		/* 获取保存路径 */
		$pathdir = article_value_get ( 'iconpath', 'path', 'val' );
		
		/* 获取文件信息 */
		$filename_type = getimagesize ( $filearr ['tmp_name'] );
		/* 图片类型 */
		$file_type = $filename_type ['mime'];
		/* 检查文件类型 */
		if (check_img_type ( $file_type, $filetypes ) < 1) {
			$fail_str = array_join_str ( ',', $filetypes );
			showmsg ( lang ( 'global:upload_file_type_info', $fail_str ), NULL, $callFunc );
		}
		/* 获取上传文件大小 */
		$file_size = ceil ( $filearr ['size'] / 1024 );
		$fs_kb = (( int ) $filesize) * 1024;
		if ($file_size > $fs_kb) {
			$size_lang = config_value_get ( 'imgageuploadsize', 'size' );
			showmsg ( lang ( 'global:upload_file_size_info', $size_lang ), NULL, $callFunc );
		}
		/* 指定文件保存路径 */
		$pathroot = $this->_global ['app'] ['path_uploadfile'];
		$ds = $this->_global ['app'] ['ds'];
		if (create_dir ( $pathroot, $pathdir ) < 1) {
			showmsg ( lang ( 'global:upload_file_dir_noexist' ), NULL, $callFunc );
		}
		/* 删除上次的文件 */
		if (check_is_array ( $icon ) == 1) {
			$filesrc = show_uf ( $icon ['filename'], true );
			delf ( $filesrc );
		}
		/* 重定义文件名 */
		$ctime = $this->sys_time;
		$filename_ext = get_file_ext ( $filearr ['name'] );
		$newname_str = getrand ( 8, 0 ) . '0' . $ctime;
		$newfile_name = $pathdir . $ds . $newname_str . '.' . $filename_ext;
		
		/* 初始化数据 */
		if (check_is_array ( $icon ) == 1) {
			$dataArr = array (
					'filename' => $newfile_name 
			);
			$result = $this->db->db_update ( $this->table_article_icon, $dataArr, 'iconid', array_key_val ( 'iconid', $icon, 0 ) );
		} else {
			$dataArr = array (
					'uid' => $uid,
					'title' => 'unknown',
					'filename' => $newfile_name,
					'ctime' => $ctime,
					'status' => $no 
			);
			$result = $this->db->db_insert ( $this->table_article_icon, $dataArr );
		}
		unset ( $dataArr );
		if ($result == $this->db->cw) {
			showmsg ( lang ( 'global:dbexception' ), NULL, $callFunc );
		}
		/* 上传处理 */
		if (! move_uploaded_file ( $filearr ['tmp_name'], $pathroot . $newfile_name )) {
			showmsg ( lang ( 'global:upload_file_error' ), NULL, $callFunc );
		}
		$newfile_name = show_uf ( $newfile_name );
		showmsg ( lang ( 'global:upload_success' ), NULL, $callFunc_b, array (
				'iconid' => $iconid,
				'filename' => $newfile_name 
		) );
	}
}
?>