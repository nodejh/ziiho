<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}
class model_member_entry extends class_common {
	
	/* 析构函数 */
	function __construct() {
		parent::__construct ();
	}
	function model_member_entry() {
		$this->__construct ();
	}
	
	/* 用户注册_模板 */
	function register() {
		loader ( 'assign:register', _M () );
	}
	/* 用户登录_模板 */
	function login() {
		loader ( 'assign:login', _M () );
	}
	/* 用户登录_窗口 */
	function loginwin() {
		loader ( 'assign:m_loginwindow', _M () );
	}
	/* 普通会员注册 */
	function registerdo() {
		$this->mo ()->_register ( strtolower ( post_param ( 'username' ) ), strtolower ( post_param ( 'email' ) ), post_param ( 'nickname' ), post_param ( 'password' ), post_param ( 'password2' ), strtolower ( post_param ( 'checkcode' ) ), strtolower ( post_param ( 'invitecode' ) ), get_current_url ( true ) );
	}
	/* 普通会员登录_验证 */
	function logindo() {
		$this->mo ()->_login ( strtolower ( post_param ( 'username' ) ), post_param ( 'password' ), strtolower ( post_param ( 'checkcode' ) ), get_current_url ( true ) );
	}
	/* 邀请码检查 */
	function invitecodecheck() {
		$this->mo ()->_invitecode ( strtolower ( post_param ( 'invitecode' ) ), strtolower ( post_param ( 'checkcode' ) ) );
	}
	/* 退出操作 */
	function logout() {
		$this->mo ()->_logout ( get_current_url ( true ) );
	}
	/* 登录检查 */
	function logincheck() {
		loader ( 'assign:login_check', _M () );
	}
	
	/* 当前处理 */
	function mo() {
		$o = loader ( 'class:class_member_entry', _M (), true, true );
		return $o;
	}
	/* 初始化模块 */
	function model_import() {
		$this->load_mod ( 'op', new self () );
	}
}
?>