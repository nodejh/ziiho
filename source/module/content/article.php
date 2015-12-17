<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}

$module = _M ();

/* 设置当前url */
set_current_url ( true, true );

/* 主题类 */
$aObj = loader ( 'class:class_article', $module, true, true );
$db = $aObj->db;
/* -------------参数------------ */
/*获取页码*/
$page = get_page ( 'page' );
/* 分页数 */
$page_size = 20;
/* 分页导航 */
$page_nums = 10;
/* 排序 */
$orderby = order_val ( 2 );
/* 主题状态 */
$status = article_status ( 'normal' );

/* -------------获取列表------------ */
/*获取列表*/
$db->from ( $aObj->table_article );
$db->where ( 'status', $status );
/* 获取总数 */
$total_num = $db->count_num ();
/* 计算分页 */
$pg = pagephow ( $total_num, $page_size, $page_nums, $page );
$db->order_by ( 'aid', $orderby );
$db->limit ( $pg ['first_count'], $pg ['page_size'] );
$result = $db->select ();
if ($result == $db->cw) {
	return $result;
}
$listResult = $db->get_list ();
/* -------------分页url------------ */
/*分页url*/
$pg ['name'] = 'index';
$pg ['param'] = 'mod/article/ac/index';
/* -------------设置seo------------ */
$seoDatas = array ();
$_SEO = get_seo ( $module, article_value_get ( 'set_field', 'seo', 'field' ), 'index', article_value_get ( 'seo_variable' ), $seoDatas );
unset ( $seoDatas );

include subtemplate ( $module . '/a_index' );
?>