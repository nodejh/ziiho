<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}

$module = _M ();

/* 当前登录会员 */
$uid = get_user ( 'uid' );

/* 获取配置 */
$sets = get_db_set ( array (
		'smodule' => $module,
		'stype' => member_value_get ( 'set_field', 'baseset', 'field' ) 
) );
if (check_is_array ( $sets ) < 1) {
	showmsg ( lang ( 'global:get_db_set_null' ) );
}
$password_info = lang ( 'member:password_info', array (
		config_val ( 'password_min', $sets ),
		config_val ( 'password_max', $sets ) 
) );
/* 获取用户 */
$member = member_query ( $uid, false );

include subtemplate ( $module . '/setting_password' );
?>