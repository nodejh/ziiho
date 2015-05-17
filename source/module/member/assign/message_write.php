<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}

$module = _M ();

/* 设置当前url */
set_current_url ( true, true );

include subtemplate ( $module . '/message_write' );
?>