<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}

$module = _M ();

/* 回调参数 */
$url = msg_param ();
$callFunc = msg_func ();

$status = post_param ( 'q_status' );
$uid = post_int_param ( 'q_uid' );
$username = post_param ( 'q_username' );
$day = post_int_param ( 'q_day' );
$order = post_int_param ( 'q_order' );
$num = post_int_param ( 'q_num' );

$param = NULL;
if (! empty ( $status )) {
	$param .= '/q_status/' . $status;
}
if (! empty ( $uid )) {
	$param .= '/q_uid/' . $uid;
}
if (! empty ( $username )) {
	$param .= '/q_username/' . $username;
}
if (! empty ( $day )) {
	$param .= '/q_day/' . $day;
}
if (! empty ( $order )) {
	$param .= '/q_order/' . $order;
}
if (! empty ( $num )) {
	$param .= '/q_num/' . $num;
}
showmsg ( NULL, url ( 'index', 'mod/member/ac/admin/op/operation/ao/search' . $param ), 'redirectUrl' );
?>