<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}

$module = _M ();

$callFunc = msg_func ();

$menu_id = post_int_param ( 'menu_id' );
if (check_nums ( $menu_id ) < 1) {
	showmsg ( lang ( 'admin:param_fail' ), NULL, $callFunc );
}

include modtemplate ( $module . '/template/menu_childshow' );
?>