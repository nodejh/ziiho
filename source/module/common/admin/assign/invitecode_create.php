<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}

$module = _M ();

/* 返回url */
$callback_url = get_current_url ( false, 'sess_common_adm_invitecode' );

include modtemplate ( $module . '/admin/template/invitecode_create' );
?>