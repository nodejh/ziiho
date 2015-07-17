<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}
class model_common_category_admin extends class_common {
	
	/* 析构函数 */
	function __construct() {
		parent::__construct ();
	}
	function model_common_category_admin() {
		$this->__construct ();
	}
	
	/* 列表 */
	function category() {
		loader ( 'admin:assign:category', _M () );
	}
	/* 基本添加 */
	function category_baseadd() {
		$this->mo ()->baseadd ( post_param ( 'cm' ), post_param ( 'listorder' ), post_param ( 'title' ), post_param ( 'description' ), post_param ( 'disabled' ) );
	}
	/* 基本编辑 */
	function category_baseedit() {
		$this->mo ()->baseedit ( post_array_param ( 'catid' ), post_array_param ( 'listorder' ), post_array_param ( 'title' ), post_array_param ( 'description' ), post_array_param ( 'disabled' ) );
	}
	/* 删除 */
	function category_del() {
		$this->mo ()->del ( post_array_param ( 'catid' ) );
	}
	/* 添加设置模板 */
	function category_addset() {
		loader ( 'admin:assign:category_addset', _M () );
	}
	/* 添加设置保存 */
	function category_addsetdo() {
		$this->mo ()->addset ( post_param ( 'catids' ), post_param ( 'cm' ), post_param ( 'listorder' ), post_param ( 'title' ), post_param ( 'description' ), post_param ( 'disabled' ), post_param ( 'innav' ), post_param ( 'seo_title' ), post_param ( 'seo_keywords' ), post_param ( 'seo_description' ), post_param ( 'template' ) );
	}
	/* 编辑设置模板 */
	function category_editset() {
		loader ( 'admin:assign:category_editset', _M () );
	}
	/* 编辑设置保存 */
	function category_editsetdo() {
		$this->mo ()->editset ( post_param ( 'catid' ), post_param ( 'catids' ), post_param ( 'listorder' ), post_param ( 'title' ), post_param ( 'description' ), post_param ( 'disabled' ), post_param ( 'innav' ), post_param ( 'seo_title' ), post_param ( 'seo_keywords' ), post_param ( 'seo_description' ), post_param ( 'template' ) );
	}
	
	/* 当前处理 */
	function mo() {
		$o = loader ( 'class:class_common_category_admin', _M (), true, true );
		return $o;
	}
	/* 初始化模块 */
	function model_import() {
		admin_access ( 'index', 'mod,ac,op,ao' );
		$this->load_mod ( 'ao', new self () );
	}
}
?>