<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}
class class_admin_database extends class_model {
	
	/* 析构函数 */
	function __construct() {
		parent::__construct ();
	}
	function class_admin_database() {
		$this->__construct ();
	}
	
	/* 删除备份文件 */
	function _backup_del($restorefile) {
		/* 回调参数 */
		$callbackUrl = msg_param ();
		$callFunc = msg_func ();
		$callFunc_b = msg_func ( 'callFunc_b' );
		
		if (check_is_array ( $restorefile ) < 1) {
			showmsg ( lang ( 'admin:database_restore_file_null' ), NULL, $callFunc );
		}
		global $_G;
		/* 数据备份的目录 */
		$backUpPath = $_G ['app'] ['path_data'] . 'backup/';
		foreach ( $restorefile as $rFile ) {
			$filenamePath = $backUpPath . $rFile;
			if (is_file ( $filenamePath )) {
				$result = delf ( $filenamePath );
			} elseif (is_dir ( $filenamePath )) {
				$result = delete_dir ( $backUpPath, $rFile );
			} else {
				continue;
			}
			if ($result < 1) {
				showmsg ( lang ( 'admin:database_restore_backup_del_fail' ), $callbackUrl, $callFunc_b );
			}
		}
		showmsg ( lang ( 'admin:database_restore_backup_del_success' ), $callbackUrl, $callFunc_b );
	}
}
?>