<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}

$module = _M ();

sleep ( 1 );
$aid = post_param ( 'aid' );
/* 检查aid是否合法 */
if (check_num ( $aid ) < 1) {
	lang ( 'article_review:review_aid_fail', true );
	return NULL;
}
/* 当前用户 */
$uid = get_user ( 'uid' );
/* 判断是否有操作权限 */
$is_access = 0;
if (check_nums ( $uid ) == 1) {
	$is_access = 1;
}

/* 查询主题是否存在 */
$t = $_G ['loader']->model ( 'class:class_article', 'article', false );
$article = $t->article_id_query ( $aid );
if (check_is_array ( $article ) < 1) {
	lang ( 'article_review:review_aid_no_exists' );
	return NULL;
}
unset ( $article );

/* 获取页码 */
$page = post_page ();
/* 获取评论 */
$r = $_G ['loader']->model ( 'class:class_article_review', 'article', false );
list ( $rpg, $lists ) = $r->list_query ( $aid, 10, 5, $page );

include subtemplate ( $module . '/a_review_list' );
?>