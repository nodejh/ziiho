<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}

$module = _M ();

$a = $_G ['loader']->model ( 'class:class_apply', 'common', false );

/* 是否需要验证码 */
$rc = $a->config_query ( array (
		'config_variable' => 'member_login',
		'config_module' => 'membercode' 
) );
$is_code = (check_is_array ( $rc ) == 1) ? $rc ['member_login'] ['config_value'] : 0;

include subtemplate ( $module . '/m_loginwindow' );
?>