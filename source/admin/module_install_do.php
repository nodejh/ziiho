<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}
define ( 'IN_INSTALL', 'hand' );

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
if (get_module_isInstall ( $moduleFlag )) {
	$msgStr = ($_G ['web'] ['sourcepath']) . 'module/' . $moduleFlagData ['module'] . '/install/' . INSTALL_LOCK_FILE;
	showmsg ( lang ( 'admin:module_installed', array (
			INSTALL_LOCK_FILE,
			$msgStr 
	) ), NULL, $callFunc );
}

/* 模块目录 */
$ins_ModuleDir = ($_G ['app'] ['path_source']) . 'module/' . $moduleFlagData ['module'] . DS;
/* 模块安装目录 */
$ins_ModuleInstallDir = $ins_ModuleDir . 'install/';
/* 安装锁定文件 */
$ins_LockFile = $ins_ModuleInstallDir . INSTALL_LOCK_FILE;

/* 安装程序是否存在 */
$ins_FileName = $ins_ModuleInstallDir . 'install.php';
if (! is_file ( $ins_FileName )) {
	$msgStr = ($_G ['web'] ['sourcepath']) . 'module/' . $moduleFlagData ['module'] . '/install/install.php';
	showmsg ( lang ( 'admin:module_file_noexist', $msgStr ), NULL, $callFunc );
}

include $ins_FileName;

/* 运行安装功能 */
$ins_WorkFunc = 'module_' . $moduleFlagData ['module'] . '_install';
if (! function_exists ( $ins_WorkFunc )) {
	$msgStr = ($_G ['web'] ['sourcepath']) . 'module/' . $moduleFlagData ['module'] . '/install/install.php';
	showmsg ( lang ( 'admin:module_install_function_noexist', array (
			$msgStr,
			$ins_WorkFunc 
	) ), NULL, $callFunc );
}
$ins_Status_Debug = $ins_WorkFunc ( $moduleFlagData ['module'], $_G ['app'] ['path'], $_G ['web'] ['rootpath'] );
if (! is_bool ( $ins_Status_Debug )) {
	showmsg ( $ins_Status_Debug, NULL, $callFunc );
}

/* 安装成功,锁定模块 */
$result = write_file_content ( $ins_LockFile, 'ok' );
if (! $result) {
	$msgStr = ($_G ['web'] ['sourcepath']) . 'module/' . $moduleFlagData ['module'] . '/install';
	showmsg ( lang ( 'admin:module_install_create_lockfile_fail', array (
			$moduleFlagData ['module'],
			$msgStr 
	) ), NULL, $callFunc_b );
}
/* 更新缓存 */
module_cache_write ( true );

showmsg ( lang ( 'admin:module_install_success', $moduleFlagData ['module'] ), $callbackUrl, $callFunc_b );
?>