<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}

$module = _M ();

/* 回调url */
$callbackurl = get_current_url ( false, adm_cookieurlkey () );

$aid = get_param ( 'aid' );
$detail_url = modelurl ( 66, array (
		'id' => $aid 
) );
$edit_url = modelurl ( 865, array (
		'id' => $aid 
) );

include modtemplate ( $module . '/admin/template/subject_add_succeed' );
?>