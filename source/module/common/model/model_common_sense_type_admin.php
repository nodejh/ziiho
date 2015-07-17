<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}
class model_common_sense_type_admin extends class_common {
	
	/* 析构函数 */
	function __construct() {
		parent::__construct ();
	}
	function model_common_sense_type_admin() {
		$this->__construct ();
	}
	
	/* 列表 */
	function type() {
		loader ( 'admin:assign:sense_type', _M () );
	}
	/* 添加 */
	function type_baseadd() {
		$this->mo ()->baseadd ( post_param ( 'listorder' ), post_param ( 'module' ), post_param ( 'title' ) );
	}
	/* 编辑 */
	function type_baseedit() {
		$this->mo ()->baseedit ( post_array_param ( 'sensetypeid' ), post_array_param ( 'listorder' ), post_array_param ( 'module' ), post_array_param ( 'title' ) );
	}
	/* 删除 */
	function type_del() {
		$this->mo ()->del ( post_array_param ( 'sensetypeid' ) );
	}
	
	/* 当前处理 */
	function mo() {
		$o = loader ( 'class:class_common_sense_type', _M (), true, true );
		return $o;
	}
	/* 初始化模块 */
	function model_import() {
		admin_access ( 'index', 'mod,ac,op,ao,bo' );
		$this->load_mod ( 'bo', new self () );
	}
}
?>