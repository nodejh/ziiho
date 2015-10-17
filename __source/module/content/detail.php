<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}

$module = _M ();

/* 模块首页 */
$articleIndexUrl = url ( 'index', 'mod/article/ac/index' );
/* 设置当前url */
set_current_url ( true, true );

/* 检查aid是否合法 */
$aid = get_int_param ( 'id' );
if (check_nums ( $aid ) < 1) {
	showmsg ( lang ( 'article:content_id_fail' ), $articleIndexUrl );
}
/* 主题是否存在 */
$aObj = loader ( 'class:class_article', _M (), true, true );
$article = $aObj->article_query ( 'aid', $aid );
if (check_is_array ( $article ) < 1) {
	showmsg ( lang ( 'article:content_id_noexist' ), $articleIndexUrl );
}
/* 主题内容 */
$content = $aObj->article_content_query ( $aid );
if (check_is_array ( $content ) == 1) {
	$article = array_merge ( $article, $content );
	unset ( $content );
	$article ['content'] = str_stripslashes ( $article ['content'] );
}
/* 更新点击率 */
$article ['views'] = $aObj->article_view_count ( $aid, $article ['views'] );

/* 内容分页 */
$cp = get_page ( 'cp' );
list ( $cpage, $article ['content'] ) = contentpage ( $article ['content'], 1, 5, $cp );
if ($cpage ['page'] > 1) {
	$page_str = numtostr ( $cpage ['page'] );
	$article ['title'] = ($article ['title']) . '(' . $page_str . ')';
}
/* 获取导航位置 */
$category_nav = common_category_nav ( array (
		'module' => $module,
		'catid' => $article ['catid'] 
), NULL, $article ['catid'] );
$category_nav = array_join_str ( '&nbsp;&raquo;&nbsp;', $category_nav ['title_arr'] );

/* 获取发布者 */
$member = member_query ( $article ['uid'] );

/* 关键词获取 */
list ( $keywords_arr, $keywords_num ) = article_keywords_get ( $article ['keywords'] );
/* 相关阅读 */
list ( $keywords_be_num, $keywords_be_list ) = $aObj->article_keywords_be ( $aid, $keywords_arr );

/* 默认是非值 */
$defaulyes = yesno_val ( 'normal' );
$defaulno = yesno_val ( 'check' );
/* 是否显示导读 */
$isdescription = $defaulno;
if ($article ['isdescription'] != $defaulno) {
	$isdescription = (str_len ( $article ['description'] ) < 1) ? $defaulno : $defaulyes;
}

/* 检查是否存在图片(不包括未审核的图) */
$isslide = $defaulno;
if ($article ['isslide'] != $defaulno) {
	$ap = loader ( 'class:class_article_picture', _M (), true, true );
	list ( $pic_num, $pic_list ) = $ap->picture_count ( array (
			'aid' => $aid 
	) );
	if (check_nums ( $pic_num ) < 1) {
		$isslide = $defaulno;
	}
}
/* 设置seo */
$seoDatas = array (
		'page' => ($cpage ['total_num'] > 1 && $cpage ['page'] > 1) ? $cp : '',
		'title' => $article ['title'],
		'keywords' => $article ['keywords'],
		'category' => $cat_name_nav,
		'nickname' => $member ['nickname'],
		'description' => $article ['description'] 
);
$_SEO = get_seo ( $module, article_value_get ( 'set_field', 'seo', 'field' ), 'content', article_value_get ( 'seo_variable' ), $seoDatas );
unset ( $seoDatas );

include subtemplate ( $module . '/detail' );
?>