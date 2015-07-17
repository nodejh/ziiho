<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}

$module = _M ();

/* ajax回调函数 */
$callFunc = msg_func ();
/* 获取参数 */
$emotgroupid = post_param ( 'emotgroupid' );
$qnum = post_int_param ( 'num' );

showmsg ( NULL, url ( 'index', 'mod/common/ac/admin/op/emotional/ao/emot/bo/emot/emotgroupid/' . $emotgroupid . '/qnum/' . $qnum ), $callFunc );
?>