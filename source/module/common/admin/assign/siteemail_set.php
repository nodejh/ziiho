<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}

$module = _M ();

$es = get_db_set ( array (
		'smodule' => $module,
		'stype' => config_name_val ( 'email_set' ) 
) );

include modtemplate ( $module . '/admin/template/siteemail_set' );
?>