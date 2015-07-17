<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}

$module = _M ();

/* 获取模块模板 */
list ( $pg, $datastyle_list ) = get_module_datastyle ( $module );
/* 内容分类 */
$c = loader ( 'class:class_article_category_admin', 'article', true, true );
$cat_list = $c->cat_display_option ();
/* 时间调用列表 */
$date_list = dc_datecall ( NULL, true );
/* 数据调用排序 */
$dc_ordertype_arr = config_value_get ( 'orderby' );

/* 初始化参数 */
$dcid = NULL;
$datacall = NULL;
/* 提交url */
$save_url = modelurl ( 212 );
/* 回调url */
$callback_url = get_current_url ( false, adm_cookieurlkey () );

include modtemplate ( $module . '/admin/template/a_datacall_edit' );
return NULL;
?>