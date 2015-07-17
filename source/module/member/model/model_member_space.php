<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}
class model_member_space extends class_common {
	
	/* 析构函数 */
	function __construct() {
		parent::__construct ();
	}
	function model_member_space() {
		$this->__construct ();
	}
	
	/* 个人主页 */
	function index() {
		loader ( 'assign:m_index', _M () );
	}
	/* 资料信息窗口 */
	function profilewin() {
		loader ( 'assign:m_profile_window', _M (), true, true );
	}
	
	/* 初始化模块 */
	function model_import() {
		$this->load_mod ( 'op', new self () );
	}
}
?>