<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}
class model_comment_admin extends class_common {
	
	/* 析构函数 */
	function __construct() {
		parent::__construct ();
	}
	function model_comment_admin() {
		$this->__construct ();
	}
	
	/* 内容 */
	function content() {
		loader ( 'model:model_comment_content_admin', _M (), true, true )->model_import ();
	}
	/* 设置 */
	function set() {
		loader ( 'model:model_comment_set_admin', _M (), true, true )->model_import ();
	}
	
	/* 初始化模块 */
	function model_import() {
		$this->load_mod ( 'op', new self () );
	}
}
?>