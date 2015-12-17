<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}

$module = _M ();

/* 获取参数 */
$uid = get_param ( 'uid' );
$username = get_param ( 'username' );
$_where = array ();
/* 检查uid */
if (check_nums ( $uid ) == 1) {
	$_where ['uid'] = $uid;
}
/* 检查username */
if (str_len ( $username ) >= 1) {
	if (check_enl_len ( $username ) == 1) {
		$_where ['username'] = $username;
	}
}
/* 初始化参数 */
$total_num = 0;
$m = NULL;
$db = NULL;
if (check_is_array ( $_where ) == 1) {
	/* 获取页码 */
	$page = get_page ();
	/* 显示多少个 */
	$page_size = 10;
	/* 分页导航 */
	$page_nums = 5;
	/* 排序 */
	$orderby = order_val ( 2 );
	
	/* 初始化类 */
	$m = loader ( 'class:class_member', 'member', true, true );
	$db = $m->db;
	
	$db->from ( $m->table_member );
	$db->where_more ( 'uid', 1, '!=' );
	$db->where ( $_where );
	/* 获取总数 */
	$total_num = $db->count_num ();
	/* 计算分页 */
	/*
	$ms_pg=pagephow($total_num,$page_size,$page_nums,$page);
	$db->limit($ms_pg['first_count'],$ms_pg['page_size']);
	$db->order_by('uid',$orderby);
	*/
	$result = $db->select ();
	if ($result == $db->cw) {
		return $result;
	}
	/*
	 * $ms_list=$db->get_list();
	 */
	$result = $db->get_one ();
}

/* 显示没有搜到的字符串 */
$result_str = lang ( 'member_adm:message_search_result_count', $total_num );

if ($total_num < 1) {
	$template = 'message_send_findmember_null';
} else {
	$template = 'message_write';
	$msg_variable_arr = member_config_value_get ( 'message_variable_name' );
	$msg_type = member_config_value_get ( 'message_type' );
	$msg_content_type = member_config_value_get ( 'message_content_type' );
	$msg_send_status = member_config_value_get ( 'message_send_status' );
}

/* 返回url */
$backurl = modelurl ( 157 );

include modtemplate ( $module . '/admin/template/' . $template );
?>