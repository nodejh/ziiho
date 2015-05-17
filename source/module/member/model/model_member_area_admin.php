<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}
class model_member_area_admin extends class_common {
	
	/* 析构函数 */
	function __construct() {
		parent::__construct ();
	}
	function model_member_area_admin() {
		$this->__construct ();
	}
	
	/* 列表 */
	function area() {
		loader ( 'admin:assign:area', _M () );
	}
	/* 简单添加 */
	function area_baseadd() {
		$this->mo ()->baseadd ( post_param ( 'aid' ), post_param ( 'listorder' ), post_param ( 'title' ) );
	}
	/* 列表编辑 */
	function area_baseedit() {
		$this->mo ()->baseedit ( post_array_param ( 'aid' ), post_array_param ( 'listorder' ), post_array_param ( 'title' ) );
	}
	/* 添加模板 */
	function area_addset() {
		loader ( 'admin:assign:area_addset', _M () );
	}
	/* 添加保存 */
	function area_addsetdo() {
		$this->mo ()->addset ( post_param ( 'listorder' ), post_param ( 'title' ), post_param ( 'aids' ) );
	}
	/* 编辑模板 */
	function area_editset() {
		loader ( 'admin:assign:area_editset', _M () );
	}
	/* 编辑保存 */
	function area_editsetdo() {
		$this->mo ()->editset ( post_param ( 'aid' ), post_param ( 'listorder' ), post_param ( 'title' ), post_param ( 'aids' ) );
	}
	/* 删除 */
	function area_del() {
		$this->mo ()->del ( post_array_param ( 'aid' ) );
	}
	
	/* 当前处理 */
	function mo() {
		$o = loader ( 'class:class_member_area_admin', _M (), true, true );
		return $o;
	}
	/* 初始化模块 */
	function model_import() {
		admin_access ( 'index', 'mod,ac,op,ao' );
		$this->load_mod ( 'ao', new self () );
	}
}
?>