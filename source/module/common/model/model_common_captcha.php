<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}
class model_common_captcha extends class_common {
	
	/* 析构函数 */
	function __construct() {
		parent::__construct ();
	}
	function model_common_captcha() {
		$this->__construct ();
	}
	
	/* 调用 */
	function rc() {
		$this->mo ()->captcha_create ();
	}
	
	/* 当前处理 */
	function mo() {
		$o = loader ( 'class:class_common_captcha', _M (), true, true );
		return $o;
	}
	/* 初始化模块 */
	function model_import() {
		$this->load_mod ( 'op', new self () );
	}
}
?>