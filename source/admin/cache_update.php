<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}

$module = _M ();

/* 设置当前url */
$callbackurl = set_current_url ( false, true, adm_cookieurlkey () );

include modtemplate ( $module . '/template/cache_update' );
?>