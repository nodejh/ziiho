<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}

$module = _M ();

/* 回调url */
$callback_url = get_current_url ( false, adm_cookieurlkey () );
/* 导航类 */
$navObj = loader ( 'class:class_common_nav_admin', $module, true, true );

/* 获取上级导航参数 */
$navid = get_int_param ( 'navid', 0 );
/* 是否添加子导航 */
if (check_nums ( $navid ) == 1) {
	$navsub = $navObj->nav_query ( 'navid', $navid );
	if (check_is_array ( $navsub ) < 1) {
		showmsg ( lang ( 'common_adm:nav_parent_notexist' ), $callback_url );
	}
}
/* 初始化参数 */
$navsub = NULL;
/* 导航列表 */
$tpl = modtemplate ( $module . '/admin/template/nav_option' );
$navtype = common_nav_type ( 'main' );
$nav_options = $navObj->nav_all ( $tpl, $navtype, $navid );
/* 操作url */
$saveurl = url ( 'index', 'mod/common/ac/admin/op/nav/ao/main_addsets' );

include modtemplate ( $module . '/admin/template/main_nav_editset' );
?>