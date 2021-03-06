<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}

$module = _M ();

/* 模块首页 */
$articleIndexUrl = url ( 'index', 'mod/article/ac/index' );

/* 文章类 */
$aObj = loader ( 'class:class_article_member', $module, true, true );
/* 初始化参数 */
$uid = get_user ( 'uid' );
/* 主题参数 */
$article = NULL;
/* 是否存在草稿 */
$isdraft = 0;
/* 是否显示草稿按钮 */
$showdrftbutton = 1;
if (check_is_key ( 'id', $_GET ) == 1) {
	$aid = get_param ( 'id' );
	if (check_nums ( $aid ) < 1) {
		showmsg ( lang ( 'common:param_id_fail' ), $articleIndexUrl );
	}
	/* 主题是否存在 */
	$article = $aObj->article_query ( 'aid', $aid );
	if (check_is_array ( $article ) < 1) {
		showmsg ( lang ( 'common:param_id_noexist' ), $articleIndexUrl );
	}
	/* 主题内容 */
	$content = $aObj->article_content_query ( $article ['aid'] );
	if (check_is_array ( $content ) == 1) {
		$content ['content'] = str_stripslashes ( $content ['content'] );
		$article = array_merge ( $article, $content );
		unset ( $content );
	}
	/* 相关文章显示 */
	$article ['abouts'] = explode_str ( $article ['abouts'], ',' );
	if (check_is_array ( $article ['abouts'] ) == 1) {
		$db = $aObj->db;
		$db->from ( $aObj->table_article );
		$db->where_in ( 'aid', $article ['abouts'] );
		$db->select ();
		$article ['abouts'] = $db->get_list ();
	} else {
		$article ['abouts'] = NULL;
	}
} else {
	/* 获取是否有草稿 */
	$article = $aObj->article_draft_query ( $uid );
	if (check_is_array ( $article ) == 1) {
		$isdraft = 1;
		$draftid = $article ['aid'];
	}
	$article = NULL;
}
if (check_is_key ( 'status', $article ) == 1) {
	if ($article ['status'] != article_status ( 'draft' )) {
		$showdrftbutton = 0;
	}
}
/* 发布时间 */
$article ['ctime'] = datestyle ( array_key_val ( 'ctime', $article ), 'Y-m-d H:i:s' );
/* 分类 */
$tpl = 'subtemplate:' . 'common/category_option';
$category_option = common_category_list ( array (
		'module' => $module,
		'disabled' => yesno_val ( 'normal' ) 
), NULL, $tpl, array_key_val ( 'catid', $article ) );
/* 标签名列表 */
$tagObj = loader ( 'class:class_article_tag', $module, true, true );
list ( $tpg, $tagname_list ) = $tagObj->tagname_list ( 100 );
/* 关联标签列表 */
$tag_arr = $tagObj->tag_list ( 'aid', $aid );

include subtemplate ( $module . '/content_write' );
?>