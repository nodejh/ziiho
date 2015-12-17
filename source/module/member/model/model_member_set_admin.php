<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}
class model_member_set_admin extends class_common {
	
	/* 析构函数 */
	function __construct() {
		parent::__construct ();
	}
	function model_member_set_admin() {
		$this->__construct ();
	}
	
	/* 会员组初始化设置_模板 */
	function memberinit() {
		loader ( 'admin:assign:set_memberinit', _M () );
	}
	/* 会员组初始化设置_保存 */
	function memberinit_do() {
		$this->mo ()->memberinit ( post_param ( 'member_groupid' ), post_array_param ( 'credit' ) );
	}
	/* 基本设置_模板 */
	function baseset() {
		loader ( 'admin:assign:baseset', _M () );
	}
	/* 基本设置_保存 */
	function baseset_setdo() {
		$this->mo ()->baseset ( post_param ( 'allowlogin' ), post_param ( 'logincheckcode' ), post_param ( 'username_min' ), post_param ( 'username_max' ), post_param ( 'password_min' ), post_param ( 'password_max' ) );
	}
	/* 头像设置_模板 */
	function avatarset() {
		loader ( 'admin:assign:avatar_set', _M () );
	}
	/* 头像设置_保存 */
	function avatarset_setdo() {
		$this->mo ()->avatarset ( post_param ( 'dir' ), post_array_param ( 'extension' ), post_param ( 'size' ), post_param ( 'quality' ), post_param ( 'allow_width' ), post_param ( 'allow_height' ), post_param ( 'thumb_width' ), post_param ( 'thumb_height' ), post_param ( 'crop_minwidth' ), post_param ( 'crop_minheight' ) );
	}
	
	/* 当前处理 */
	function mo() {
		$o = loader ( 'class:class_member_set_admin', _M (), true, true );
		return $o;
	}
	/* 初始化模块 */
	function model_import() {
		admin_access ( 'index', 'mod,ac,op,ao' );
		$this->load_mod ( 'ao', new self () );
	}
}
?>