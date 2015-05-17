<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}

$module = _M ();

/* 回调url */
$callback_url = get_current_url ( false, adm_cookieurlkey () );
/* 获取id */
$dsid = get_int_param ( 'dsid' );
if (check_nums ( $dsid ) < 1) {
	tmsg ( lang ( 'common_adm:datastyle_dsid_fail' ), $callback_url );
	return NULL;
}
/* 数据模板 */
$c = loader ( 'class:class_common_datastyle', 'common', true, true );
$datastyle = $c->datastyle_query ( 'dsid', $dsid );
if (check_is_array ( $datastyle ) < 1) {
	tmsg ( lang ( 'common_adm:datastyle_dsid_no_exists' ), $callback_url );
	return NULL;
}
$datastyle ['content'] = str_stripslashes ( array_key_val ( 'content', $datastyle ) );
/* 提交url */
$save_url = modelurl ( 217 );
/* 获取变量 */
$variable_arr = common_datablock_tag ( article_databock_variable () );

include modtemplate ( 'article/admin/template/datastyle_edit' );
return NULL;
?>