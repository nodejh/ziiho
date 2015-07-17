<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}

$module = _M ();

$emotgroupid = post_int_param ( 'emotgroupid' );

include subtemplate ( $module . '/emotional_ajaxlist' );
?>