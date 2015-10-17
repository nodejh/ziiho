<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}

$module = _M ();

/* 获取模板 */
$template = post_param ( 'template' );

include subtemplate ( $module . '/' . $template );
?>