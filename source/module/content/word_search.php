<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}

$module = _M ();

/* 设置当前url */
set_current_url ( true, true );

/* 初始化值 */
$pg = NULL;
/* 获取搜索字 */
$word = str_urldecode ( get_param ( 'word' ) );
/* 搜索字长度 */
$word_len = str_len ( $word );
if ($word_len >= 1) {
	/* 截取关键字 */
	$word = sub_str ( $word, 0, 38 );
	$w_search = ('(.*' . $word . '.*)$');
	/* 获取页码 */
	$page = get_page ( 'page' );
	/* 显示多少个 */
	$page_size = 20;
	/* 分页导航 */
	$page_nums = 5;
	/* 主题状态 */
	$status = article_status ( 'normal' );
	/* 排序 */
	$orderby = order_val ( 2 );
	/* 列表 */
	$a = $_G ['loader']->model ( 'class:class_article', 'article', false );
	$db = $a->db;
	
	$db->from ( $a->table_article );
	$db->where_match ( 'title', $w_search );
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
	$lists = $db->get_list ();
	
	/* 当前url */
	$pg ['url_id'] = 833;
	if ($pg ['total_num'] < 1) {
		/* 提示信息 */
		$word_search_not_lang = replace_str ( lang ( 'article:word_search_not' ), '{word}', $word );
	}
}
/* 设置seo */
$seoDatas = array (
		'title' => ($word . '-{site_name}-资讯搜索'),
		'keywords' => $word,
		'description' => '{site_name}' 
);
$_SEO = get_seo ( NULL, NULL, NULL, NULL, $seoDatas, true );
unset ( $seoDatas );

include subtemplate ( $module . '/word_search' );
?>