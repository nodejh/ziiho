<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}

$module = _M ();

/* 返回url */
$callback_url = get_current_url ( false, adm_cookieurlkey () );

$uid = get_user ( 'uid' );

$cdataid = get_int_param ( 'cdataid' );
/* 检查tide_id是否合法 */
if (check_nums ( $cdataid ) < 1) {
	showmsg ( lang ( 'global:param_id_fail' ), $callback_url );
}
/* 查询是否存在 */
$d = loader ( 'class:class_common_showdata', _M (), true, true );
$showdata = $d->data_query ( 'cdataid', $cdataid );
if (check_is_array ( $showdata ) < 1) {
	showmsg ( lang ( 'global:param_id_noexist' ), $callback_url );
}
$showdata ['description'] = str_stripslashes ( array_key_val ( 'description', $showdata ) );
/* 组 */
$g = loader ( 'class:class_common_showgroup', _M (), true, true );
list ( $pg, $showgroup_list ) = $g->group_list ( 50, 7, 1, order_val () );
/* 保存url */
$save_url = url ( 'index', 'mod/common/ac/admin/op/show/ao/data/bo/data_edits' );

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