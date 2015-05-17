<?php
if (! defined ( 'APP_PATH' )) {
	exit ( 'no direct access allowed' );
}

/* 获取配置参数 */
function comment_value_get($m_key, $_key = NULL, $_kk = 'val', $_default_val = NULL) {
	$val = $_default_val;
	$arr = comment_value ( $m_key );
	if (check_is_key ( $_key, $arr ) == 1) {
		$d = (str_len ( $_kk ) < 1) ? $arr [$_key] : $_default_val;
		$val = array_key_val ( $_kk, $arr [$_key], $d );
	} else {
		$val = (str_len ( $_key ) < 1) ? $arr : $_default_val;
	}
	unset ( $arr );
	return $val;
}
/* 主题状态参数 */
function comment_status($_key = 'recycle', $_kk = 'val') {
	$statusVal = NULL;
	$status_arr = comment_value ( 'status' );
	if (check_is_key ( $_key, $status_arr ) == 1) {
		$statusVal = array_key_val ( $_kk, $status_arr [$_key] );
	}
	return $statusVal;
}
?>