<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}

$module = _M ();

/* ajax回调函数 */
$callFunc = msg_func ();
/* 获取参数 */
$sensetypeid = post_param ( 'sensetypeid' );

showmsg ( NULL, url ( 'index', 'mod/common/ac/admin/op/sense/ao/sense/bo/sense/sensetypeid/' . $sensetypeid ), $callFunc );
?>