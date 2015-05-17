<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}
class model_member_profile_action extends class_common {
	
	/* 析构函数 */
	function __construct() {
		parent::__construct ();
	}
	function model_member_profile_action() {
		$this->__construct ();
	}
	
	/* 资料设置模板 */
	function base() {
		loader ( 'assign:setting_profile_base', _M () );
	}
	/* 资料设置保存 */
	function basedo() {
		$this->mo ()->profile_base ( post_param ( 'nickname' ), post_param ( 'gender' ), post_param ( 'birthday' ), post_param ( 'hometown' ), post_param ( 'address' ), post_param ( 'inform' ) );
	}
	
	/* 当前处理 */
	function mo() {
		$o = loader ( 'class:class_member_profile', _M (), true, true );
		return $o;
	}
	/* 初始化模块 */
	function model_import() {
		$this->load_mod ( 'ao', new self () );
	}
}
?>