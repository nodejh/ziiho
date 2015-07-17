<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}

$module = _M ();

/* 获取配置 */
$sets = get_db_set ( array (
		'smodule' => $module,
		'stype' => article_value_get ( 'set_field', 'seo', 'field' ) 
) );

$seo_variable_arr = article_value ( 'seo_variable_name' );

include modtemplate ( $module . '/admin/template/seo_set' );
?>