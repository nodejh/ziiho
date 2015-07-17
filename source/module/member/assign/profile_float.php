<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}

$module = _M ();

/* 获取会员id */
$param_uid = post_int_param ( 'uid' );
if (check_nums ( $param_uid ) < 1) {
	showmsg ( lang ( 'member:uid_fail' ) );
}
/* 查询会员 */
$member = member_query ( $param_uid, true );

if (check_is_array ( $member ) < 1) {
	showmsg ( lang ( 'member:uid_no_exists' ) );
}

include subtemplate ( $module . '/profile_float' );
?>