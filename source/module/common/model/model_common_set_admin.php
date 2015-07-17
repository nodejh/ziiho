<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}
class model_common_set_admin extends class_common {
	
	/* 析构函数 */
	function __construct() {
		parent::__construct ();
	}
	function model_common_set_admin() {
		$this->__construct ();
	}
	
	/* ----------------站点设置-------------------- */
	/*站点访问与控制_设置保存*/
	function sitecontrol_do() {
		$this->mo ()->sitecontrol ( post_param ( 'site_status' ), post_val ( 'site_status_item' ) );
	}
	/* 站点基本信息_设置模板 */
	function sitebase() {
		loader ( 'admin:assign:sitebase_set', _M () );
	}
	/* 站点邮箱_设置模板 */
	function emailset() {
		loader ( 'admin:assign:siteemail_set', _M () );
	}
	/* 站点邮箱_设置保存 */
	function emailset_save() {
		$this->mo ()->siteemail_set ( post_param ( 'status' ), post_param ( 'types' ), post_param ( 'smtp_server' ), post_param ( 'smtp_port' ), post_param ( 'smtp_from_email' ), post_param ( 'smtp_auth' ), post_param ( 'smtp_auth_username' ), post_param ( 'smtp_auth_password' ) );
	}
	/* 站点访问与控制_设置模板 */
	function sitecontrol() {
		loader ( 'admin:assign:sitecontrol_set', _M () );
	}
	/* 站点基本信息_设置保存 */
	function sitebase_save() {
		$this->mo ()->sitebase_set ( post_param ( 'site_name' ), post_param ( 'web_name' ), post_param ( 'web_url' ), post_param ( 'admin_email' ), post_param ( 'permit_code' ) );
	}
	/* 参数_设置模板 */
	function setting() {
		loader ( 'admin:assign:set', _M () );
	}
	/* 参数_设置保存 */
	function setting_do() {
		$this->mo ()->setting ( post_param ( 'timezone' ), post_param ( 'timeoffset' ) );
	}
	/* ----------------注册设置-------------------- */
	/*注册设置_模板*/
	function registerset() {
		loader ( 'admin:assign:register_set', _M () );
	}
	/* 注册设置_保存 */
	function registerset_setdo() {
		$this->mo ()->register_set ( post_param ( 'register_type' ), post_param ( 'ischeckcode' ), post_param ( 'invitecode_msg' ), post_param ( 'close_msg' ), post_param ( 'toemailregister' ), post_param ( 'status' ), post_param ( 'send_system_msg' ), post_param ( 'send_email_msg' ), post_param ( 'msg_title' ), post_param ( 'msg_content' ), post_param ( 'show_serve_item' ), post_param ( 'serve_item_content' ) );
	}
	/* 站点seo_设置模板 */
	function siteseo() {
		loader ( 'admin:assign:siteseo_set', _M () );
	}
	/* 站点seo_设置保存 */
	function siteseo_save() {
		$this->mo ()->siteseo_set ( post_param ( 'index_title' ), post_param ( 'index_keywords' ), post_param ( 'index_description' ) );
	}
	/* ----------------站点风格-------------------- */
	/*站点风格_设置模板*/
	function sitestyle() {
		loader ( 'admin:assign:sitestyle_set', _M () );
	}
	/* 站点风格_设置保存 */
	function sitestyle_save() {
		$this->mo ()->sitestyle_set ( post_param ( 'templateid' ), post_param ( 'navid' ) );
	}
	/* ----------------性能优化-------------------- */
	/*服务器优化_设置模板*/
	function serveroptimize() {
		loader ( 'admin:assign:serveroptimize', _M () );
	}
	/* 服务器优化_设置保存 */
	function serveroptimize_do() {
		$this->mo ()->serveroptimize_set ( post_param ( 'temp_attach_expire' ), post_array_param ( 'thumb_clear_time' ), post_param ( 'onlinehold' ) );
	}
	
	/* 当前处理 */
	function mo() {
		$o = loader ( 'class:class_common_set_admin', _M (), true, true );
		return $o;
	}
	/* 初始化模块 */
	function model_import() {
		admin_access ( 'index', 'mod,ac,op,ao' );
		$this->load_mod ( 'ao', new self () );
	}
}
?>