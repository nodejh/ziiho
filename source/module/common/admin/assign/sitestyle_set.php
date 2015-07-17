<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}

$module = _M ();

/* 获取配置 */
$sitestyle = get_db_set ( array (
		'smodule' => $module,
		'stype' => config_name_val ( 'sitestyle' ) 
) );
/* 模板列表 */
$T = loader ( 'class:class_common_template', $module, true, true );
$template_result = $T->template_list ();

/* 导航列表 */
$navObj = loader ( 'class:class_common_nav', $module, true, true );
$tpl = modtemplate ( $module . '/admin/template/nav_option' );
$navtype = common_nav_type ( 'main' );
$nav_options = $navObj->nav_show ( $tpl, $navtype, config_val ( 'navid', $sitestyle ) );

include modtemplate ( $module . '/admin/template/sitestyle_set' );
?>