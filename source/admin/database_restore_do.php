<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}

$module = _M ();

$callbackUrl = msg_param ();
$callFunc = msg_func ();
$callFunc_b = msg_func ( 'callFunc_b' );

/* 还原数据文件 */
$restorefile = post_array_param ( 'restorefile' );
/* 是否还原表结构 */
$restore_table_struct = post_int_param ( 'restore_table_struct' );
/* 还原后是否删除备份文件 */
$isdelbackup = post_int_param ( 'isdelbackup' );

if (check_is_array ( $restorefile ) < 1) {
	showmsg ( lang ( 'admin:database_restore_file_null' ), NULL, $callFunc );
}
/* 数据备份的目录 */
$backUpPath = $_G ['app'] ['path_data'] . 'backup/';
/* 操作数据库类 */
$MMysql = loader ( 'class:class_admin_mysql', $module, true, true );
foreach ( $restorefile as $rDir ) {
	$dirPath = $backUpPath . $rDir;
	if (! is_dir ( $dirPath )) {
		showmsg ( lang ( 'admin:database_restore_dir_noexist' ), $callbackUrl, $callFunc_b );
	}
	/* 还原表结构 */
	if ($restore_table_struct == yesno_val ( 'check' )) {
		$tableFiles = get_file_list ( $dirPath, 'file' );
		$tableFileName = NULL;
		if (is_array ( $tableFiles )) {
			foreach ( $tableFiles as $tableFile ) {
				/* 获取表结构 */
				if (preg_match ( "/^([a-zA-Z0-9]+)\.sql$/i", $tableFile ['name'], $match )) {
					$tableFileName = $tableFile ['name'];
					break;
				}
			}
		}
		unset ( $tableFiles );
		$tableStructFile = $dirPath . '/' . $tableFileName;
		
		if (strlen ( $tableFileName ) < 1 || ! is_file ( $tableStructFile )) {
			showmsg ( lang ( 'admin:database_restore_table_struct_noexist', $rDir ), $callbackUrl, $callFunc_b );
		}
		$result = $MMysql->restore ( $tableStructFile, 'create' );
		if (! $result) {
			showmsg ( lang ( 'admin:database_restore_table_struct_exception' ), $callbackUrl, $callFunc_b );
		}
	}
	/* 还原数据 */
	$dataFile = get_file_list ( $dirPath, 'file' );
	if (is_array ( $dataFile )) {
		if (is_array ( $dataFile )) {
			foreach ( $dataFile as $dFile ) {
				/* 获取表结构 */
				if (preg_match ( "/^([a-zA-Z0-9]+)\.sql$/i", $dFile ['name'], $match )) {
					continue;
				}
				/* 排除删除表的文件 */
				if (preg_match ( "/^un_([a-zA-Z0-9_]+)\.sql$/i", $dFile ['name'], $match )) {
					continue;
				}
				$result = $MMysql->restore ( $dirPath . '/' . $dFile ['name'], 'insert' );
				if (! $result) {
					showmsg ( lang ( 'admin:database_restore_data_exception' ), $callbackUrl, $callFunc_b );
				}
			}
		}
	}
	/* 删除备份文件 */
	if ($isdelbackup == yesno_val ( 'check' )) {
		$result = delete_dir ( $backUpPath, $rDir );
		if ($result < 1) {
			showmsg ( lang ( 'admin:database_restore_backup_del_fail' ), $callbackUrl, $callFunc_b );
		}
	}
}

if ($isdelbackup != yesno_val ( 'check' )) {
	showmsg ( lang ( 'admin:database_restore_success' ), NULL, $callFunc );
} else {
	showmsg ( lang ( 'admin:database_restore_success2' ), $callbackUrl, $callFunc_b );
}
?>