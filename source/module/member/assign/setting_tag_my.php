<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}

$module = _M ();

/* 获取配置 */
$tag_num_msg = lang ( 'member:setting_tagmy_num', 10 );

include subtemplate ( $module . '/setting_tag_my' );
?>