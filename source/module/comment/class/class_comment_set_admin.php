<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}

loader ( 'class:class_common_set', 'common', true );
class class_comment_set_admin extends class_common_set {
	
	/* 析构函数 */
	function __construct() {
		parent::__construct ();
	}
	function class_comment_set_admin() {
		$this->__construct ();
	}
	
	/* 基本设置 */
	function baseset($fn_allow, $status, $content_minlen, $content_maxlen) {
		/* 回调参数 */
		$callFunc = msg_func ();
		$callFunc_b = msg_func ( 'callFunc_b' );
		
		/* 设置类型 */
		$_m = _M ();
		$_t = comment_value_get ( 'set_field', 'set', 'field' );
		
		/* 字段初始 */
		$dataArr [] = array (
				$_m,
				$_t,
				'fn_allow',
				$fn_allow 
		);
		$dataArr [] = array (
				$_m,
				$_t,
				'status',
				$status 
		);
		$dataArr [] = array (
				$_m,
				$_t,
				'content_minlen',
				$content_minlen 
		);
		$dataArr [] = array (
				$_m,
				$_t,
				'content_maxlen',
				$content_maxlen 
		);
		
		$result = $this->set_save ( $dataArr );
		unset ( $dataArr );
		if ($result == $this->db->cw) {
			showmsg ( lang ( 'global:dbexception' ), NULL, $callFunc );
		}
		showmsg ( lang ( 'global:dbsuccess' ), NULL, $callFunc );
	}
}
?>