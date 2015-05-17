<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}

$module = _M ();

/* 当前登录会员 */
$uid = get_user ( 'uid' );

/* 获取配置信息 */
$uploadSet = get_db_set ( array (
		'smodule' => 'member',
		'stype' => member_value_get ( 'set_field', 'avatar_set', 'field' ) 
) );
if (check_is_array ( $uploadSet ) < 1) {
	showmsg ( lang ( 'common:getdbset_null' ) );
}
if (check_is_array ( $uploadSet ) == 1) {
	$uf_size = op2num ( config_val ( 'size', $uploadSet ), 1024, 3 );
	$uf_extension = ext2str ( de_serialize ( config_val ( 'extension', $uploadSet ) ) );
	/* 信息 */
	$avatar_imagesize_info = lang ( 'member:avatar_imagesize_info', array (
			config_val ( 'crop_minwidth', $uploadSet ),
			config_val ( 'crop_minheight', $uploadSet ) 
	) );
	$upload_file_info = lang ( 'global:upload_file_info', array (
			config_val ( 'size', $uploadSet ),
			$uf_extension 
	) );
	$upload_imagesize_info = lang ( 'global:upload_imagesize_info', array (
			config_val ( 'allow_width', $uploadSet ),
			config_val ( 'allow_height', $uploadSet ) 
	) );
}

/* 头像类 */
$aObj = loader ( 'class:class_member_avatar', $module, true, true );

/* 获取原头像 */
$avatar = $aObj->avatar_query ( 'uid', $uid );
$old_avatar = NULL;
if (check_is_array ( $avatar ) == 1) {
	$old_avatar = show_uf ( array_key_val ( 'file_name', $avatar ) );
}
unset ( $avatar );

/* 是否存在临时头像 */
$temp_avatar = $aObj->avatar_temp_query ( 'uid', $uid );
if (check_is_array ( $temp_avatar ) == 1) {
	/* 得到图片地址 */
	$temp_avatar_src = show_uf ( $temp_avatar ['file_name'], true );
	/* 如果头像为编辑过 */
	if ($temp_avatar ['isedited'] != yesno_val ( 'check' )) {
		/* 检查图片是否存在 */
		if (check_is_file ( $temp_avatar_src ) == 1) {
			/* 得到图片信息 */
			$fileInfo = image_size ( $temp_avatar_src );
			/* 裁剪选区框最小尺寸 */
			$crop_min_width = config_val ( 'crop_minwidth', $uploadSet );
			$crop_min_height = config_val ( 'crop_minheight', $uploadSet );
			if (check_nums ( $crop_min_width ) < 1 || $crop_min_width > $fileInfo [0]) {
				$crop_min_width = $fileInfo [0];
			}
			if (check_nums ( $crop_min_height ) < 1 || $crop_min_height > $fileInfo [1]) {
				$crop_min_height = $fileInfo [1];
			}
		}
	}
	$temp_avatar_src = show_uf ( $temp_avatar ['file_name'] );
}

include subtemplate ( $module . '/setting_avatar_upload' );
?>