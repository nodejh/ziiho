<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}

$module = _M ();

/* 列表url */
$articleIndexUrl = url ( 'index', 'mod/article/ac/index' );
/* 设置当前url */
set_current_url ( true, true );

$aid = get_int_param ( 'id' );
/* 检查tide_id是否合法 */
if (check_nums ( $aid ) < 1) {
	showmsg ( lang ( 'article:content_id_fail' ), $articleIndexUrl );
}
/* 查询主题是否存在 */
$aObj = loader ( 'class:class_article', _M (), true, true );
$article = $aObj->article_query ( 'aid', $aid );
if (check_is_array ( $article ) < 1) {
	showmsg ( lang ( 'article:content_id_noexist' ), $articleIndexUrl );
}

include subtemplate ( $module . '/content_write_succeed' );
?>