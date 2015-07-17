<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}

$module = _M ();

/* 获取搜索值 */
$uid = post_int_param ( 'uid', 0 );
if (check_nums ( $uid ) < 1) {
	echo lang ( 'member_adm:msearch_stop_uid_fail' );
	return NULL;
}

$mc = loader ( 'class:class_member_control_admin', 'member', true, true );
$member = $mc->member_query ( 'uid', $uid );
if (check_is_array ( $member ) < 1) {
	echo lang ( 'member_adm:msearch_stop_uid_no_exists' );
}
/* 查询禁止项 */
$operation = $mc->member_operation_query ( 'uid', $uid );
/* 禁止值 */
$member_status = dc_value ( 'member_status' );
/* 禁止项 */
$stop_term = dc_value ( 'member_stop_term' );
$stop_term_num = array_number ( $stop_term );

include modtemplate ( 'member/admin/template/m_search_result_stop' );
?>