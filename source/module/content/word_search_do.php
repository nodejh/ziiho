<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}

$module = _M ();

sleep ( 1 );
/* 获取搜索字 */
$word = post_param ( 'word' );
/* 搜索字长度 */
$word_len = str_len ( $word );
if ($word_len >= 1) {
	/* 截取关键字 */
	$word = str_urlencode ( sub_str ( $word, 0, 38 ) );
}
showmsg ( NULL, modelurl ( 883, array (
		'word' => $word 
) ), msg_func () );
?>