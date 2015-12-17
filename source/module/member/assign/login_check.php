<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}

$module = _M ();

/* 回调参数 */
$callFunc = msg_func ();

/* 获取信息 */
$member = member_query ( get_user ( 'uid' ), true );
/* 加载模板 */
$tpl = post_param ( 'template' );

include subtemplate ( $tpl );
?>