<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}

$module = _M ();

$uid = get_user ( 'uid' );
/* 检查是否登录状态 */
if (check_nums ( $uid ) < 1) {
	showmsg ( lang ( 'member:member_logout_no_exists' ) );
}

include subtemplate ( $module . '/m_logout' );
?>