<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}

$module = _M ();

/* 当前登录会员 */
$uid = get_user ( 'uid' );

include subtemplate ( $module . '/setting_credit_my' );
?>