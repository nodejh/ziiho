<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}

$module = _M ();

/* 设置当前url */
$callbackurl = set_current_url ( false, true, adm_cookieurlkey () );

/* 模块 */
$mList = get_module_list ();

/* 当前url */
$pg ['name'] = 'index';
$pg ['param'] = 'mod/admin/ac/module/op/module';

include modtemplate ( $module . '/template/module' );
?>