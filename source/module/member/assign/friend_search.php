<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}

$module = _M ();

/* 页码 */
$page = get_page ();
/* 分页数 */
$page_size = 10;
/* 分页导航 */
$page_nums = 5;
/* 排序 */
$orderby = order_val ( 2 );

/* 查询我关注的人 */
$mf = loader ( 'class:class_member', 'member', true, true );
$db = $mf->db;
$db->from ( $mf->table_member );
$db->where_more ( 'uid', get_user ( 'uid' ), '!=' );
/* 获取总数 */
$total_num = $db->count_num ();
/* 计算分页 */
$pg = pagephow ( $total_num, $page_size, $page_nums, $page );
$db->order_by ( 'uid', $orderby );
$db->limit ( $pg ['first_count'], $pg ['page_size'] );
$lists = $db->select ();
if ($lists != $db->cw) {
	$lists = $db->get_list ();
}
/* url参数 */
$pg ['name'] = 'index';
$pg ['param'] = 'mod/member/ac/friend/op/action/ao/search';

include subtemplate ( $module . '/friend_search' );
?>