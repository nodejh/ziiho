<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}

$module = _M ();

/* 返回url */
$callback_url = get_current_url ( true );

/* 是否为登录状态 */
if (check_is_array ( get_user () ) == 1) {
	showmsg ( lang ( 'member:logined' ), $callback_url );
}
/* 获取设置 */
$sets = get_db_set ( array (
		'smodule' => $module,
		'stype' => member_value_get ( 'set_field', 'baseset', 'field' ) 
) );
if (check_is_array ( $sets ) < 1) {
	showmsg ( lang ( 'common:getdbset_null' ), $callback_url );
}
/* 是否允许登录 */
if (config_val ( 'allowlogin', $sets, yesno_val ( 'check' ) ) == yesno_val ( 'check' )) {
	showmsg ( lang ( 'member:loginclose' ), $callback_url );
}

include subtemplate ( $module . '/login' );
?>