<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}

$module = _M ();

/* 获取配置 */
$sets = get_db_set ( array (
		'smodule' => $module,
		'stype' => common_value_get ( 'set_field', 'invitecodebaseset', 'field' ) 
) );
/* 获取过期天数 */
$validday = config_val ( 'validday', $sets );
if (check_nums ( $validday ) == 1) {
	/* 转换为秒 */
	$validdaytime = timesecond ( $validday, 'd' );
}
/* 邀请码类 */
$ICode = loader ( 'class:class_common_invitecode_admin', $module, true, true );
$db = $ICode->db;

/* 页码 */
$page = get_page ();
/* 获取状态 */
$status_field = get_param ( 'status' );
if (! empty ( $status_field )) {
	$status_field = common_value_get ( 'invitecode_status', $status_field, 'field' );
}
/* 显示个数 */
$page_size = 20;
/* 分页导航 */
$page_nums = 7;
/* 排序 */
$orderby = order_val ( 2 );

/* 查询 */
$db->from ( $ICode->table_common_invitecode );

/* 查询类型 */
switch ($status_field) {
	case common_value_get ( 'invitecode_status', 'default', 'field' ) :
		$db->where ( 'isbuy', 0 );
		break;
	case common_value_get ( 'invitecode_status', 'bought', 'field' ) :
		$db->where ( 'isbuy', 1 );
		break;
	case common_value_get ( 'invitecode_status', 'used', 'field' ) :
		$db->where_more ( 'registeruid', 1, '>=' );
		break;
	case common_value_get ( 'invitecode_status', 'notused', 'field' ) :
		$db->where ( 'isbuy', 1 );
		$db->where_fvop ( 'buytime', $_G ['app'] ['sys_time'], $validdaytime, '-', '<' );
		$db->where_more ( 'registeruid', 1, '<' );
		break;
	case common_value_get ( 'invitecode_status', 'overdue', 'field' ) :
		$db->where ( 'isbuy', 1 );
		$db->where_fvop ( 'buytime', $_G ['app'] ['sys_time'], $validdaytime, '-', '>' );
		$db->where_more ( 'registeruid', 1, '<' );
		break;
}
/* 获取总数 */
$total_num = $db->count_num ();
/* 计算分页 */
$pg = pagephow ( $total_num, $page_size, $page_nums, $page );
$db->limit ( $pg ['first_count'], $pg ['page_size'] );
$db->order_by ( 'uid', $orderby );
$result = $db->select ();
if ($result == $db->cw) {
	return $result;
}
$resultlist = $db->get_list ();

/* 分页url */
$pageparam = NULL;
if (check_num ( $status ) == 1) {
	$pageparam = '/status/' . $status_field;
}
$pg ['name'] = 'index';
$pg ['param'] = 'mod/common/ac/admin/op/invitecode/ao/manager' . $pageparam;

/* 设置当前url */
$callback_url = set_current_url ( false, true, 'sess_common_adm_invitecode' );

include modtemplate ( $module . '/admin/template/invitecode_manager' );
?>