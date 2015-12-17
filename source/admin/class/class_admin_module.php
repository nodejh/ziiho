<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}
class class_admin_module extends class_model {
	
	/* 析构函数 */
	function __construct() {
		parent::__construct ();
	}
	function class_admin_module() {
		$this->__construct ();
	}
	
	/* 更改状态 */
	function status($module, $status) {
		/* 回调参数 */
		$callbackUrl = msg_param ();
		$callFunc = msg_func ();
		$callFunc_b = msg_func ( 'callFunc_b' );
		
		$module = strtolower ( $module );
		if (check_enl_el ( $module ) < 1) {
			showmsg ( lang ( 'admin:module_fail' ), NULL, $callFunc );
		}
		if (get_module_isCore ( $module )) {
			showmsg ( lang ( 'admin:module_core_noallow' ), NULL, $callFunc_b );
		}
		if (! set_module_status ( $module, $status )) {
			showmsg ( lang ( 'admin:module_status_do_error' ), NULL, $callFunc_b );
		}
		/* 更新缓存 */
		module_cache_write ();
		
		showmsg ( lang ( 'global:dbsuccess' ), $callbackUrl, $callFunc_b );
	}
}
?>