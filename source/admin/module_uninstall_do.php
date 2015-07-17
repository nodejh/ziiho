<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}

set_time_limit ( 0 );

error_reporting ( E_ALL ^ E_NOTICE );
ini_set ( 'display_errors', 'ON' );
/*
 * error_reporting(0); ini_set('display_errors', 'Off');
 */

$module = _M ();

/* 回调参数 */
$callbackUrl = msg_param ();
$callFunc = msg_func ();
$callFunc_b = msg_func ( 'callFunc_b' );

$moduleFlag = post_param ( 'moduleflag' );
$moduleFlagData = get_module_info ( $moduleFlag );

if (! get_module_isValid ( $moduleFlag )) {
	showmsg ( lang ( 'admin:module_fail' ), NULL, $callFunc );
}
if (! get_module_isDir ( $moduleFlag )) {
	showmsg ( lang ( 'admin:module_dir_noexist' ), NULL, $callFunc );
}
if (! get_module_isInstall ( $moduleFlag )) {
	showmsg ( lang ( 'admin:module_no_install' ), NULL, $callFunc );
}

/* 模块目录 */
$ins_ModuleDir = ($_G ['app'] ['path_source']) . 'module/' . $moduleFlagData ['module'] . DS;
/* 模块安装目录 */
$ins_ModuleInstallDir = $ins_ModuleDir . 'install/';
/* 安装锁定文件 */
$ins_LockFile = $ins_ModuleInstallDir . INSTALL_LOCK_FILE;

/* 卸载程序是否存在 */
$ins_FileName = $ins_ModuleInstallDir . 'uninstall.php';
if (! is_file ( $ins_FileName )) {
	$msgStr = ($_G ['web'] ['sourcepath']) . 'module/' . $moduleFlagData ['module'] . '/install/uninstall.php';
	showmsg ( lang ( 'admin:module_file_noexist', $msgStr ), NULL, $callFunc );
}

include $ins_FileName;

/* 删除该模块的锁定文件 */
$result = delf ( $ins_LockFile );
if ($result == - 1) {
	$msgStr = ($_G ['web'] ['sourcepath']) . 'module/' . $moduleFlagData ['module'] . '/install';
	showmsg ( lang ( 'admin:module_uninstall_del_lockfile_fail', array (
			INSTALL_LOCK_FILE,
			$moduleFlagData ['module'],
			$msgStr 
	) ), NULL, $callFunc_b );
}
/* 更新缓存 */
module_cache_write ( true );

showmsg ( lang ( 'admin:module_uninstall_success', $moduleFlagData ['module'] ), $callbackUrl, $callFunc_b );
?>