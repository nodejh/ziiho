<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}

$module = _M ();

set_time_limit ( 0 );
/* 设置当前url */
$callback_url = set_current_url ( false, true, adm_cookieurlkey () );

/* 版本 */
$mysqlVersion = $_G ['db']->mysql_server ( 1 );
/* 数据表 */
$dbTableResult = $_G ['db']->_show_tables ();
/* 数据库大小 */
$dbSize = $_G ['db']->get_db_size ();

include modtemplate ( $module . '/template/database_backup' );
?>