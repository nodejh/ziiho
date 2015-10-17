<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}
class model_member_infocenter extends class_common {
	
	/* 析构函数 */
	function __construct() {
		parent::__construct ();
	}
	function model_member_infocenter() {
		$this->__construct ();
	}
	
	/* 大厅首页 */
	function index() {
		loader ( 'assign:infocenter', _M () );
	}
	
	/* 初始化模块 */
	function model_import() {
		member_access ();
		$this->load_mod ( 'op', new self () );
	}
}
?>