<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}
class model_member_profile extends class_common {
	
	/* 析构函数 */
	function __construct() {
		parent::__construct ();
	}
	function model_member_profile() {
		$this->__construct ();
	}
	
	/* 当前处理 */
	function mo() {
		$o = loader ( 'class:class_member_profile', _M (), true, true );
		return $o;
	}
	/* 初始化模块 */
	function model_import() {
		$this->load_mod ( 'ao', new self () );
	}
}
?>