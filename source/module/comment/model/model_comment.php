<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}
class model_comment extends class_common {
	
	/* 析构函数 */
	function __construct() {
		parent::__construct ();
	}
	function model_comment() {
		$this->__construct ();
	}
	
	/* 内容 */
	function content() {
		loader ( 'model:model_comment_content', _M (), true, true )->model_import ();
	}
	/* 会员模块 */
	function member() {
		loader ( 'model:model_comment_member', _M (), true, true )->model_import ();
	}
	/* 管理模块 */
	function admin() {
		loader ( 'model:model_comment_admin', _M (), true, true )->model_import ();
	}
	
	/* 初始化模块 */
	function model_import() {
		$this->load_mod ( 'ac', new self () );
	}
}
?>