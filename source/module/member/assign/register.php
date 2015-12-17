<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}

$module = _M ();

/* 返回url */
$callback_url = get_current_url ( true );
/* 是否为登录状态 */
if (check_is_array ( get_user () ) == 1) {
	showmsg ( lang ( 'member:loginedregister' ), $callback_url );
}
/* 获取配置信息 */
$registerSet = get_db_set ( array (
		'smodule' => 'common',
		'stype' => common_value_get ( 'set_field', 'register_set', 'field' ) 
) );
if (check_is_array ( $registerSet ) < 1) {
	showmsg ( lang ( 'global:get_db_set_null' ), $callback_url );
}
/* 获取注册表单配置标记 */
$isSubmitSet = 0;
/* 邀请码 */
$invitecode = NULL;
/* 注册类型 */
switch (config_val ( 'register_type', $registerSet )) {
	/* 普通注册 */
	case common_value_get ( 'allow_register_type', 'ordinary', 'field' ) :
		$isSubmitSet = 1;
		$tempName = 'register';
		break;
	/* 邀请码注册 */
	case common_value_get ( 'allow_register_type', 'invitecode', 'field' ) :
		$invitecode = get_param ( 'invitecode' );
		/* 邀请码类 */
		$mEntry = loader ( 'class:class_member_entry', 'member', true, true );
		$invitecodeRs = $mEntry->_invitecodecheck ( $invitecode );
		if (check_is_array ( $invitecodeRs ) < 1) {
			$tempName = 'register_invitecode';
		} else {
			$isSubmitSet = 1;
			$tempName = 'register';
		}
		unset ( $invitecodeRs );
		break;
	/* 关闭注册 */
	default :
		showmsg ( config_val ( 'close_msg', $registerSet ), $callback_url );
		break;
}
/* 如果没有关闭注册 */
if ($isSubmitSet == 1) {
	$submitSet = get_db_set ( array (
			'smodule' => 'member',
			'stype' => member_value_get ( 'set_field', 'baseset', 'field' ) 
	) );
	if (check_is_array ( $submitSet ) < 1) {
		showmsg ( lang ( 'global:get_db_set_null' ), $callback_url );
	}
	$username_min = config_val ( 'username_min', $submitSet );
	$username_max = config_val ( 'username_max', $submitSet );
	$username_info = lang ( 'member:username_info', array (
			$username_min,
			$username_max 
	) );
	
	$password_min = config_val ( 'password_min', $submitSet );
	$password_max = config_val ( 'password_max', $submitSet );
	$password_info = lang ( 'member:password_info', array (
			$password_min,
			$password_max 
	) );
	unset ( $submitSet );
}
include subtemplate ( $module . '/' . $tempName );
?>