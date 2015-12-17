<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}

$module = _M ();

/* 初始化参数 */
$dsid = NULL;
$datastyle = NULL;
/* 回调url */
$callback_url = get_current_url ( false, adm_cookieurlkey () );
/* 提交url */
$save_url = modelurl ( 961 );
/* 获取变量 */
$variable_arr = common_datablock_tag ( member_databock_variable () );

include modtemplate ( $module . '/admin/template/datastyle_edit' );
?>