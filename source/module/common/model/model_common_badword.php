<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}
class model_common_badword extends class_common {
	
	/* 析构函数 */
	function __construct() {
		parent::__construct ();
	}
	function model_common_badword() {
		$this->__construct ();
	}
	
	/* 敏感词组 */
	function group() {
		loader ( 'model:model_common_badword_group', _M (), true, true )->model_import ();
	}
	/* 敏感词 */
	function filter() {
		loader ( 'model:model_common_badword_filter', _M (), true, true )->model_import ();
	}
	
	/* 初始化模块 */
	function model_import() {
		$this->load_mod ( 'ao', new self () );
	}
}
?>