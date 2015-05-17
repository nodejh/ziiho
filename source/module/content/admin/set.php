<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}

$module = _M ();

/* 获取配置 */
$dmarr = get_db_set ( array (
		'smodule' => $module,
		'stype' => article_value_get ( 'set_field', 'set', 'field' ) 
) );

include modtemplate ( $module . '/admin/template/set' );
?>