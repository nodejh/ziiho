<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}

/* 数据调用变量 */
function common_datablock_tag($module_variable = NULL) {
	$arr = array (
			'loop' => array (
					'val' => tag_name_set ( 'loop' ) . '\r\r\n' . tag_name_set ( '/loop' ),
					'tag' => tag_name_set ( 'loop' ) . '...' . tag_name_set ( '/loop' ),
					'title' => '循环数据列表' 
			),
			'index' => array (
					'val' => tag_name_set ( 'index=N' ) . '\r\r\n' . tag_name_set ( '/index' ),
					'tag' => tag_name_set ( 'index=N' ) . '...' . tag_name_set ( '/index' ),
					'title' => '对应loop中指定第N行数据显示的内容',
					'msg' => '在loop中生效' 
			),
			'mod' => array (
					'val' => tag_name_set ( 'mod=N' ) . '\r\r\n' . tag_name_set ( '/mod' ),
					'tag' => tag_name_set ( 'mod=N' ) . '...' . tag_name_set ( '/mod' ),
					'title' => '对应loop中指定数据行能被N整除时，数据显示的内容',
					'msg' => '在loop中生效' 
			),
			'listorder' => array (
					'val' => tag_name_set ( 'listorder=odd' ) . '\r\r\n' . tag_name_set ( '/listorder' ),
					'tag' => tag_name_set ( 'listorder=odd' ) . '...' . tag_name_set ( '/listorder' ),
					'title' => '对应loop中指定数据行{listorder=odd}为奇数，{listorder=even}为偶数时，数据显示的内容',
					'msg' => '在loop中生效' 
			) 
	);
	if (check_is_array ( $module_variable ) == 1) {
		$arr = array_merge ( $arr, $module_variable );
	}
	return $arr;
}
/* 数据调用变量 */
function common_datablock_variable($module_variable = NULL) {
	$arr = array (
			'rownum' => array (
					'field' => 'rownum',
					'val' => tag_name_set ( 'rownum' ),
					'tag' => tag_name_set ( 'rownum' ),
					'title' => '数据显示行数',
					'msg' => '在loop中生效' 
			) 
	);
	if (check_is_array ( $module_variable ) == 1) {
		$arr = array_merge ( $arr, $module_variable );
	}
	return $arr;
}
?>