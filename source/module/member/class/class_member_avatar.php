<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}
class class_member_avatar extends class_model {
	public $table_member_avatar = 'member_avatar';
	public $table_member_avatar_temp = 'member_avatar_temp';
	
	/* 析构函数 */
	function __construct() {
		parent::__construct ();
	}
	function class_member_avatar() {
		$this->__construct ();
	}
	
	/* 获取头像 */
	function avatar_query($_key, $_val = NULL) {
		$this->db->from ( $this->table_member_avatar );
		$this->db->where ( $_key, $_val );
		$result = $this->db->select ();
		if ($result == $this->db->cw) {
			return $result;
		}
		$result = $this->db->get_one ();
		return $result;
	}
	/* ----------------------------------------------- */
	/*临时头像查询*/
	function avatar_temp_query($_key, $_val = NULL) {
		$this->db->from ( $this->table_member_avatar_temp );
		$this->db->where ( $_key, $_val );
		$result = $this->db->select ();
		if ($result == $this->db->cw) {
			return $result;
		}
		$result = $this->db->get_one ();
		return $result;
	}
	
	/* 头像上传 */
	function avatar_upload($file_arr, $uid) {
		sleep ( 1 );
		/* 回调参数 */
		$callFunc = post_param ( 'callFunc' );
		$callFunc_b = post_param ( 'callFunc_b' );
		
		/* 检查会员 */
		if (check_nums ( $uid ) < 1) {
			showmsg ( lang ( 'member:uid_fail' ), NULL, $callFunc );
		}
		/* 查询用户 */
		$memberRs = member_query ( $uid );
		if (check_is_array ( $memberRs ) < 1) {
			showmsg ( lang ( 'member:uid_noexist' ), NULL, $callFunc );
		}
		
		/* 获取上传设置 */
		$uploadSet = get_db_set ( array (
				'smodule' => 'member',
				'stype' => member_value_get ( 'set_field', 'avatar_set', 'field' ) 
		) );
		if ($uploadSet == $this->db->cw) {
			showmsg ( lang ( 'global:dbexception' ), NULL, $callFunc );
		}
		if (check_is_array ( $uploadSet ) < 1) {
			showmsg ( lang ( 'global:get_db_set_null' ), NULL, $callFunc );
		}
		/* 状态 */
		$avatar_status = member_avatar_status ( 'normal' );
		if (check_num ( $avatar_status ) < 1) {
			showmsg ( lang ( 'global:param_id_fail' ), NULL, $callFunc );
		}
		$sys_time = $this->sys_time;
		
		/* 获取文件信息 */
		$filename_type = getimagesize ( $file_arr ['tmp_name'] );
		/* 图片宽 */
		$file_width = $filename_type [0];
		/* 图片高 */
		$file_height = $filename_type [1];
		/* 图片类型 */
		$file_type = $filename_type ['mime'];
		
		/* 检查文件类型 */
		$file_type_arr = de_serialize ( config_val ( 'extension', $uploadSet ) );
		if (check_img_type ( $file_type, $file_type_arr ) < 1) {
			$fail_str = array_join_str ( ',', $file_type_arr );
			showmsg ( lang ( 'global:upload_file_type_info', $fail_str ), NULL, $callFunc );
		}
		
		/* 获取上传文件大小 */
		$file_size = ceil ( $file_arr ['size'] / 1024 );
		$fs_config = config_val ( 'size', $uploadSet );
		if ($file_size > op2num ( $fs_config, 1024, 3 )) {
			showmsg ( lang ( 'global:upload_file_size_info', $fs_config ), NULL, $callFunc );
		}
		
		/* 检查上传文件允许尺寸 */
		$fs_width = config_val ( 'allow_width', $uploadSet );
		$fs_height = config_val ( 'allow_height', $uploadSet );
		if (check_nums ( $fs_width ) == 1) {
			if ($file_width < $fs_width) {
				showmsg ( lang ( 'global:upload_imagesize_info', array (
						$fs_width,
						$fs_height 
				) ), NULL, $callFunc );
			}
		}
		if (check_nums ( $fs_height ) == 1) {
			if ($file_height < $fs_height) {
				showmsg ( lang ( 'global:upload_imagesize_info', array (
						$fs_width,
						$fs_height 
				) ), NULL, $callFunc );
			}
		}
		
		/* 指定文件保存路径 */
		$root_dir = $this->_global ['app'] ['path_uploadfile'];
		$dir_config = de_file_dir ( config_val ( 'dir', $uploadSet ) );
		if (create_dir ( $root_dir, $dir_config ) < 1) {
			showmsg ( lang ( 'global:upload_file_dir_noexist' ), NULL, $callFunc );
		}
		/* 重定义文件名 */
		$file_name_ext = get_file_ext ( $file_arr ['name'] );
		$new_name_str = getrand ( 8, 0 ) . '0' . $sys_time;
		$new_file_name = $dir_config . DS . $new_name_str . '.' . $file_name_ext;
		
		/* 初始化数据 */
		$dataArr = array (
				'uid' => $uid,
				'file_name' => $new_file_name,
				'file_type' => $file_name_ext,
				'ctime' => $sys_time,
				'status' => $avatar_status,
				'isedited' => yesno_val ( 'normal' ) 
		);
		/* 如果存在临时文件,则删除 */
		$tempRs = $this->avatar_temp_query ( 'uid', $uid );
		if ($tempRs == $this->db->cw) {
			showmsg ( lang ( 'global:dbexception' ), NULL, $callFunc );
		}
		if (check_is_array ( $tempRs ) == 1) {
			delf ( show_uf ( $tempRs ['file_name'], true ) );
			unset ( $dataArr ['uid'] );
			$result = $this->db->db_update ( $this->table_member_avatar_temp, $dataArr, 'uid', $uid );
		} else {
			$result = $this->db->db_insert ( $this->table_member_avatar_temp, $dataArr );
		}
		unset ( $dataArr );
		if ($result == $this->db->cw) {
			showmsg ( lang ( 'global:dbexception' ), NULL, $callFunc );
		}
		
		/* 上传处理 */
		if (! move_uploaded_file ( $file_arr ['tmp_name'], $root_dir . $new_file_name )) {
			showmsg ( lang ( 'global:upload_file_error' ), NULL, $callFunc );
		}
		
		/* 缩略图w,h都为0,不生成缩略图 */
		$thumb_width = config_val ( 'thumb_width', $uploadSet );
		$thumb_height = config_val ( 'thumb_height', $uploadSet );
		$thumb_quality = config_val ( 'quality', $uploadSet );
		/* 文件尺寸 */
		$fileInfo = array (
				$file_width,
				$file_height 
		);
		/* 是否需要缩略图 */
		$isthumb = (check_nums ( $thumb_width ) < 1 && check_nums ( $thumb_height ) < 1) ? 0 : 1;
		if ($isthumb == 1) {
			$thumb_width = (check_nums ( $thumb_width ) < 1) ? $file_width : $thumb_width;
			$thumb_height = (check_nums ( $thumb_height ) < 1) ? $file_height : $thumb_height;
			imagethumb ( $root_dir . $new_file_name, $root_dir . $new_file_name, $thumb_width, $thumb_height, $thumb_quality );
			/* 文件尺寸 */
			$fileInfo = image_size ( $root_dir . $new_file_name );
		} else {
			/* 检查是否需要对质量处理 */
			if (check_nums ( $thumb_quality ) == 1) {
				imagethumb ( $root_dir . $new_file_name, $root_dir . $new_file_name, $file_width, $file_height, $thumb_quality );
			}
		}
		/* 返回文件名 */
		$src = show_uf ( $new_file_name );
		
		/* 原头像 */
		$old_avatarRs = $this->avatar_query ( 'uid', $uid );
		$old_avatar = show_uf ( array_key_val ( 'file_name', $old_avatarRs ) );
		unset ( $old_avatarRs );
		/* 裁剪选区框最小尺寸 */
		$crop_min_width = config_val ( 'crop_minwidth', $uploadSet );
		$crop_min_height = config_val ( 'crop_minheight', $uploadSet );
		if (check_nums ( $crop_min_width ) < 1 || $crop_min_width > $fs_width) {
			$crop_min_width = $fs_width;
		}
		if (check_nums ( $crop_min_height ) < 1 || $crop_min_height > $fs_height) {
			$crop_min_height = $fs_height;
		}
		$returnData = array (
				'oldsrc' => $old_avatar,
				'src' => $src,
				'width' => $fileInfo [0],
				'height' => $fileInfo [1],
				'crop_min_width' => $crop_min_width,
				'crop_min_height' => $crop_min_height 
		);
		showmsg ( lang ( 'member:upload_success' ), NULL, $callFunc_b, $returnData );
	}
	/* 头像裁剪 */
	function avatar_crop($x, $y, $w1, $h1) {
		sleep ( 1 );
		/* 回调参数 */
		$callFunc = msg_func ();
		$callFunc_b = msg_func ( 'callFunc_b' );
		
		/* 当前会员 */
		$uid = get_user ( 'uid' );
		
		if (check_num ( $x ) < 1 || check_num ( $y ) < 1) {
			showmsg ( lang ( 'member:avatar_upload_crop_xy_fail' ), NULL, $callFunc );
		}
		if (check_nums ( $w1 ) < 1 || check_nums ( $h1 ) < 1) {
			showmsg ( lang ( 'member:avatar_upload_crop_wh_fail' ), NULL, $callFunc );
		}
		/* 获取操作失败存在 */
		$tempRs = $this->avatar_temp_query ( 'uid', $uid );
		if ($tempRs == $this->db->cw) {
			showmsg ( lang ( 'member:dbexception' ), NULL, $callFunc );
		}
		/* 是否存在 */
		if (check_is_array ( $tempRs ) < 1) {
			showmsg ( lang ( 'member:avatar_upload_temp_noexist' ), NULL, $callFunc );
		}
		/* 是否已操作 */
		if ($tempRs ['edited'] != yesno_val ( 'normal' )) {
			showmsg ( lang ( 'member:avatar_upload_temp_noexist' ), NULL, $callFunc );
		}
		/* 文件是否存在 */
		$file_src = show_uf ( $tempRs ['file_name'], true );
		if (check_is_file ( $file_src ) < 1) {
			showmsg ( lang ( 'member:avatar_upload_crop_file_noexist' ), NULL, $callFunc );
		}
		$fileInfo = image_size ( $file_src );
		
		/* 配置信息 */
		$uploadSet = get_db_set ( array (
				'smodule' => 'member',
				'stype' => member_value_get ( 'set_field', 'avatar_set', 'field' ) 
		) );
		if ($uploadSet == $this->db->cw) {
			showmsg ( lang ( 'global:dbexception' ), NULL, $callFunc );
		}
		if (check_is_array ( $uploadSet ) < 1) {
			showmsg ( lang ( 'global:get_db_set_null' ), NULL, $callFunc );
		}
		/* 正常状态,用作对比设置状态 */
		$avatar_normal = member_avatar_status ( 'normal' );
		/* 初始化状态 */
		$avatar_status = member_avatar_status ( 'normal' );
		/* 设置允许裁剪的范围 */
		$crop_minwidth = config_val ( 'crop_minwidth', $uploadSet );
		$crop_minheight = config_val ( 'crop_minheight', $uploadSet );
		/* 质量 */
		$quality = config_val ( 'quality', $uploadSet );
		if (check_nums ( $crop_minwidth ) < 1 || $crop_minwidth > $fileInfo [0]) {
			$crop_minwidth = $fileInfo [0];
		}
		if (check_nums ( $crop_minheight ) < 1 || $crop_minheight > $fileInfo [1]) {
			$crop_minheight = $fileInfo [1];
		}
		unset ( $uploadSet, $file_info );
		
		/* 检查是否符合配置信息 */
		if ($w1 < $crop_minwidth) {
			showmsg ( lang ( 'member:avatar_upload_crop_wh_not_config_fail' ), NULL, $callFunc );
		}
		if ($h1 < $crop_minheight) {
			showmsg ( lang ( 'member:avatar_upload_crop_wh_not_config_fail' ), NULL, $callFunc );
		}
		
		/* 如果裁剪尺寸适合图片尺寸一样大,则不需要裁剪 */
		$isCrop = ($w1 == $fileInfo [0] && $h1 == $fileInfo [1]) ? 0 : 1;
		
		/* 如果不为正常状态时,仅裁剪操作,则替换原头像 */
		if ($avatar_normal != $avatar_status) {
			/* 设为已编辑过状态 */
			$result = $this->db->db_update ( $this->table_member_avatar_temp, array (
					'isedited' => yesno_val ( 'check' ) 
			), 'uid', $uid );
			if ($result == $this->db->cw) {
				$this->db->trans_rollback_end ();
				showmsg ( lang ( 'global:dbexception' ), NULL, $callFunc );
			}
		} else {
			/* 初始化数据 */
			$dataArr = array (
					'uid' => $uid,
					'file_name' => $tempRs ['file_name'],
					'ctime' => $this->sys_time 
			);
			/* 开始事务 */
			$this->db->trans_begin ();
			
			/* 如果原头像存在,则删除原头像 */
			$avatarRs = $this->avatar_query ( 'uid', $uid );
			if ($avatarRs == $this->db->cw) {
				$this->db->trans_rollback_end ();
				showmsg ( lang ( 'global:dbexception' ), NULL, $callFunc );
			}
			$isOld = 0;
			if (check_is_array ( $avatarRs ) == 1) {
				$isOld = 1;
				/* 删除原来的头像 */
				$oldSrc = show_uf ( $avatarRs ['file_name'], true );
				if (check_is_file ( $oldSrc ) == 1) {
					serachfile_del ( $oldSrc . '*', false );
					/* 检查目录是否为空 */
					$file_arr = get_fs ( $oldSrc, true );
					check_null_dir ( $file_arr ['dir_name'], true );
				}
			}
			/* 处理记录 */
			if ($isOld != 1) {
				$result = $this->db->db_insert ( $this->table_member_avatar, $dataArr );
			} else {
				unset ( $dataArr ['uid'] );
				$result = $this->db->db_update ( $this->table_member_avatar, $dataArr, 'uid', $uid );
			}
			if ($result == $this->db->cw) {
				$this->db->trans_rollback_end ();
				showmsg ( lang ( 'global:dbexception' ), NULL, $callFunc );
			}
			/* 删除临时记录 */
			$result = $this->db->db_delete ( $this->table_member_avatar_temp, 'uid', $uid );
			if ($result == $this->db->cw) {
				$this->db->trans_rollback_end ();
				showmsg ( lang ( 'global:dbexception' ), NULL, $callFunc );
			}
			/* 提交事务 */
			$this->db->trans_commit_end ();
		}
		/* 图片处理 */
		if ($isCrop == 1) {
			imagecut ( $file_src, $file_src, "{$x},{$y}", "{$w1},{$h1}" );
			imagethumb ( $file_src, $file_src, $crop_minwidth, $crop_minheight, $quality );
		}
		$url = url ( 'index', 'mod/member/ac/setting/op/avatar/ao/upload' );
		showmsg ( lang ( 'global:dbsuccess' ), $url, $callFunc_b );
	}
	/* 头像取消 */
	function avatar_cancel() {
		sleep ( 1 );
		/* 回调参数 */
		$callFunc = msg_func ();
		$callFunc_b = msg_func ( 'callFunc_b' );
		
		$uid = get_user ( 'uid' );
		/* 检查是否存在 */
		$tempRs = $this->avatar_temp_query ( 'uid', $uid );
		if ($tempRs == $this->db->cw) {
			showmsg ( lang ( 'global:dbexception' ), NULL, $callFunc );
		}
		/* 清除操作 */
		if (check_is_array ( $tempRs ) == 1) {
			/* 删除文件 */
			delf ( show_uf ( $tempRs ['file_name'], true ) );
			/* 删除记录 */
			$result = $this->db->db_delete ( $this->table_member_avatar_temp, 'uid', $uid );
			if ($result == $this->db->cw) {
				showmsg ( lang ( 'global:dbexception' ), NULL, $callFunc );
			}
		}
		$url = url ( 'index', 'mod/member/ac/setting/op/avatar/ao/upload' );
		showmsg ( lang ( 'global:dbsuccess' ), $url, $callFunc_b );
	}
}
?>