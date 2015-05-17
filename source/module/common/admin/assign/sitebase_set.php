<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}

$module = _M ();

/* 获取配置 */
$sb = get_db_set ( array (
		'smodule' => $module,
		'stype' => config_name_val ( 'sitebase' ) 
) );

include modtemplate ( $module . '/admin/template/sitebase_set' );
?>