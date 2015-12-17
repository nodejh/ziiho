<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}
class model_member_group_admin extends class_common {
	
	/* 析构函数 */
	function __construct() {
		parent::__construct ();
	}
	function model_member_group_admin() {
		$this->__construct ();
	}
	
	/* 列表 */
	function level() {
		loader ( 'admin:assign:member_group_level', _M () );
	}
	/* 组简单添加 */
	function level_baseadd() {
		$this->mo ()->group_baseadd ( post_param ( 'grouptype' ), post_param ( 'title' ), post_param ( 'credit' ) );
	}
	/* 组简单编辑 */
	function level_baseedit() {
		$this->mo ()->group_baseedit ( post_param ( 'grouptype' ), post_array_param ( 'groupid' ), post_array_param ( 'title' ), post_array_param ( 'credit' ) );
	}
	/* 组编辑设置 */
	function level_editset() {
		loader ( 'admin:assign:member_group_edit', _M () );
	}
	/* 组编辑设置保存 */
	function level_editsetdo() {
		$this->mo ()->group_editset ( post_param ( 'groupid' ), post_param ( 'title' ), post_param ( 'credit' ), post_param ( 'module' ), post_param ( 'settingdo' ) );
	}
	/* 组删除 */
	function level_del() {
		$this->mo ()->group_del ( post_param ( 'grouptype' ), post_array_param ( 'groupid' ) );
	}
	
	/* 当前处理 */
	function mo() {
		$o = loader ( 'class:class_member_group_admin', _M (), true, true );
		return $o;
	}
	/* 初始化模块 */
	function model_import() {
		admin_access ( 'index', 'mod,ac,op,ao' );
		$this->load_mod ( 'ao', new self () );
	}
}
?>