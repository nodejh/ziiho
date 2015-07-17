<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}

$module = _M ();

$navtype = common_nav_type ( 'main' );
$navObj = loader ( 'class:class_common_nav_admin', $module, true, true );
/* 获取导航 */
$tpl = modtemplate ( $module . '/admin/template/main_nav_list' );
$lists = $navObj->nav_all ( $tpl, $navtype );

/* 回调url */
$callback_url = set_current_url ( false, true, adm_cookieurlkey () );

include modtemplate ( $module . '/admin/template/main_nav' );
?>