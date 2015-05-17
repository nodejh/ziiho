<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}

$module = _M ();

/* 返回url */
$callback_url = get_current_url ( false, adm_cookieurlkey () );

/* 当前操作会员 */
$uid = get_user ( 'uid' );
/* 获取上传类型 */
$filetype = config_value_get ( 'imgageuploadtype' );
/* 获取大小 */
$filesize = op2num ( config_value_get ( 'imgageuploadsize', 'size' ), 1024, 3 );

$filetypes = NULL;
if (check_is_array ( $filetype ) == 1) {
	foreach ( $filetype as $val ) {
		if (! empty ( $filetypes )) {
			$filetypes .= ';';
		}
		$filetypes .= '*.' . $val ['val'];
	}
}
/* 显示信息 */
$upload_file_info = lang ( 'global:upload_file_info', array (
		config_value_get ( 'imgageuploadsize', 'size' ),
		$filetypes 
) );
$allow_num = lang ( 'global:upload_file_allow_num', 10 );

/* 分组类 */
$eg = loader ( 'class:class_common_emotional_group', $module, true, true );
$emotGroupResult = $eg->group_list ();
$emotGroupResult = array_key_val ( 1, $emotGroupResult );

include modtemplate ( $module . '/admin/template/emotional_upload' );
?>