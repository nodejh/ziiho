<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}

$module = _M ();

/* 获取配置 */
$sets = get_db_set ( array (
		'smodule' => $module,
		'stype' => member_value_get ( 'set_field', 'baseset', 'field' ) 
) );
if (check_is_array ( $sets ) == 1) {
	$nickname_min = config_val ( 'nickname_min', $sets, 1 );
	$nickname_max = config_val ( 'nickname_max', $sets, 20 );
	$nickname_lang = lang ( 'member:profile_nickname_info', array (
			$nickname_min,
			$nickname_max 
	) );
	
	/* 个性签名长度限制 */
	$inform_max = config_val ( 'inform_max', $sets, 100 );
}

/* 获取信息 */
$memberInfo = member_query ( get_user ( 'uid' ), true );
$hometown = 0;
$address = 0;
if (check_is_array ( $memberInfo ) == 1) {
	$hometown = member_address ( array_key_val ( 'hometown', $memberInfo ) );
	$hometown = (check_nums ( $hometown ) < 1) ? 0 : $hometown;
	$address = member_address ( array_key_val ( 'address', $memberInfo ) );
	$address = (check_nums ( $address ) < 1) ? 0 : $address;
}

include subtemplate ( $module . '/setting_profile_base' );
?>