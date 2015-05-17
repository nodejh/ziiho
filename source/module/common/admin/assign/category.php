<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}

$module = _M ();

/* 分类类 */
$categoryObj = loader ( 'class:class_common_category_admin', _M (), true, true );
/* 获取支持分类的模块 */
$moduleList = get_module_support ( 'category' );
if (check_is_array ( $moduleList ) < 1) {
	showmsg ( lang ( 'admin:module_noexist' ) );
}
/* 获取模块 */
$cm = get_param ( 'cm' );

/* 默认一个模块 */
if (check_is_key ( $cm, get_module () ) < 1) {
	foreach ( $moduleList as $dK => $dV ) {
		$cm = $dV ['module'];
		break;
	}
	unset ( $dK, $dV );
}
/* 获取模块的分类 */
$tpl = 'modtemplate:' . $module . '/admin/template/category_list';
$categoryList = $categoryObj->category_list ( 'module', $cm, $tpl );

/* 设置当前url */
$callback_url = set_current_url ( false, true, 'sess_common_adm_category' );

include modtemplate ( $module . '/admin/template/category' );
?>