<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}

$module = _M ();

/* 返回url */
$callback_url = get_current_url ( false, 'sess_common_adm_category' );
/* 分类类 */
$categoryObj = loader ( 'class:class_common_category_admin', _M (), true, true );

$catid = get_param ( 'catid' );
if (check_nums ( $catid ) < 1) {
	showmsg ( lang ( 'common_adm:category_catid_fail' ), $callback_url );
}
/* 分类是否存在 */
$category = $categoryObj->category_query ( 'catid', $catid );
if (check_is_array ( $category ) < 1) {
	showmsg ( lang ( 'common_adm:category_catid_noexist' ), $callback_url );
}
/* 分类选择 */
$tpl = 'modtemplate:' . $module . '/admin/template/category_option';
$category_option = $categoryObj->category_list ( 'module', $category ['module'], $tpl, $catid, false );

/* 模板目录 */
$template_path = array_key_val ( 'templatepath', array_key_val ( 'web', $_G ) );
/* 提交url */
$submitUrl = url ( 'index', 'mod/common/ac/admin/op/category/ao/category_editsetdo' );

include modtemplate ( $module . '/admin/template/category_editset' );
?>