<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}
class model_member_notice extends class_common {
	
	/* 析构函数 */
	function __construct() {
		parent::__construct ();
	}
	function model_member_notice() {
		$this->__construct ();
	}
	
	/* 列表 */
	function index() {
		loader ( 'assign:notice', _M () );
	}
	/* 删除 */
	function del() {
		$this->mo ()->notice_del ( post_param ( 'noticeid' ) );
	}
	
	/* 当前处理 */
	function mo() {
		$o = loader ( 'class:class_member_notice', _M (), true, true );
		return $o;
	}
	/* 初始化模块 */
	function model_import() {
		member_access ();
		$this->load_mod ( 'op', new self () );
	}
}
?>