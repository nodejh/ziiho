<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}

$module = _M ();

$page = get_page ();

$t = loader ( 'class:class_member_task_admin', 'member', true, true );
list ( $pg, $tb_list ) = $t->task_base_list ( 20, 7, $page );
$pg ['url_id'] = 185;

/* 任务类型初始化 */
$task_base_type = dc_value ( 'task_base_type' );

include modtemplate ( $module . '/admin/template/m_task_base' );
?>