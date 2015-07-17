<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}
class model_common_emotional extends class_common {
	
	/* 析构函数 */
	function __construct() {
		parent::__construct ();
	}
	function model_common_emotional() {
		$this->__construct ();
	}
	
	/* 表情 */
	function content() {
		loader ( 'model:model_common_emotional_content', _M (), true, true )->model_import ();
	}
	
	/* 初始化模块 */
	function model_import() {
		$this->load_mod ( 'op', new self () );
	}
}
?>