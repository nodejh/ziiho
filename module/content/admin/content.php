<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}

$module = _M ();

/* 页码 */
$page = get_page ();
/* 获取状态 */
$status_name = get_param ( 's', 'normal' );
$status = article_status ( $status_name );
/* 获取天数 */
$day_name = get_int_param ( 'sday' );
$day = day_val ( $day_name, 0 );
/* 获取排序方式 */
$order_name = get_int_param ( 'sorder' );
$orderby = order_val ( $order_name, 2 );
/* 获取显示条数 */
$num_name = get_int_param ( 'dnum' );
$data_num = data_num_val ( $num_name, 20 );
/* 获取主题id */
$get_id = get_int_param ( 'id' );

/* 内容列表 */
$A = loader ( 'class:class_article_admin', $module, true, true );
$db = $A->db;
/* 列表查询 */
$db->from ( $A->table_article );
/* 如果id有效,则忽略筛选条件 */
if ($get_id < 1) {
	if ($day >= 1) {
		/* n天的秒钟数 */
		$daySeconds = timesecond ( $day, 'd' );
		$db->where_fvop ( 'ctime', $_G ['app'] ['sys_time'], $daySeconds, '-', '<' );
	}
	$db->where ( 'status', $status );
} else {
	$db->where ( 'aid', $get_id );
}
/* 获取总数 */
$total_num = $db->count_num ();
/* 计算分页 */
$pg = pagephow ( $total_num, $data_num, 7, $page );
$db->order_by ( 'ctime', $orderby );
$db->limit ( $pg ['first_count'], $pg ['page_size'] );
$result = $db->select ();
if ($result == $db->cw) {
	showmsg ( lang ( 'admin:dbexception' ) );
}
$contentList = $db->get_list ();

/* 分类选择 */
$tpl = 'modtemplate:' . 'common/admin/template/category_option';
$category_option = common_category_list ( 'module', $module, $tpl );

/* 聚合标签 */
$al = loader ( 'class:class_article_label', $module, true, true );
list ( $labelpg, $label_list ) = $al->lists ();

/* 操作选项 */
$doaction = article_value_get ( 'action_field' );

/* 当前url */
$urlValue = NULL;
if (str_len ( $status_name ) >= 1) {
	$urlValue .= '/s/' . $status_name;
}
if (str_len ( $day_name ) >= 1) {
	$urlValue .= '/sday/' . $day_name;
}
if (str_len ( $order_name ) >= 1) {
	$urlValue .= '/sorder/' . $order_name;
}
if (str_len ( $num_name ) >= 1) {
	$urlValue .= '/dnum/' . $num_name;
}
if (str_len ( $get_id ) >= 1) {
	$urlValue .= '/id/' . $get_id;
}

/* url链接id */
$pg ['name'] = 'index';
$pg ['param'] = 'mod/article/ac/admin/op/content/ao/content' . $urlValue;
/* 设置当前url */
$callback_url = set_current_url ( false, true, adm_cookieurlkey () );

include modtemplate ( $module . '/admin/template/content' );
?>