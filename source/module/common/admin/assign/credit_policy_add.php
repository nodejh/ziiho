<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}

$module = _M ();

/* 返回url */
$callback_url = get_current_url ( false, adm_cookieurlkey () );
/* 初始化参数 */
$creditrule = NULL;
/* 提交url */
$submiturl = url ( 'index', 'mod/common/ac/admin/op/credit/ao/policy_adddo' );

include modtemplate ( $module . '/admin/template/credit_policy_edit' );
?>