<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}

/* 删除表 */
$ins_TableFile = $ins_ModuleInstallDir . 'uninstall.sql';
if (! is_file ( $ins_TableFile )) {
	$msgStr = ($_G ['web'] ['sourcepath']) . 'module/' . $moduleFlagData ['module'] . '/install/uninstall.sql';
	showmsg ( lang ( 'admin:module_file_noexist', $msgStr ), NULL, $callFunc );
}
$MMysql = loader ( 'class:class_admin_mysql', 'admin', true, true );
$result = $MMysql->restore ( $ins_TableFile, 'droptable' );
if (! $result) {
	showmsg ( lang ( 'admin:module_uninstall_droptable_exception' ), NULL, $callFunc_b );
}
?>