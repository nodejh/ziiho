<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}

$module = _M ();

/* 设置当前url */
$callback_url = set_current_url ( false, true, adm_cookieurlkey () );

include modtemplate ( $module . '/template/database_sql_query' );
?>