<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}

$module = _M ();

/* 获取页码 */
$page = get_page ();
/* 显示个数 */
$page_size = 20;
/* 分页导航 */
$page_nums = 7;
/* 排序 */
$orderby = order_val ();
/* 组 */
$g = loader ( 'class:class_common_showgroup', _M (), true, true );

$db = $g->db;
/* 显示列表 */
$db->from ( $g->table_common_showgroup );
/* 获取总数 */
$total_num = $db->count_num ();
/* 计算分页 */
$pg = pagephow ( $total_num, $page_size, $page_nums, $page );
$db->limit ( $pg ['first_count'], $pg ['page_size'] );
$db->order_by ( 'listorder', $orderby );
$result = $db->select ();
if ($result == $db->cw) {
	return $result;
}
$result = $db->get_list ();

/* 当前url */
$pg ['name'] = 'index';
$pg ['param'] = 'mod/common/ac/admin/op/show/ao/group/bo/group';
/* 返回当前url */
$callback_url = set_current_url ( false, true, adm_cookieurlkey () );

include modtemplate ( $module . '/admin/template/showgroup' );
?>