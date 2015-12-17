<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}

$module = _M ();

/* 如果没有传值,则为当前已登录的会员 */
if (check_is_key ( 'uid', $_GET ) == 1) {
	/* 获取会员id */
	$param_uid = get_int_param ( 'uid' );
	if (check_nums ( $param_uid ) < 1) {
		showmsg ( lang ( 'member:uid_fail' ) );
	}
	/* 查询会员 */
	$member = member_query ( $param_uid );
	if (check_is_array ( $member ) < 1) {
		showmsg ( lang ( 'member:uid_get_noexist' ) );
	}
} else {
	$param_uid = get_user ( 'uid' );
}

/**
 * ******************
 */
/* 页码 */
$page = get_page ();
/* 分页数 */
$page_size = 10;
/* 分页导航 */
$page_nums = 5;
/* 排序 */
$orderby = order_val ( 2 );

/* 查询我关注的人 */
$mf = loader ( 'class:class_member_friend', 'member', true, true );
$db = $mf->db;
$db->from ( $mf->table_member_friend );
$db->where ( 'fans_uid', $param_uid );
/* 获取总数 */
$total_num = $db->count_num ();
/* 计算分页 */
$pg = pagephow ( $total_num, $page_size, $page_nums, $page );
$db->order_by ( 'friendid', $orderby );
$db->limit ( $pg ['first_count'], $pg ['page_size'] );
$lists = $db->select ();
if ($lists != $db->cw) {
	$lists = $db->get_list ();
}

/* url参数 */
$pg ['name'] = 'index';
$pg ['param'] = 'mod/member/ac/friend/op/follow';

include subtemplate ( $module . '/follow' );
?>