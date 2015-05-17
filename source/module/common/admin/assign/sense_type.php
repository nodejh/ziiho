<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}

$module = _M ();

/* 组类 */
$st = loader ( 'class:class_common_sense_type', $module, true, true );
$db = $st->db;

/* 获取页码 */
$page = get_page ();
/* 显示个数 */
$page_size = 20;
/* 分页导航 */
$page_nums = 7;
/* 排序 */
$orderby = order_val ();

/* 查询 */
$db->from ( $st->table_common_sense_type );
/* 获取总数 */
$total_num = $db->count_num ();
/* 计算分页 */
$pg = pagephow ( $total_num, $page_size, $page_nums, $page );
$db->limit ( $pg ['first_count'], $pg ['page_size'] );
$db->order_by ( 'listorder', $orderby );
$db->select ();
$result = $db->get_list ();

/* 当前url */
$pg ['name'] = 'index';
$pg ['param'] = 'mod/common/ac/admin/op/sense/ao/type/bo/type';
/* 回调url */
$callback_url = set_current_url ();

include modtemplate ( $module . '/admin/template/sense_type' );
?>