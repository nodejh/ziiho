<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}

$module = _M ();

/* 标签类 */
$T = loader ( 'class:class_member_tag_admin', $module, true, true );
$db = $T->db;

/* 获取页码 */
$page = get_page ();
/* 显示个数 */
$page_size = 20;
$page_nums = 7;
/* 排序方式 */
$orderby = order_val ();
/* 查询列表 */
$db->from ( $T->table_member_tag );
/* 获取总数 */
$total_num = $db->count_num ();
/* 计算分页 */
$pg = pagephow ( $total_num, $page_size, $page_nums, $page );
$db->limit ( $pg ['first_count'], $pg ['page_size'] );
$db->order_by ( 'listorder', $orderby );
$lists = $db->select ();
if ($lists == $db->cw) {
	return $lists;
}
$lists = $db->get_list ();
/* 当前url */
$pg ['name'] = 'index';
$pg ['param'] = 'mod/member/ac/admin/op/tag/ao/tag';
/* 设置当前url */
$callbackurl = set_current_url ( false, true, adm_cookieurlkey () );

include modtemplate ( $module . '/admin/template/tag' );
?>