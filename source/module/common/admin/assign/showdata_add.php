<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}

$module = _M ();

/* 初始化参数 */
$uid = get_user ( 'uid' );
$showdata = NULL;
/* 组 */
$g = loader ( 'class:class_common_showgroup', _M (), true, true );
list ( $pg, $showgroup_list ) = $g->group_list ( 50, 7, 1, order_val () );

/* 保存url */
$save_url = url ( 'index', 'mod/common/ac/admin/op/show/ao/data/bo/data_adds' );
/* 返回url */
$callback_url = get_current_url ( false, adm_cookieurlkey () );

/* 上传类型 */
$filetype = config_value_get ( 'imgageuploadtype' );
/* 上传大小 */
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

include modtemplate ( $module . '/admin/template/showdata_edit' );
?>