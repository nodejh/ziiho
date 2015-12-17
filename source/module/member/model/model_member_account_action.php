<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}
class model_member_account_action extends class_common {
	
	/* 析构函数 */
	function __construct() {
		parent::__construct ();
	}
	function model_member_account_action() {
		$this->__construct ();
	}
	
	/* 密码设置模板 */
	function password() {
		loader ( 'assign:setting_password', _M () );
	}
	/* 密码设置保存 */
	function passworddo() {
		$this->mo ()->password_update ( post_param ( 'old_password' ), post_param ( 'password' ), post_param ( 'password2' ) );
	}
	
	/* 当前处理 */
	function mo() {
		$o = loader ( 'class:class_member_account', _M (), true, true );
		return $o;
	}
	/* 初始化模块 */
	function model_import() {
		$this->load_mod ( 'ao', new self () );
	}
}
?>