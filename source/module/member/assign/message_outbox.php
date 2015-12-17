<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}

$module = _M ();

$sess_uid = get_user ( 'uid' );

/* 页码 */
$page = get_page ();
/* 显示数 */
$page_size = 10;
/* 分页导航 */
$page_nums = 5;
/* 排序方式 */
$orderby = order_val ( 2 );
/* box_status */
$box_status = member_message_box_status ( 'normal' );

/* 当前 */
$s = loader ( 'class:class_member_message', 'member', true, true );

/* 查询 */
$db = $s->db;
$db->from ( $s->table_member_message );
$db->where ( 'outboxuid', $sess_uid );
$db->where ( 'outbox', $box_status );
/* 获取总数 */
$total_num = $db->count_num ();
/* 计算分页 */
$pg = pagephow ( $total_num, $page_size, $page_nums, $page );
$db->order_by ( 'messageid', $orderby );
$db->limit ( $pg ['first_count'], $pg ['page_size'] );
$result = $db->select ();
if ($result == $db->cw) {
	return $result;
}
$lists = $db->get_list ();

/* 参数 */
$pg ['name'] = 'index';
$pg ['param'] = 'mod/member/ac/message/op/outbox';

include subtemplate ( $module . '/message_outbox' );
?>