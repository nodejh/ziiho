<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}

$module = _M ();

/* 任务类型初始化 */
$task_base_type = dc_value ( 'task_base_type' );
$g = loader ( 'class:class_member_group_admin', 'member', true, true );
list ( , $system_group ) = $g->group_show_list ( member_group_type_val ( 'system' ), 100 );
list ( , $member_group ) = $g->group_show_list ( member_group_type_val ( 'member' ), 100 );

include modtemplate ( $module . '/admin/template/m_task_base_add' );
?>