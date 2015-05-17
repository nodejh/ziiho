<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}

$module = _M ();

$seo = get_db_set ( array (
		'smodule' => $module,
		'stype' => config_name_val ( 'seo' ) 
) );

include modtemplate ( $module . '/admin/template/siteseo_set' );
?>