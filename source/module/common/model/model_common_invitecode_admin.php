<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}
class model_common_invitecode_admin extends class_common {
	
	/* 析构函数 */
	function __construct() {
		parent::__construct ();
	}
	function model_common_invitecode_admin() {
		$this->__construct ();
	}
	
	/* 基本设置_模板 */
	function baseset() {
		loader ( 'admin:assign:invitecode_baseset', _M () );
	}
	/* 基本设置_保存 */
	function baseset_setdo() {
		$this->mo ()->baseset ( post_param ( 'validday' ), post_param ( 'cost' ), post_param ( 'costtype' ), post_array_param ( 'costmembergroup' ) );
	}
	/* 邀请码管理_模板 */
	function manager() {
		loader ( 'admin:assign:invitecode_manager', _M () );
	}
	/* 邀请码_查询 */
	function manager_qrs() {
		loader ( 'admin:assign:invitecode_query', _M () );
	}
	/* 邀请码生成_模板 */
	function manager_create() {
		loader ( 'admin:assign:invitecode_create', _M () );
	}
	/* 邀请码生成_提交 */
	function manager_createdo() {
		$this->mo ()->invitecode_create ( post_param ( 'num' ) );
	}
	/* 邀请码_删除 */
	function manager_del() {
		$this->mo ()->invitecode_del ( post_array_param ( 'invitecodeid' ) );
	}
	
	/* 当前处理 */
	function mo() {
		$o = loader ( 'class:class_common_invitecode_admin', _M (), true, true );
		return $o;
	}
	/* 初始化模块 */
	function model_import() {
		admin_access ( 'index', 'mod,ac,op,ao' );
		$this->load_mod ( 'ao', new self () );
	}
}
?>