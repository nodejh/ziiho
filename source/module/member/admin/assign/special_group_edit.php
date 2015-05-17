<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}

$module = _M ();

/* 返回url */
$callback_url = get_current_url ( false, adm_cookieurlkey () );

$groupid = get_int_param ( 'groupid', 0 );
if (check_nums ( $groupid ) < 1) {
	showmsg ( lang ( 'member_adm:group_groupid_fail' ), $callback_url );
}
/* 查询组是否存在 */
$gObj = loader ( 'class:class_member_group_admin', $module, true, true );
$group = $gObj->group_query ( 'groupid', $groupid );
if (check_is_array ( $group ) < 1) {
	showmsg ( lang ( 'member_adm:group_groupid_notexist' ), $callback_url );
}

include modtemplate ( $module . '/admin/template/special_group_edit' );
?>