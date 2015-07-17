<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}
class model_common_show extends class_common {
	
	/* 析构函数 */
	function __construct() {
		parent::__construct ();
	}
	function model_common_show() {
		$this->__construct ();
	}
	
	/* 展示组 */
	function group() {
		loader ( 'model:model_common_showgroup', _M (), true, true )->model_import ();
	}
	/* 展示数据 */
	function data() {
		loader ( 'model:model_common_showdata', _M (), true, true )->model_import ();
	}
	
	/* 初始化模块 */
	function model_import() {
		$this->load_mod ( 'ao', new self () );
	}
}
?>