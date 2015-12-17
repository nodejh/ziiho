<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}

$module = _M ();

/* 返回当前url */
$callback_url = url ( 'index', 'mod/member/ac/admin/op/membergroup/ao/level/grouptype/' . get_param ( 'grouptype' ) );

$groupid = get_int_param ( 'groupid' );
if (check_nums ( $groupid ) < 1) {
	showmsg ( lang ( 'member:group_groupid_fail' ), $callback_url );
}
/* 组是否存在 */
$MGObj = loader ( 'class:class_member_group_admin', $module, true, true );
$mGroupSub = $MGObj->group_query ( 'groupid', $groupid );
if (check_is_array ( $mGroupSub ) < 1) {
	showmsg ( lang ( 'member:group_groupid_notexist' ), $callback_url );
}

include modtemplate ( $module . '/admin/template/member_group_edit' );
?>