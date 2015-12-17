<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}

$module = _M ();

/* 返回url */
$callback_url = set_current_url ( false, true, adm_cookieurlkey () );

/* 组对象 */
$MGObj = loader ( 'class:class_member_group_admin', $module, true, true );

/* 如果已设置获取组类型 */
$grouptypeKey = get_param ( 'grouptype' );
if (empty ( $grouptypeKey )) {
	$grouptypeKey = 'system';
}
/* 初始化一个组类型 */
$default_GroupType = member_grouptype ( $grouptypeKey );
unset ( $grouptypeKey );

/* 组列表类型 */
$groupTypeList = member_grouptype ();

include modtemplate ( $module . '/admin/template/member_group_level' );
?>