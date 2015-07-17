<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}
class model_common_template_admin extends class_common {
	
	/* 析构函数 */
	function __construct() {
		parent::__construct ();
	}
	function model_common_template_admin() {
		$this->__construct ();
	}
	
	/* 列表 */
	function template() {
		loader ( 'admin:assign:template', _M () );
	}
	/* 添加 */
	function template_baseadd() {
		$this->mo ()->baseadd ( post_param ( 'listorder' ), post_param ( 'title' ), post_param ( 'path' ), post_param ( 'description' ), post_param ( 'disabled' ) );
	}
	/* 列表编辑 */
	function template_baseedit() {
		$this->mo ()->baseedit ( post_array_param ( 'templateid' ), post_array_param ( 'listorder' ), post_array_param ( 'title' ), post_array_param ( 'path' ), post_array_param ( 'description' ), post_array_param ( 'disabled' ) );
	}
	/* 删除 */
	function template_del() {
		$this->mo ()->del ( post_array_param ( 'templateid' ) );
	}
	
	/* 当前处理 */
	function mo() {
		$o = loader ( 'class:class_common_template_admin', _M (), true, true );
		return $o;
	}
	/* 初始化模块 */
	function model_import() {
		admin_access ( 'index', 'mod,ac,op,ao' );
		$this->load_mod ( 'ao', new self () );
	}
}
?>