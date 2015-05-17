<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}

$module = _M ();

$uid = get_user ( 'uid' );

/* 获取配置 */
$sets = get_db_set ( array (
		'smodule' => $module,
		'stype' => article_value_get ( 'set_field', 'picture_upload', 'field' ) 
) );
/* 文件扩展名 */
$uf_extension = NULL;
if (check_is_array ( $sets ) == 1) {
	$uf_size = op2num ( config_val ( 'size', $sets ), 1024, 3 );
	$uf_extension = ext2str ( de_serialize ( config_val ( 'extension', $sets ) ) );
	/* 显示信息 */
	$upload_file_info = lang ( 'global:upload_file_info', array (
			config_val ( 'size', $sets ),
			$uf_extension 
	) );
}

include subtemplate ( $module . '/content_picture_upload' );
?>