<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}

$module = _M ();

/* 获取会员id */
$param_uid = post_int_param ( 'uid' );
if (check_nums ( $param_uid ) < 1) {
	showmsg ( lang ( 'member:uid_fail' ) );
}
/* 查询会员 */
$member = member_query ( $param_uid );
if (check_is_array ( $member ) < 1) {
	tmsg ( lang ( 'member:uid_get_noexist' ) );
}
/**
 * ******************
 */
/* 分页数 */
$page_size = post_int_param ( 'page_size', 10 );
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

include subtemplate ( $module . '/m_index_follow' );
?>