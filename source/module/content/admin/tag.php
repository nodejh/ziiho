<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}

$module = _M ();

/* 获取页码 */
$page = get_page ();
/* 分页数 */
$page_size = 20;
/* 分页导航 */
$page_nums = 7;
/* 排序 */
$orderby = order_val ();
$aTagObj = loader ( 'class:class_article_tag_admin', $module, true, true );
$db = $aTagObj->db;
$db->from ( $aTagObj->table_article_tagname );
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
$lists = $db->get_list ();

/* 分页url */
$pg ['name'] = 'index';
$pg ['param'] = 'mod/article/ac/admin/op/tag/ao/tag';
/* 当前url */
$callback_url = set_current_url ( false, true, adm_cookieurlkey () );

include modtemplate ( $module . '/admin/template/tag' );
?>