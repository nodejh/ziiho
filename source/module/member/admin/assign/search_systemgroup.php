<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}

$module = _M ();

/* 获取回调url */
$callback_url = get_current_url ( false, 'sess_member_adm_search' );

/* 获取搜索值 */
$uid = get_int_param ( 'uid' );
if (check_nums ( $uid ) < 1) {
	showmsg ( lang ( 'admin:param_id_fail' ), $callback_url );
}

$mObj = loader ( 'class:class_member', $module, true, true );
$member = $mObj->member_query ( 'uid', $uid );
if (check_is_array ( $member ) < 1) {
	showmsg ( lang ( 'member_adm:get_uid_notexist' ), $callback_url );
}

/* 初始化用户组类型 */
$group_type = member_grouptype ( 'system' );
$group_title = member_grouptype ( 'system', 'title' );
/* 获取管理组列表 */
$gObj = loader ( 'class:class_member_group_admin', 'member', true, true );
list ( $pg, $group_list ) = $gObj->group_list ( $group_type, 100 );

/* 获取菜单 */
$menuObj = loader ( 'class:class_admin_menu', 'admin', true, true );
$menu_list = $menuObj->menu_member_list ( $uid );

include modtemplate ( $module . '/admin/template/search_systemgroup' );
?>