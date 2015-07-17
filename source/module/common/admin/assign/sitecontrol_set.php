<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}

$module = _M ();

$sets = get_db_set ( array (
		'smodule' => $module,
		'stype' => common_value_get ( 'set_field', 'sitecontrol', 'field' ) 
) );
/* 打开站点状态下选项值 */
$site_status_item = de_serialize ( config_val ( 'site_status_item', $sets ) );
$site_status_item = array_stripslashes ( $site_status_item );

include modtemplate ( $module . '/admin/template/sitecontrol_set' );
?>