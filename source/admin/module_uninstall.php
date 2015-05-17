<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}

$module = _M ();

/* 回调url */
$callback_url = get_current_url ( false, adm_cookieurlkey () );

$moduleFlag = get_param ( 'moduleflag' );
$moduleFlagData = get_module_info ( $moduleFlag );

if (! get_module_isValid ( $moduleFlag )) {
	showmsg ( lang ( 'admin:module_fail' ), $callback_url );
}
if (! get_module_isDir ( $moduleFlag )) {
	showmsg ( lang ( 'admin:module_dir_noexist' ), $callback_url );
}
if (! get_module_isInstall ( $moduleFlag )) {
	showmsg ( lang ( 'admin:module_no_install' ), $callback_url );
}

include modtemplate ( $module . '/template/module_uninstall' );
?>