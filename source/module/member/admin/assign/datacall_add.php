<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}

$module = _M ();

/* 获取模块模板 */
list ( $pg, $datastyle_list ) = get_module_datastyle ( $module );
/* 头像调用列表 */
list ( $headcall_num, $headcall_list ) = member_headcall_list ();
/* 时间调用列表 */
$date_list = dc_datecall ( NULL, true );
/* 数据调用排序 */
$dc_ordertype_arr = config_value_get ( 'orderby' );

/* 初始化参数 */
$dcid = NULL;
$datacall = NULL;
/* 提交url */
$save_url = modelurl ( 959 );
/* 回调url */
$callback_url = get_current_url ( false, adm_cookieurlkey () );

include modtemplate ( $module . '/admin/template/datacall_edit' );
?>