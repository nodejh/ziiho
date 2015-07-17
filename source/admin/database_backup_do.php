<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}

$module = _M ();

$callFunc = msg_func ();
$callFunc_b = msg_func ( 'callFunc_b' );

/* 获取将要备份的数据表 */
$tables = post_array_param ( 'tables' );
/* 分卷大小 */
$splitsize = post_param ( 'splitsize' );
/* 是否备份表结构信息 */
$isstruct = post_param ( 'isstruct' );
/* 是否生成解除表信息 */
$isuntableinfo = post_param ( 'isuntableinfo' );
/* 是否选择了表 */
if (check_is_array ( $tables ) < 1) {
	showmsg ( lang ( 'admin:database_backup_table_null' ), NULL, $callFunc );
}
/* 默认为2M */
if (check_nums ( $splitsize ) < 1) {
	$splitsize = 2048;
}
/* 默认备份表结构 */
if (check_num ( $isstruct ) < 1) {
	$isstruct = yesno_val ( 'normal' );
}
/* 默认不生成解除表信息 */
if (check_num ( $isuntableinfo ) < 1) {
	$isuntableinfo = yesno_val ( 'check' );
}
$rdStr = getrand ( 10 );
$fileNameStr = date ( 'YmdHis' );
/* mysql管理类 */
$adm_mySql = loader ( 'class:class_admin_mysql', $module, true, true );
/* 备份操作 */
$adm_mySql->bdir = $rdStr;

if ($isuntableinfo != yesno_val ( 'check' )) {
	$adm_mySql->bunfilename = 'un_' . $fileNameStr;
}

$adm_mySql->bfilename = $fileNameStr;
$adm_mySql->btype = $isstruct;
$adm_mySql->bsize = $splitsize;
$result = $adm_mySql->backup ( $tables, $splitsize );
if (! is_array ( $result )) {
	showmsg ( lang ( 'admin:database_backup_fail' ), NULL, $callFunc );
} else {
	showmsg ( lang ( 'admin:database_backup_success', $result ), NULL, $callFunc );
}
?>