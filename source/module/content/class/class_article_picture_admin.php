<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}

loader ( 'class:class_article_picture', 'article', true );
class class_article_picture_admin extends class_article_picture {
	
	/* 析构函数 */
	function __construct() {
		parent::__construct ();
	}
	function class_article_picture_admin() {
		$this->__construct ();
	}
	
	/* 图片上传 */
	function picture_upload($uid, $aid) {
		sleep ( 1 );
		/* 回调参数 */
		$callFunc = post_param ( 'callFunc' );
		$callFunc_b = post_param ( 'callFunc_b' );
		
		if (check_nums ( $uid ) < 1) {
			showmsg ( lang ( 'member:uid_fail' ), NULL, $callFunc );
		}
		if (check_num ( $aid ) < 1) {
			showmsg ( lang ( 'article:content_id_fail' ), NULL, $callFunc );
		}
		/* 检查用户 */
		$memberRs = member_query ( $uid );
		if (check_is_array ( $memberRs ) < 1) {
			showmsg ( lang ( 'member:uid_noexist' ), NULL, $callFunc );
		}
		
		/* 检查主题是否存在 */
		if (check_nums ( $aid ) == 1) {
			$ars = $this->article_query ( 'aid', $aid );
			if ($ars == $this->db->cw) {
				showmsg ( lang ( 'global:dbexception' ), NULL, $callFunc );
			}
			if (check_is_array ( $ars ) < 1) {
				showmsg ( lang ( 'article:content_id_noexist' ), NULL, $callFunc );
			}
		}
		
		/* 初始化上传设置 */
		$uploadSets = get_db_set ( array (
				'smodule' => _M (),
				'stype' => article_value_get ( 'set_field', 'picture_upload', 'field' ) 
		) );
		if ($uploadSets == $this->db->cw) {
			showmsg ( lang ( 'global:dbexception' ), NULL, $callFunc );
		}
		if (check_is_array ( $uploadSets ) < 1) {
			showmsg ( lang ( 'global:get_db_set_null' ), NULL, $callFunc );
		}
		$file_arr = $_FILES ['ap_file'];
		
		/* 获取文件信息 */
		$filename_type = getimagesize ( $file_arr ['tmp_name'] );
		/* 图片宽 */
		$file_width = $filename_type [0];
		/* 图片高 */
		$file_height = $filename_type [1];
		/* 图片类型 */
		$file_type = $filename_type ['mime'];
		/* 检查文件类型 */
		$file_type_arr = de_serialize ( config_val ( 'extension', $uploadSets ) );
		if (check_img_type ( $file_type, $file_type_arr ) < 1) {
			$fail_str = array_join_str ( ',', $file_type_arr );
			showmsg ( lang ( 'global:upload_file_type_info', $fail_str ), NULL, $callFunc );
		}
		
		/* 获取上传文件大小 */
		$file_size = ceil ( $file_arr ['size'] / 1024 );
		$fs_config = config_val ( 'size', $uploadSets );
		if ($file_size > ($fs_config * 1024)) {
			$size_str = op2num ( $fs_config, 1024, 3 );
			showmsg ( lang ( 'global:upload_file_size_info', $size_str ), NULL, $callFunc );
		}
		/* 检查上传文件尺寸 */
		$fs_width = config_val ( 'allow_width', $uploadSets );
		$fs_height = config_val ( 'allow_height', $uploadSets );
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
		$dir_config = de_file_dir ( config_val ( 'dir', $uploadSets ) );
		if (create_dir ( $root_dir, $dir_config ) < 1) {
			showmsg ( lang ( 'global:upload_file_dir_noexist' ), NULL, $callFunc );
		}
		/* 重定义文件名 */
		$file_name_ext = get_file_ext ( $file_arr ['name'] );
		$new_name_str = getrand ( 8, 0 ) . '0' . $this->_global ['app'] ['sys_time'];
		$new_file_name = $dir_config . '/' . $new_name_str . '.' . $file_name_ext;
		
		/* 开始事务 */
		$this->db->trans_begin ();
		
		if (check_nums ( $aid ) == 1) {
			$dataArr = array (
					'uid' => $uid,
					'aid' => $aid,
					'file_name' => $new_file_name,
					'file_type' => $file_name_ext,
					'ctime' => $this->sys_time 
			);
			$result = $this->db->db_insert ( $this->table_article_picture, $dataArr );
		} else {
			$dataArr = array (
					'module' => _M (),
					'idtype' => 'aid',
					'uid' => $uid,
					'file_name' => $new_file_name,
					'file_type' => $file_name_ext,
					'ctime' => $this->sys_time 
			);
			$result = common_temp_attachment_add ( $dataArr );
		}
		unset ( $dataArr );
		if ($result == $this->db->cw) {
			/* 回滚事务 */
			$this->db->trans_rollback_end ();
			showmsg ( lang ( 'global:dbexception' ), NULL, $callFunc );
		}
		/* 统计图片 */
		if (check_nums ( $aid ) == 1) {
			$result = $this->picture_coverupdate ( $aid );
			if ($result == $this->db->cw) {
				/* 回滚事务 */
				$this->db->trans_rollback_end ();
				showmsg ( lang ( 'global:dbexception' ), NULL, $callFunc );
			}
		}
		/* 提交事务 */
		$this->db->trans_commit_end ();
		
		/* 上传处理 */
		if (! move_uploaded_file ( $file_arr ['tmp_name'], $root_dir . $new_file_name )) {
			showmsg ( lang ( 'global:upload_file_error' ), NULL, $callFunc );
		}
		/* 检查是否需要处理成缩略图 */
		/*w,h都为0,不处理*/
		$thumb_width = config_val ( 'thumb_width', $uploadSets );
		$thumb_height = config_val ( 'thumb_height', $uploadSets );
		$thumb_quality = config_val ( 'quality', $uploadSets );
		$thumb_status = (check_nums ( $thumb_width ) < 1 && check_nums ( $thumb_height ) < 1) ? 0 : 1;
		if ($thumb_status == 1) {
			$thumb_width = (check_nums ( $thumb_width ) < 1) ? $file_width : $thumb_width;
			$thumb_height = (check_nums ( $thumb_height ) < 1) ? $file_height : $thumb_height;
			imagethumb ( $root_dir . $new_file_name, $root_dir . $new_file_name, $thumb_width, $thumb_height, $thumb_quality );
		} else {
			if (check_nums ( $thumb_quality ) == 1) {
				imagethumb ( $root_dir . $new_file_name, $root_dir . $new_file_name, $file_width, $file_height, $thumb_quality );
			}
		}
		showmsg ( lang ( 'global:dbsuccess' ), NULL, $callFunc_b );
	}
	/* 上传图片封面设置 */
	function picture_cover($picid, $aid) {
		/* 回调参数 */
		$callFunc = msg_func ();
		$callFunc_b = msg_func ( 'callFunc_b' );
		
		$module = _M ();
		if (check_num ( $aid ) < 1) {
			showmsg ( lang ( 'article:content_id_fail' ), NULL, $callFunc );
		}
		if (check_nums ( $picid ) < 1) {
			showmsg ( lang ( 'global:param_id_fail' ), NULL, $callFunc );
		}
		/* 开始事务 */
		$this->db->trans_begin ();
		
		/* 检查是否存在 */
		if (check_nums ( $aid ) == 1) {
			$picRs = $this->picture_query ( 'picid', $picid );
		} else {
			$picRs = common_temp_attachment_query ( 'attachid', $picid );
		}
		if ($picRs == $this->db->cw) {
			/* 回滚事务 */
			$this->db->trans_rollback_end ();
			showmsg ( lang ( 'global:dbexception' ), NULL, $callFunc );
		}
		if (check_is_array ( $picRs ) < 1) {
			/* 回滚事务 */
			$this->db->trans_rollback_end ();
			showmsg ( lang ( 'article:picture_picid_noexist' ), NULL, $callFunc_b );
		}
		/* 是否已设置封面 */
		if ($picRs ['iscover'] == 1) {
			/* 回滚事务 */
			$this->db->trans_rollback_end ();
			showmsg ( lang ( 'global:dbsuccess' ), NULL, $callFunc_b );
		}
		$uid = $picRs ['uid'];
		unset ( $picRs );
		/* 检查是否存在封面 */
		if (check_nums ( $aid ) == 1) {
			$qc = $this->picture_query ( array (
					'aid' => $aid,
					'iscover' => 1 
			) );
		} else {
			$qc = common_temp_attachment_query ( array (
					'module' => $module,
					'idtype' => 'aid',
					'uid' => $uid 
			) );
		}
		if ($qc == $this->db->cw) {
			/* 回滚事务 */
			$this->db->trans_rollback_end ();
			showmsg ( lang ( 'global:dbexception' ), NULL, $callFunc );
		}
		/* 取消其他封面 */
		if (check_is_array ( $qc ) == 1) {
			unset ( $qc );
			if (check_nums ( $aid ) == 1) {
				$result = $this->db->db_update ( $this->table_article_picture, array (
						'iscover' => 0 
				), array (
						'aid' => $aid,
						'iscover' => 1 
				) );
			} else {
				$result = common_temp_attachment_edit ( array (
						'iscover' => 1 
				), array (
						'module' => $module,
						'idtype' => 'aid',
						'uid' => $uid,
						'iscover' => 1 
				) );
			}
			if ($result == $this->db->cw) {
				/* 回滚事务 */
				$this->db->trans_rollback_end ();
				showmsg ( lang ( 'global:dbexception' ), NULL, $callFunc );
			}
		}
		/* 设置封面 */
		if (check_nums ( $aid ) == 1) {
			$result = $this->db->db_update ( $this->table_article_picture, array (
					'iscover' => 1 
			), 'picid', $picid );
		} else {
			$result = common_temp_attachment_edit ( array (
					'iscover' => 1 
			), 'attachid', $picid );
		}
		if ($result == $this->db->cw) {
			/* 回滚事务 */
			$this->db->trans_rollback_end ();
			showmsg ( lang ( 'global:dbexception' ), NULL, $callFunc );
		}
		/* 重置封面 */
		if (check_nums ( $aid ) == 1) {
			$result = $this->picture_coverupdate ( $aid );
			if ($result == $this->db->cw) {
				/* 回滚事务 */
				$this->db->trans_rollback_end ();
				showmsg ( lang ( 'global:dbexception' ), NULL, $callFunc );
			}
		}
		/* 提交事务 */
		$this->db->trans_commit_end ();
		showmsg ( lang ( 'global:dbsuccess' ), NULL, $callFunc_b );
	}
	/* 上传图片封面取消 */
	function picture_covercancel($picid, $aid) {
		/* 回调参数 */
		$callFunc = msg_func ();
		$callFunc_b = msg_func ( 'callFunc_b' );
		
		if (check_num ( $aid ) < 1) {
			showmsg ( lang ( 'article:content_id_fail' ), NULL, $callFunc );
		}
		if (check_nums ( $picid ) < 1) {
			showmsg ( lang ( 'global:param_id_fail' ), NULL, $callFunc );
		}
		/* 开始事务 */
		$this->db->trans_begin ();
		
		/* 检查是否存在 */
		if (check_nums ( $aid ) == 1) {
			$picRs = $this->picture_query ( 'picid', $picid );
		} else {
			$picRs = common_temp_attachment_query ( 'attachid', $picid );
		}
		if ($picRs == $this->db->cw) {
			/* 回滚事务 */
			$this->db->trans_rollback_end ();
			showmsg ( lang ( 'global:dbexception' ), NULL, $callFunc );
		}
		if (check_is_array ( $picRs ) < 1) {
			/* 回滚事务 */
			$this->db->trans_rollback_end ();
			showmsg ( lang ( 'article:picture_picid_noexist' ), NULL, $callFunc_b );
		}
		/* 是否已设置封面 */
		if ($picRs ['iscover'] != 1) {
			/* 回滚事务 */
			$this->db->trans_rollback_end ();
			showmsg ( lang ( 'global:dbsuccess' ), NULL, $callFunc_b );
		}
		unset ( $picRs );
		/* 取消封面 */
		if (check_nums ( $aid ) == 1) {
			$result = $this->db->db_update ( $this->table_article_picture, array (
					'iscover' => 0 
			), 'picid', $picid );
		} else {
			$result = common_temp_attachment_edit ( array (
					'iscover' => 0 
			), 'attachid', $picid );
		}
		if ($result == $this->db->cw) {
			/* 回滚事务 */
			$this->db->trans_rollback_end ();
			showmsg ( lang ( 'global:dbexception' ), NULL, $callFunc );
		}
		/* 重置封面 */
		if (check_nums ( $aid ) == 1) {
			$result = $this->picture_coverupdate ( $aid );
			if ($result == $this->db->cw) {
				/* 回滚事务 */
				$this->db->trans_rollback_end ();
				showmsg ( lang ( 'global:dbexception' ), NULL, $callFunc );
			}
		}
		/* 提交事务 */
		$this->db->trans_commit_end ();
		showmsg ( lang ( 'global:dbsuccess' ), NULL, $callFunc_b );
	}
	/* 上传图片删除 */
	function upload_del($picid, $aid) {
		/* 回调参数 */
		$callFunc = msg_func ();
		$callFunc_b = msg_func ( 'callFunc_b' );
		
		if (check_num ( $aid ) < 1) {
			showmsg ( lang ( 'article:content_id_fail' ), NULL, $callFunc );
		}
		if (check_nums ( $picid ) < 1) {
			showmsg ( lang ( 'global:param_id_fail' ), NULL, $callFunc );
		}
		/* 开始事务 */
		$this->db->trans_begin ();
		
		/* 检查是否存在 */
		if (check_nums ( $aid ) == 1) {
			$picRs = $this->picture_query ( 'picid', $picid );
		} else {
			$picRs = common_temp_attachment_query ( 'attachid', $picid );
		}
		if ($picRs == $this->db->cw) {
			/* 回滚事务 */
			$this->db->trans_rollback_end ();
			showmsg ( lang ( 'global:dbexception' ), NULL, $callFunc );
		}
		if (check_is_array ( $picRs ) < 1) {
			/* 回滚事务 */
			$this->db->trans_rollback_end ();
			showmsg ( lang ( 'article:picture_picid_noexist' ), NULL, $callFunc_b );
		}
		/* 取出原图 */
		$file_name = $picRs ['file_name'];
		unset ( $picRs );
		/* 删除图片 */
		$pic_src = show_uf ( $file_name, true );
		if (check_is_file ( $pic_src ) == 1) {
			serachfile_del ( $pic_src . '*', false );
			/* 检查目录是否为空 */
			$file_arr = get_fs ( $pic_src, true );
			check_null_dir ( $file_arr ['dir_name'], true );
		}
		/* 删除图片记录 */
		if (check_nums ( $aid ) == 1) {
			$result = $this->db->db_delete ( $this->table_article_picture, 'picid', $picid );
		} else {
			$result = common_temp_attachment_del ( 'attachid', $picid );
		}
		if ($result == $this->db->cw) {
			/* 回滚事务 */
			$this->db->trans_rollback_end ();
			showmsg ( lang ( 'global:dbexception' ), NULL, $callFunc );
		}
		/* 重置封面 */
		if (check_nums ( $aid ) == 1) {
			$result = $this->picture_coverupdate ( $aid );
			if ($result == $this->db->cw) {
				/* 回滚事务 */
				$this->db->trans_rollback_end ();
				showmsg ( lang ( 'global:dbexception' ), NULL, $callFunc );
			}
		}
		/* 提交事务 */
		$this->db->trans_commit_end ();
		showmsg ( lang ( 'global:dbsuccess' ), NULL, $callFunc_b );
	}
	/* 图片删除 */
	function pictrue_del($picid) {
		/* 回调参数 */
		$callbackUrl = msg_param ();
		$callFunc = msg_func ();
		$callFunc_b = msg_func ( 'callFunc_b' );
		
		if (check_is_array ( $picid ) < 1) {
			showmsg ( lang ( 'global:param_ids_null' ), NULL, $callFunc );
		}
		$arr = array ();
		foreach ( $picid as $v ) {
			if (check_nums ( $v ) < 1) {
				showmsg ( lang ( 'global:param_ids_fail' ), $callbackUrl, $callFunc );
			}
			/* 检查是否存在 */
			$picRs = $this->picture_query ( 'picid', $v );
			if ($picRs == $this->db->cw) {
				showmsg ( lang ( 'global:dbexceptions' ), $callbackUrl, $callFunc_b );
			}
			if (check_is_array ( $picRs ) < 1) {
				continue;
			}
			/* 主题id */
			if (check_nums ( $picRs ['aid'] ) == 1) {
				$arr [$picRs ['aid']] = $picRs ['aid'];
			}
			/* 取出原图 */
			$file_name = $picRs ['file_name'];
			unset ( $picRs );
			/* 删除图片 */
			$pic_src = show_uf ( $file_name, true );
			if (check_is_file ( $pic_src ) == 1) {
				serachfile_del ( $pic_src . '*', false );
				/* 检查目录是否为空 */
				$file_arr = get_fs ( $pic_src, true );
				check_null_dir ( $file_arr ['dir_name'], true );
			}
			/* 删除图片记录 */
			$result = $this->db->db_delete ( $this->table_article_picture, 'picid', $v );
			if ($result == $this->db->cw) {
				showmsg ( lang ( 'global:dbexceptions' ), $callbackUrl, $callFunc_b );
			}
		}
		/* 重置主题封面 */
		$result = $this->picture_coverupdate ( $arr );
		if ($result == $this->db->cw) {
			showmsg ( lang ( 'global:dbexception' ), NULL, $callFunc );
		}
		showmsg ( lang ( 'global:dbsuccess' ), $callbackUrl, $callFunc_b );
	}
}
?>