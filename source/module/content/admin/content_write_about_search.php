<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}

$module = _M ();

$uid = get_user ( 'uid' );
/* 当前编辑主题id */
$subjectaid = post_int_param ( 'subjectaid' );
/* 获取参数 */
$catid = post_int_param ( 'catid' );
/* 标题 */
$title = sub_str ( post_param ( 'title' ), 0, 20 );
/* 页码 */
$page = post_page ();
/* 显示个数 */
$page_size = 10;
/* 分页导航 */
$page_nums = 5;
/* 排序 */
$orderby = order_val ( 2 );
/* 主题 */
$a = loader ( 'class:class_article_admin', _M (), true, true );
$db = $a->db;

$db->from ( $a->table_article );

if (check_nums ( $subjectaid ) == 1) {
	$db->where_more ( 'aid', $subjectaid, '!=' );
}
if (check_nums ( $catid ) == 1) {
	$db->where ( 'catid', $catid );
}
if (str_len ( $title ) >= 1) {
	$db->where_match ( 'title', $db->match_pre_end ( $title ) );
}
/* 获取总数 */
$total_num = $db->count_num ();
/* 计算分页 */
$pg = pagephow ( $total_num, $page_size, $page_nums, $page );
$db->limit ( $pg ['first_count'], $pg ['page_size'] );
$db->order_by ( 'ctime', $orderby );

$result = $db->select ();
if ($result == $db->cw) {
	lang ( 'dbexception', true );
	return NULL;
}
$result = $db->get_list ();

include modtemplate ( $module . '/admin/template/content_write_about_search' );
?>