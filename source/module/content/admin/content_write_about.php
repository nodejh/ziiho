<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}

$module = _M ();

/* 分类选择 */
$tpl = 'modtemplate:' . 'common/admin/template/category_option';
$category_option = common_category_list ( 'module', $module, $tpl );

include modtemplate ( $module . '/admin/template/content_write_about' );
?>