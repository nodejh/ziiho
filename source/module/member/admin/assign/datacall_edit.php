<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}

$module = _M ();

/* 回调url */
$callback_url = get_current_url ( false, adm_cookieurlkey () );
/* 获取参数 */
$dcid = get_int_param ( 'dcid' );
if (check_nums ( $dcid ) < 1) {
	tmsg ( lang ( 'common_adm:datacall_dcid_fail' ), $callback_url );
	return NULL;
}
/* 检查调用是否存在 */
$d = loader ( 'class:class_article_datacall', 'article', true, true );
$datacall = $d->datacall_query ( 'dcid', $dcid );
if (check_is_array ( $datacall ) < 1) {
	tmsg ( lang ( 'common_adm:datacall_dcid_no_exists' ), $callback_url );
	return NULL;
}
/* 解析参数设置 */
$values = de_serialize ( array_key_val ( 'values', $datacall ) );
$datacall = (check_is_array ( $values ) == 1) ? array_merge ( $datacall, $values ) : $datacall;
unset ( $values );
/* 获取模块模板 */
list ( $pg, $datastyle_list ) = get_module_datastyle ( $module );
/* 头像调用列表 */
list ( $headcall_num, $headcall_list ) = member_headcall_list ();
/* 时间调用列表 */
$date_list = dc_datecall ( NULL, true );
/* 数据调用排序 */
$dc_ordertype_arr = dc_value ( 'orderby' );

/* 提交url */
$save_url = modelurl ( 965 );

include modtemplate ( $module . '/admin/template/datacall_edit' );
unset ( $d, $dc, $c, $cat_list, $tc, $tc_list, $dc_order_list, $date_list );
return NULL;
?>