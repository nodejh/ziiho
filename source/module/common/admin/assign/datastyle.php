<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}

$module = _M ();

/* 页码 */
$page = get_page ();
/* 显示条数 */
$page_size = 10;
/* 分页导航 */
$page_nums = 7;
/* 排序方式 */
$orderby = order_val ( 1 );

/* 数据模板 */
$c = loader ( 'class:class_common_datastyle', $module, true, true );

$db = $c->db;
/* 查询 */
$db->from ( $c->table_common_datastyle );
/* 获取总数 */
$total_num = $db->count_num ();
$pg = pagephow ( $total_num, $page_size, $page_nums, $page );
$db->limit ( $pg ['first_count'], $pg ['page_size'] );
$db->order_by ( 'listorder', $orderby );
/* 计算分页 */
$db->select ();
$lists = $db->get_list ();
/* 当前url */
$pg ['url_id'] = modelurl ( 950 );
/* 未知提示 */
$unknown = lang ( 'common:unknown' );
/* 设置当前url */
$callback_url = set_current_url ( false, true, adm_cookieurlkey () );

include modtemplate ( 'common/admin/template/datastyle' );
?>