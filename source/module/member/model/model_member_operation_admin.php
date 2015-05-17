<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}
class model_member_operation_admin extends class_common {
	
	/* 析构函数 */
	function __construct() {
		parent::__construct ();
	}
	function model_member_operation_admin() {
		$this->__construct ();
	}
	
	/* 会员搜索_模板 */
	function search() {
		loader ( 'admin:assign:search', _M () );
	}
	/* 会员搜索_提交 */
	function search_qrs() {
		loader ( 'admin:assign:search_query', _M () );
	}
	/* 会员管理组_设置模板 */
	function search_systemgroup() {
		loader ( 'admin:assign:search_systemgroup', _M () );
	}
	/* 会员管理组_设置保存 */
	function search_systemgroup_save() {
		$this->mo ()->system_group ( post_int_param ( 'set_uid' ), post_param ( 'system_groupid' ), post_array_param ( 'menu_id' ) );
	}
	/* 会员禁止_操作模板 */
	function search_stop() {
		loader ( 'admin:assign:search_stop', _M () );
	}
	/* 会员禁止_操作保存 */
	function search_stop_save() {
		$this->mo ()->stop ( post_int_param ( 'set_uid' ), post_param ( 'member_status' ), post_array_param ( 'member_stop_term' ) );
	}
	/* 会员添加_模板 */
	function add() {
		loader ( 'admin:assign:member_add', _M () );
	}
	/* 会员添加_保存 */
	function add_save() {
		$this->mo ()->member_add ( post_param ( 'username' ), post_param ( 'email' ), post_param ( 'password' ), post_param ( 'password2' ), post_param ( 'admin_groupid' ) );
	}
	
	/* 当前处理 */
	function mo() {
		$o = loader ( 'class:class_member_operation_admin', _M (), true, true );
		return $o;
	}
	/* 初始化模块 */
	function model_import() {
		admin_access ( 'index', 'mod,ac,op,ao' );
		$this->load_mod ( 'ao', new self () );
	}
}
?>