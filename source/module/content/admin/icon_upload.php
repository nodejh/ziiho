<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}

$module = _M ();

$uid = get_user ( 'uid' );
$iconid = get_int_param ( 'iconid', 0 );

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

include modtemplate ( $module . '/admin/template/icon_upload' );
?>