<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}

$module = _M ();

/* 获取页码 */
$page = get_page ();
/* 分页大小 */
$page_size = 15;
/* 排序 */
$orderby = order_val ();
/* 模板类 */
$T = loader ( 'class:class_common_template_admin', $module, true, true );
$db = $T->db;
/* 列表查询 */
$db->from ( $T->table_common_template );
/* 获取总数 */
$total_num = $db->count_num ();
/* 计算分页 */
$pg = pagephow ( $total_num, $page_size, 7, $page );
$db->order_by ( 'ctime', $orderby );
$db->limit ( $pg ['first_count'], $pg ['page_size'] );
$result = $db->select ();
if ($result == $db->cw) {
	return NULL;
}
$lists = $db->get_list ();
/* 当前url */
$pg ['name'] = 'index';
$pg ['param'] = 'mod/common/ac/admin/op/template/ao/template';
/* 设置当前url */
$callback_url = set_current_url ( false, true, adm_cookieurlkey () );

include modtemplate ( $module . '/admin/template/template' );
?>