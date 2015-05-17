<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}
class model_member_datacall_admin extends class_common {
	
	/* 析构函数 */
	function __construct() {
		parent::__construct ();
	}
	function model_member_datacall_admin() {
		$this->__construct ();
	}
	
	/* 添加模板 */
	function add() {
		loader ( 'admin:assign:datacall_add', _M () );
	}
	/* 添加保存 */
	function adds() {
		$this->mo ()->add ( post_param ( 'did' ), post_param ( 'avatarwidth' ), post_param ( 'avatarheight' ), post_param ( 'ordertype' ), post_param ( 'isrand' ), post_param ( 'startnum' ), post_param ( 'offsetnum' ), post_param ( 'usernamelen' ), post_param ( 'informlen' ) );
	}
	/* 编辑模板 */
	function edit() {
		loader ( 'admin:assign:datacall_edit', _M () );
	}
	/* 编辑保存 */
	function edits() {
		$this->mo ()->edit ( post_param ( 'did' ), post_param ( 'avatarwidth' ), post_param ( 'avatarheight' ), post_param ( 'ordertype' ), post_param ( 'isrand' ), post_param ( 'startnum' ), post_param ( 'offsetnum' ), post_param ( 'usernamelen' ), post_param ( 'informlen' ) );
	}
	
	/* 当前处理 */
	function mo() {
		$o = loader ( 'class:class_member_datacall_admin', _M (), true, true );
		return $o;
	}
	/* 初始化模块 */
	function model_import() {
		$this->load_mod ( 'ao', new self () );
	}
}
?>