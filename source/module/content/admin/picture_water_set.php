<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}

$module = _M ();

/* 获取配置 */
$sets = get_db_set ( array (
		'smodule' => $module,
		'stype' => article_value_get ( 'set_field', 'picture_water', 'field' ) 
) );

include modtemplate ( $module . '/admin/template/picture_water_set' );
?>