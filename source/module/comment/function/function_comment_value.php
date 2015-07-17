<?php
if (! defined ( 'APP_PATH' )) {
	exit ( 'no direct access allowed' );
}
function comment_value($_key = NULL, $is_arr = false) {
	$darr = array (
			'status' => array (
					'normal' => array (
							'val' => 0,
							'field' => 'normal',
							'title' => '正常',
							'description' => '“正常”将直接显示' 
					),
					'check' => array (
							'val' => 1,
							'field' => 'check',
							'title' => '人工审核',
							'description' => '“人工审核”则由管理员逐个操作才能显示' 
					),
					'recycle' => array (
							'val' => 2,
							'field' => 'recycle',
							'title' => '回收站',
							'description' => '“回收站”则由管理员逐个操作才能显示' 
					) 
			),
			'set_field' => array (
					'set' => array (
							'field' => 'set',
							'title' => '模块配置' 
					) 
			),
			'action_field' => array (
					'normal' => array (
							'field' => 'normal',
							'title' => '正常' 
					),
					'check' => array (
							'field' => 'check',
							'title' => '待审核' 
					),
					'recycle' => array (
							'field' => 'recycle',
							'title' => '回收站' 
					),
					'delete' => array (
							'field' => 'delete',
							'title' => '删除' 
					) 
			) 
	);
	if ($is_arr == false) {
		if (! array_key_exists ( $_key, $darr )) {
			$darr = NULL;
		} else {
			$darr = $darr [$_key];
		}
	}
	return $darr;
}
?>