<?php
if (! defined ( 'IN_INSTALL' )) {
	exit ( 'no direct access allowed' );
}

if (! function_exists ( 'module_admin_install' )) {
	function module_admin_install($ins_ModuleFlag, $sysRootDir, $webRootDir, $param = NULL) {
		$ins_ModuleDir = 'source/module/' . $ins_ModuleFlag . '/';
		$ins_InstallDir = $sysRootDir . $ins_ModuleDir . 'install/';
		if (IN_INSTALL != 'sys') {
			$MMysql = loader ( 'class:class_admin_mysql', 'admin', true, true );
		}
		/* 表结构 */
		$ins_TableStructFile = $ins_InstallDir . 'install.sql';
		if (! is_file ( $ins_TableStructFile )) {
			$msgStr = '文件不存在:' . $webRootDir . $ins_ModuleDir . 'install/install.sql';
			return $msgStr;
		}
		if (IN_INSTALL != 'sys') {
			$result = $MMysql->restore ( $ins_TableStructFile, 'create' );
		} else {
			$result = _GetFileCreateTable ( $param ['dbConn'], $ins_TableStructFile, $param );
		}
		if (! $result) {
			$msgStr = '安装' . $ins_ModuleFlag . '模块，创建表结构异常';
			return $msgStr;
		}
		/* 表数据 */
		$ins_TableDataFile = $ins_InstallDir . 'install_data.sql';
		if (is_file ( $ins_TableDataFile )) {
			if (IN_INSTALL != 'sys') {
				$result = $MMysql->restore ( $ins_TableDataFile, 'insert' );
			} else {
				$result = _GetFileImportTableData ( $param ['dbConn'], $ins_TableDataFile, $param );
			}
			if (! $result) {
				$msgStr = '安装' . $ins_ModuleFlag . '模块，导入默认数据异常';
				return $msgStr;
			}
		}
		return true;
	}
}
?>