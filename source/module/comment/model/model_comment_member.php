<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}
class model_comment_member extends class_common {
	
	/* 析构函数 */
	function __construct() {
		parent::__construct ();
	}
	function model_comment_member() {
		$this->__construct ();
	}
	
	/* 内容 */
	function content() {
		loader ( 'model:model_comment_content_member', _M (), true, true )->model_import ();
	}
	
	/* 初始化模块 */
	function model_import() {
		member_access ();
		$this->load_mod ( 'op', new self () );
	}
}
?>