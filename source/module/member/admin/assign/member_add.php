<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}

$module = _M ();

$memberBaseSet = get_db_set ( array (
		'smodule' => $module,
		'stype' => member_value_get ( 'set_field', 'baseset', 'field' ) 
) );
if (check_is_array ( $memberBaseSet ) == 1) {
	$username_min = config_val ( 'username_min', $memberBaseSet );
	$username_max = config_val ( 'username_max', $memberBaseSet );
	$username_lang = lang ( 'member:username_info', array (
			$username_min,
			$username_max 
	) );
	
	$password_min = config_val ( 'password_min', $memberBaseSet );
	$password_max = config_val ( 'password_max', $memberBaseSet );
	$password_lang = lang ( 'member:password_info', array (
			$password_min,
			$password_max 
	) );
	unset ( $memberBaseSet );
}

include modtemplate ( $module . '/admin/template/member_add' );
?>