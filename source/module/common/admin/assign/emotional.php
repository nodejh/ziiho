<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}

$module = _M ();

/* 组类 */
$eg = loader ( 'class:class_common_emotional_group', $module, true, true );
/* 表情类 */
$e = loader ( 'class:class_common_emotional', $module, true, true );
$db = $e->db;

/* 获取页码 */
$page = get_page ();
/* 分组 */
$emotgroupid = get_int_param ( 'emotgroupid', 0 );
/* 获取显示条数 */
$num_name = get_int_param ( 'qnum' );
$data_num = data_num_val ( $num_name, 20 );
/* 排序方式 */
$orderby = order_val ();

/* 查询 */
$db->from ( $e->table_common_emotional );
if (check_nums ( $emotgroupid ) == 1) {
	$db->where ( 'emotgroupid', $emotgroupid );
}
/* 获取总数 */
$total_num = $db->count_num ();
/* 计算分页 */
$pg = pagephow ( $total_num, $data_num, 7, $page );
$db->limit ( $pg ['first_count'], $pg ['page_size'] );
$db->order_by ( 'listorder', $orderby );
$db->select ();
$result = $db->get_list ();

/* 分页参数 */
$page_param = NULL;
if (! empty ( $num_name )) {
	$page_param = '/qnum/' . $num_name;
}
if (check_nums ( $emotgroupid ) == 1) {
	$page_param .= '/emotgroupid/' . $emotgroupid;
}
/* 当前url */
$pg ['name'] = 'index';
$pg ['param'] = 'mod/common/ac/admin/op/emotional/ao/emot/bo/emot' . $page_param;
/* 回调url */
$callback_url = set_current_url ( false, true, adm_cookieurlkey () );

/* 操作类型 */
$doaction = common_value_get ( 'action_field' );
/* 显示条数 */
$num_list = dc_value ( 'data_num' );

include modtemplate ( $module . '/admin/template/emotional' );
?>