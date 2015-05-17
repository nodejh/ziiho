<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}

$module = _M ();

/* 设置当前url */
set_current_url ( true, true );
/* 文章首页 */
$articleIndexUrl = url ( 'index', 'mod/article/ac/index' );
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
/* 分类参数 */
$catid = get_int_param ( 'catid' );
/* -------------分类查询------------ */
$categorySub = NULL;
if ($catid >= 1) {
	$categorySub = common_category_query ( 'catid', $catid );
	if (check_is_array ( $categorySub ) < 1) {
		showmsg ( lang ( 'common:category_noexist' ), $articleIndexUrl );
	}
}
/* -------------获取列表------------ */
/*获取列表*/
$db->from ( $aObj->table_article );
if ($catid >= 1) {
	$db->where ( 'catid', $catid );
}
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
$urlParam = NULL;
if ($catid >= 1) {
	$urlParam .= '/catid/' . $catid;
}
/* 分页url */
$pg ['name'] = 'index';
$pg ['param'] = 'mod/article/ac/content/op/lists' . $urlParam;
/* -------------设置seo------------ */
/*设置seo*/
$seoDatas = array (
		'page' => ($pg ['page'] < 2) ? 1 : $pg ['page'],
		'category' => array_key_val ( 'title', $categorySub ) 
);
$_SEO = get_seo ( $module, article_value_get ( 'set_field', 'seo', 'field' ), 'list', article_value_get ( 'seo_variable' ), $seoDatas );
unset ( $seoDatas, $categorySub );

include subtemplate ( $module . '/lists' );
?>