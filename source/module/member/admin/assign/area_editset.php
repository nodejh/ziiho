<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}

$module = _M ();

/* 获取回调url */
$callback_url = get_current_url ( false, adm_cookieurlkey () );

$aid = get_int_param ( 'aid' );
if (check_nums ( $aid ) < 1) {
	showmsg ( lang ( 'member_adm:area_aid_fail' ), $callback_url );
}
$areaObj = loader ( 'class:class_member_area_admin', $module, true, true );
/* 查询是否存在 */
$area = $areaObj->area_query ( 'aid', $aid );
if (check_is_array ( $area ) < 1) {
	showmsg ( lang ( 'article_adm:area_aid_notexist' ), $callback_url );
}
/* 分类导航 */
$an = $areaObj->area_nav ( $aid );
$area_nav = array_join_str ( '&nbsp;&raquo;&nbsp;', $an ['title_arr'] );

/* 选择分类 */
$optiontpl = modtemplate ( $module . '/admin/template/area_option' );
$select_option = $areaObj->area_option ( $optiontpl, $aid, true );

/* 提交url */
$submiturl = url ( 'index', 'mod/member/ac/admin/op/area/ao/area_editsetdo' );

include modtemplate ( $module . '/admin/template/area_editset' );
?>