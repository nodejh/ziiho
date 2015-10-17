<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}

$module = _M ();

/* 获取参数 */
$aid = get_int_param ( 'aid', 0 );
$page = get_page ();
/* 地区类 */
$areaObj = loader ( 'class:class_member_area_admin', 'member', true, true );
$db = $areaObj->db;

$db->from ( $areaObj->table_member_area );
$db->where ( 'aids', $aid );
$db->order_by ( 'listorder' );
$total_num = $db->count_num ();
/* 计算分页 */
$pg = pagephow ( $total_num, 20, 7, $page );
$db->limit ( $pg ['first_count'], $pg ['page_size'] );
$result = $db->select ();
if ($result == $db->cw) {
	return $result;
}
$lists = $db->get_list ();

/* 当前url参数 */
$url_param = NULL;
/* 获取分类位置 */
$area_nav_arr = NULL;
if (check_nums ( $aid ) == 1) {
	$area_nav = $areaObj->area_nav ( $aid );
	$area_nav_arr = $area_nav ['title_arr'];
	$area_nav_len = $area_nav ['len'];
	
	$url_param = '/aid/' . $aid;
}
$pg ['name'] = 'index';
$pg ['param'] = 'mod/member/ac/admin/op/area/ao/area' . $url_param;
/* 返回url */
$callback_url = set_current_url ( false, true, adm_cookieurlkey () );

include modtemplate ( $module . '/admin/template/area' );
?>