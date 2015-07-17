<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}

$module = _M ();

/* 回调url */
$callbackurl = get_current_url ( false, adm_cookieurlkey () );

$moduleid = get_int_param ( 'moduleid' );
if (check_nums ( $moduleid ) < 1) {
	showmsg ( lang ( 'admin:param_id_fail' ), $callbackurl );
}
$mObj = loader ( 'class:class_common_module', 'common', true, true );
$moduleSub = $mObj->module_query ( 'moduleid', $moduleid );
if (check_is_array ( $moduleSub ) < 1) {
	showmsg ( lang ( 'admin:module_noexist' ), $callbackurl );
}
/* 保存url */
$saveurl = url ( 'index', 'mod/admin/ac/module/op/module_editdo' );

include modtemplate ( $module . '/template/module_edit' );
?>