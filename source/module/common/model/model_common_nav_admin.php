<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}
class model_common_nav_admin extends class_common {
	
	/* 析构函数 */
	function __construct() {
		parent::__construct ();
	}
	function model_common_nav_admin() {
		$this->__construct ();
	}
	
	/* 主导航_模板 */
	function main() {
		loader ( 'admin:assign:main_nav', _M () );
	}
	/* 主导航__添加设置模板 */
	function main_addset() {
		loader ( 'admin:assign:main_nav_addset', _M () );
	}
	/* 主导航__添加设置保存 */
	function main_addsets() {
		$this->mo ()->main_addset ( post_param ( 'new_navid' ), post_param ( 'module' ), post_param ( 'listorder' ), post_param ( 'title' ), post_param ( 'navurl' ), post_param ( 'ofkey' ), post_param ( 'ofval' ), post_param ( 'navxy' ), post_param ( 'target' ), post_param ( 'disabled' ) );
	}
	/* 主导航_编辑设置模板 */
	function main_editset() {
		loader ( 'admin:assign:main_nav_editset', _M () );
	}
	/* 主导航_编辑设置保存 */
	function main_editsets() {
		$this->mo ()->main_editset ( post_param ( 'navid' ), post_param ( 'new_navid' ), post_param ( 'module' ), post_param ( 'listorder' ), post_param ( 'title' ), post_param ( 'navurl' ), post_param ( 'ofkey' ), post_param ( 'ofval' ), post_param ( 'navxy' ), post_param ( 'target' ), post_param ( 'disabled' ) );
	}
	/* 主导航_列表保存 */
	function main_listedit() {
		$this->mo ()->main_listedit ( post_array_param ( 'navid' ), post_array_param ( 'listorder' ), post_array_param ( 'title' ), post_array_param ( 'navurl' ), post_array_param ( 'disabled' ) );
	}
	/* 主导航_删除 */
	function main_del() {
		$this->mo ()->main_del ( post_array_param ( 'navid' ) );
	}
	
	/* 当前处理 */
	function mo() {
		$o = loader ( 'class:class_common_nav_admin', _M (), true, true );
		return $o;
	}
	/* 初始化模块 */
	function model_import() {
		admin_access ( 'index', 'mod,ac,op,ao' );
		$this->load_mod ( 'ao', new self () );
	}
}
?>