<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}

$module = _M ();

$sets = get_db_set ( array (
		'smodule' => $module,
		'stype' => common_value_get ( 'set_field', 'set', 'field' ) 
) );

/* 获取时区列表 */
loader ( 'inc:inc_timezone', $module );
$datezoneArr = inc_timezone ();

include modtemplate ( $module . '/admin/template/set' );
?>