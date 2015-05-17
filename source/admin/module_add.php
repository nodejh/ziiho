<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}

$module = _M ();

/* 回调url */
$callbackurl = get_current_url ( false, adm_cookieurlkey () );

/* 初始化参数 */
$moduleSub = NULL;
/* 保存url */
$saveurl = url ( 'index', 'mod/admin/ac/module/op/module_adddo' );

include modtemplate ( $module . '/template/module_edit' );
?>