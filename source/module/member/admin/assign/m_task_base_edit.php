<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}

$module = _M ();

/* 检查任务是否存在 */
$tb_id = get_int_param ( 'tb_id' );
if (check_nums ( $tb_id ) < 1) {
	tmsg ( lang ( 'member_adm:task_base_edit_tb_id_fail' ), modelurl ( 185 ) );
}
$t = loader ( 'class:class_member_task_admin', 'member', true, true );
$tb = $t->task_base_query ( 'tb_id', $tb_id );
if (check_is_array ( $tb ) < 1) {
	tmsg ( lang ( 'member_adm:task_base_edit_tb_id_no_exists' ), modelurl ( 185 ) );
	return NULL;
}
/* 任务类型初始化 */
$task_base_type = dc_value ( 'task_base_type' );
$g = loader ( 'class:class_member_group_admin', 'member', true, true );
list ( , $system_group ) = $g->group_show_list ( member_group_type_val ( 'system' ), 100 );
list ( , $member_group ) = $g->group_show_list ( member_group_type_val ( 'member' ), 100 );

include modtemplate ( 'member/admin/template/m_task_base_edit' );
?>