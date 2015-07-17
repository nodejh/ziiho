<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}

$module = _M ();

/* 获取配置 */
$memberinitSet = get_db_set ( array (
		'smodule' => $module,
		'stype' => member_value_get ( 'set_field', 'memberinit', 'field' ) 
) );

$creditNum = de_serialize ( config_val ( 'credit', $memberinitSet ) );

include modtemplate ( $module . '/admin/template/set_memberinit' );
?>