<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}

$module = _M ();

/* 回调参数 */
$msg_call_url = msg_param ();
$msg_call = msg_func ();
$msg_call_b = msg_func ( 'msg_call_b' );

/* 获取uid */
$uid = post_int_param ( 'uid' );
/* 获取用户名 */
$username = post_param ( 'username' );
$_where = array ();

/* 检查uid */
if (check_nums ( $uid ) == 1) {
	$_where ['uid'] = $uid;
}
/* 检查username */
if (str_len ( $username ) >= 1) {
	if (check_enl_len ( $username ) == 1) {
		$_where ['username'] = $username;
	}
}
if (check_is_array ( $_where ) < 1) {
	ajaxmsg ( lang ( 'member_adm:message_search_fail' ), NULL, $msg_call );
}
/* 显示结果 */
ajaxmsg ( lang ( 'member_adm:message_search_fail' ), modelurl ( 159, $_where ), $msg_call_b );
?>