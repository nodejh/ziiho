<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}

$module = _M ();

include modtemplate ( $module . '/admin/template/message_send_findmember' );
?>