<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}
class model_member_tag extends class_common {
	
	/* 析构函数 */
	function __construct() {
		parent::__construct ();
	}
	function model_member_tag() {
		$this->__construct ();
	}
	
	/* 标签名显示 */
	function lists() {
		loader ( 'assign:setting_tag_list', _M () );
	}
	
	/* 当前处理 */
	function mo() {
		$o = loader ( 'class:class_member_tag', _M (), true, true );
		return $o;
	}
	/* 初始化模块 */
	function model_import() {
		$this->load_mod ( 'op', new self () );
	}
}
?>