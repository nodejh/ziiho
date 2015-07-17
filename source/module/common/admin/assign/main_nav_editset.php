<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}

$module = _M ();

/* 返回url */
$callback_url = get_current_url ( false, adm_cookieurlkey () );

$navid = get_int_param ( 'navid' );
if (check_nums ( $navid ) < 1) {
	showmsg ( lang ( 'admin:param_id_fail' ), $callback_url );
}
$navObj = loader ( 'class:class_common_nav_admin', $module, true, true );
$navsub = $navObj->nav_query ( 'navid', $navid );
if (check_is_array ( $navsub ) < 1) {
	showmsg ( lang ( 'admin:param_notexist' ), $callback_url );
}
/* 获取导航列表 */
$tpl = modtemplate ( $module . '/admin/template/nav_option' );
$navtype = common_nav_type ( 'main' );
$nav_options = $navObj->nav_all ( $tpl, $navtype, $navid, true );
/* 操作url */
$saveurl = url ( 'index', 'mod/common/ac/admin/op/nav/ao/main_editsets' );

include modtemplate ( $module . '/admin/template/main_nav_editset' );
?>