<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}

$module = _M ();

/* 内容列表 */
$P = loader ( 'class:class_article_picture_admin', $module, true, true );
$db = $P->db;
/* 获取导航位置 */
$A = loader ( 'class:class_article', $module, true, true );
/* --------------------------------------------- */
/*页码*/
$page = get_page ();
/* 获取天数 */
$dayKey = get_int_param ( 'qday' );
$day = day_val ( $dayKey, 0 );
/* 获取排序方式 */
$orderKey = get_int_param ( 'qorder' );
$orderby = order_val ( $orderKey, 2 );
/* 获取显示条数 */
$numKey = get_int_param ( 'qnum' );
$data_num = data_num_val ( $numKey, 20 );
/* 获取主题id */
$qaid = get_int_param ( 'qaid' );

/* 查询列表 */
$db->from ( $P->table_article_picture );
/* 如果id有效,则忽略筛选条件 */
if ($qaid < 1) {
	if ($day >= 1) {
		/* n天的秒钟数 */
		$daySeconds = timesecond ( $day, 'd' );
		$db->where_fvop ( 'ctime', $_G ['app'] ['sys_time'], $daySeconds, '-', '<' );
	}
} else {
	$db->where ( 'aid', $qaid );
}
/* 获取总数 */
$total_num = $db->count_num ();
/* 计算分页 */
$pg = pagephow ( $total_num, $data_num, 7, $page );
$db->order_by ( 'aid', $orderby );
$db->limit ( $pg ['first_count'], $pg ['page_size'] );
$db->select ();
$lists = $db->get_list ();
unset ( $db );
/* 当前url参数 */
$urlParam = NULL;
if (str_len ( $dayKey ) >= 1) {
	$urlParam .= '/qday/' . $dayKey;
}
if (str_len ( $orderKey ) >= 1) {
	$urlParam .= '/qorder/' . $orderKey;
}
if (str_len ( $numKey ) >= 1) {
	$urlParam .= '/qnum/' . $numKey;
}
if (str_len ( $qaid ) >= 1) {
	$urlParam .= '/qaid/' . $qaid;
}
/* url链接 */
$pg ['name'] = 'index';
$pg ['param'] = 'mod/article/ac/admin/op/picture/ao/picture' . $urlParam;

/* 操作选项 */
$doaction = article_value_get ( 'action_field' );

/* 当前url */
$callback_url = set_current_url ( false, true, adm_cookieurlkey () );

include modtemplate ( $module . '/admin/template/pictrue' );
?>