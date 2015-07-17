<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}

$module = _M ();

/* 回调参数 */
$url = msg_param ();
$callFunc = msg_func ();

$status = post_param ( 'status' );

$param = NULL;
if (! empty ( $status )) {
	$param .= '/status/' . $status;
}
showmsg ( NULL, url ( 'index', 'mod/common/ac/admin/op/invitecode/ao/manager' . $param ), 'redirectUrl' );
?>