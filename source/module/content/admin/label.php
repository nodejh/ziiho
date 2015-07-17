<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}

$module = _M ();

/* 获取页码 */
$page = get_page ();
/* 聚合标签 */
$aLabelObj = loader ( 'class:class_article_label_admin', _M (), true, true );
list ( $pg, $result ) = $aLabelObj->lists ( 20, 7, $page );

/* 分页url */
$pg ['name'] = 'index';
$pg ['param'] = 'mod/article/ac/admin/op/label/ao/label';
/* 回调url */
$callback_url = set_current_url ();

include modtemplate ( $module . '/admin/template/label' );
?>