<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}
class model_common_emotional_content extends class_common {
	
	/* 析构函数 */
	function __construct() {
		parent::__construct ();
	}
	function model_common_emotional_content() {
		$this->__construct ();
	}
	
	/* 显示 */
	function show() {
		loader ( 'assign:emotional', _M () );
	}
	/* ajax列表 */
	function ajaxlist() {
		loader ( 'assign:emotional_ajaxlist', _M () );
	}
	
	/* 初始化模块 */
	function model_import() {
		$this->load_mod ( 'ao', new self () );
	}
}
?>