<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}

$module = _M ();

/* 已登录会员 */
$sess_uid = get_user ( 'uid' );
/* 获取参数 */
$smodule = post_param ( 'smodule' );
$idtype = post_param ( 'idtype' );
$sid = post_int_param ( 'sid' );

if (check_en_ep ( $smodule ) < 1) {
	$smodule = NULL;
}
if (check_en_ep ( $idtype ) < 1) {
	$idtype = NULL;
}

include subtemplate ( $module . '/content_list' );
?>