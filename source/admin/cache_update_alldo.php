<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}

$module = _M ();

$callFunc = msg_func ();
$callFunc_b = msg_func ( 'callFunc_b' );

$dataDir = $_G ['app'] ['path_data'];
$cacheDir = 'cache';

$cacheStatus = delete_dir ( $dataDir, $cacheDir, false );
if (! _isbool ( $cacheStatus )) {
	showmsg ( lang ( 'admin:cache_update_all_fail' ), NULL, $callFunc_b );
}

showmsg ( lang ( 'admin:cache_update_all_success' ), NULL, $callFunc_b );
?>