<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}

$module = _M ();

/* 积分类 */
$creditObj = loader ( 'class:class_common_credit_admin', $module, true, true );
$db = $creditObj->db;
/* 页码 */
$page = get_page ();
/* 显示个数 */
$page_size = 20;
/* 分页导航 */
$page_nums = 7;
/* 排序 */
$orderby = order_val ( 2 );
/* 查询 */
$db->from ( $creditObj->table_common_credit_change );
/* 获取总数 */
$total_num = $db->count_num ();
/* 计算分页 */
$pg = pagephow ( $total_num, $page_size, $page_nums, $page );
$db->limit ( $pg ['first_count'], $pg ['page_size'] );
$db->order_by ( 'changeid', $orderby );
$result = $db->select ();
if ($result == $db->cw) {
	return $result;
}
$resultlist = $db->get_list ();

/* 分页url */
$pg ['name'] = 'index';
$pg ['param'] = 'mod/common/ac/admin/op/credit/ao/change';

/* 当前url */
$callback_url = set_current_url ( false, true, adm_cookieurlkey () );

include modtemplate ( $module . '/admin/template/credit_change' );
?>