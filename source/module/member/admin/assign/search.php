<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}

$module = _M ();

/* 设置当前url */
$callback_url = set_current_url ( false, true, 'sess_member_adm_search' );

/* 当前操作会员 */
$sess_uid = get_user ( 'uid' );
/* 页码 */
$page = get_page ();
/* 获取状态 */
$status_field = get_param ( 'q_status' );
$status = member_status ( $status_field );
/* 获取uid */
$q_uid = get_int_param ( 'q_uid' );
/* 获取username */
$q_username = get_param ( 'q_username' );
/* 获取天数 */
$q_day = get_int_param ( 'q_day', 0 );
$day = day_val ( $q_day );
/* 获取排序方式 */
$q_order = get_int_param ( 'q_order', 2 );
$orderby = order_val ( $q_order );
/* 获取显示条数 */
$q_num = get_int_param ( 'q_num', 2 );
$page_size = data_num_val ( $q_num );
/* 分页导航 */
$page_nums = 7;

$pg = NULL;
$searchResult = NULL;
/* 初始化类 */
$memberobj = loader ( 'class:class_member', _M (), true, true );
$db = $memberobj->db;

if ($q_uid >= 1 || ! empty ( $q_username )) {
	
	$db->from ( $memberobj->table_member );
	$db->where_more ( 'uid', 1, '!=' );
	$db->where_more ( 'uid', $sess_uid, '!=' );
	/* uid */
	if ($q_uid >= 1) {
		$db->where ( 'uid', $q_uid );
	}
	/* 用户名 */
	if (! empty ( $q_username )) {
		$db->where_match ( 'username', '(.*' . $q_username . '.*)$' );
	}
	/* 注册时间 */
	if ($day >= 1) {
		$db->where_day ( 'register_time', $day );
	}
	if (! empty ( $status )) {
		$db->where ( 'status', $status );
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
	$searchResult = $db->get_list ();
	
	/* 当前url */
	$pageparam = NULL;
	if (! empty ( $status_field )) {
		$pageparam .= '/q_status/' . $status_field;
	}
	if (! empty ( $q_uid )) {
		$pageparam .= '/q_uid/' . $q_uid;
	}
	if (! empty ( $q_username )) {
		$pageparam .= '/q_username/' . $q_username;
	}
	if (! empty ( $q_day )) {
		$pageparam .= '/q_day/' . $q_day;
	}
	if (! empty ( $q_order )) {
		$pageparam .= '/q_order/' . $q_order;
	}
	if (! empty ( $q_num )) {
		$pageparam .= '/q_num/' . $q_num;
	}
	
	$pg ['name'] = 'index';
	$pg ['param'] = 'mod/member/ac/admin/op/operation/ao/search' . $pageparam;
}

include modtemplate ( $module . '/admin/template/search' );
?>