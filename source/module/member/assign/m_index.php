<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}

$module = _M ();

/* 获取会员id */
$param_uid = get_int_param ( 'uid' );
if (check_nums ( $param_uid ) < 1) {
	showmsg ( lang ( 'member:uid_fail' ) );
}
/* 查询会员 */
$member = member_query ( $param_uid, true );

if (check_is_array ( $member ) < 1) {
	showmsg ( lang ( 'member:uid_get_noexist' ) );
}
/* 当前登录会员 */
$ses_uid = get_user ( 'uid' );
/* 判断是否有操作权限 */
$is_access = 0;
if (check_nums ( $ses_uid ) == 1) {
	$is_access = 1;
}
/* ajax方式 */
$is_ajax = post_int_param ( 'is_ajax' );
/* 页码 */
$page = ($is_ajax != 1) ? get_page () : post_page ();
/* 显示数 */
$page_size = 10;
/* 分页导航 */
$page_nums = 5;
/* 排序方式 */
$orderby = order_val ( 2 );
/* 全部动态 */
$s = loader ( 'class:class_subject', 'common', true, true );
$db = $s->db;
$db->from ( $s->table_subject );
$db->where ( 'uid', $member ['uid'] );
/* 获取总数 */
$total_num = $db->count_num ();
/* 计算分页 */
$pg = pagephow ( $total_num, $page_size, $page_nums, $page );
$db->order_by ( 'id', $orderby );
$db->limit ( $pg ['first_count'], $pg ['page_size'] );
$result = $db->select ();
if ($result == $db->cw) {
	return $result;
}
$subject_list = $db->get_list ();

/* 参数 */
$pg ['url_id'] = 251;
$url_param ['uid'] = $member ['uid'];
/* url */
$c_url = modelurl ( $pg ['url_id'], array (
		'uid' => $member ['uid'],
		'page' => $page 
) );

$_temp = ($is_ajax != 1) ? 'm_index' : 'm_index_list';

include subtemplate ( $module . '/' . $_temp );
?>