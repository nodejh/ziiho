<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}

$module = _M ();

/* 类型 */
$t = loader ( 'class:class_common_sense_type', $module, true, true );
/* 表态动作类 */
$s = loader ( 'class:class_common_sense', $module, true, true );
$db = $s->db;

/* 获取页码 */
$page = get_page ();
/* 分组 */
$sensetypeid = get_int_param ( 'sensetypeid', 0 );
/* 排序方式 */
$orderby = order_val ();

/* 查询 */
$db->from ( $s->table_common_sense );
if (check_nums ( $sensetypeid ) == 1) {
	$db->where ( 'sensetypeid', $sensetypeid );
}
/* 获取总数 */
$total_num = $db->count_num ();
/* 计算分页 */
$pg = pagephow ( $total_num, 20, 7, $page );
$db->limit ( $pg ['first_count'], $pg ['page_size'] );
$db->order_by ( 'listorder', $orderby );
$db->select ();
$result = $db->get_list ();

/* 回调url */
$callback_url = set_current_url ();
/* 操作类型 */
$doaction = common_value_get ( 'action_field' );

include modtemplate ( $module . '/admin/template/sense' );
?>