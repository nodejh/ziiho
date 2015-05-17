<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}
class model_common_attribute extends class_common {
	
	/* 析构函数 */
	function __construct() {
		parent::__construct ();
	}
	function model_common_attribute() {
		$this->__construct ();
	}
	
	/* 列表 */
	function attr() {
		loader ( 'admin:assign:attr', _M () );
	}
	/* 添加 */
	function attr_baseadd() {
		$this->mo ()->baseadd ( post_param ( 'title' ) );
	}
	/* 编辑 */
	function attr_baseedit() {
		$this->mo ()->baseedit ( post_array_param ( 'attrid' ), post_array_param ( 'title' ) );
	}
	/* 删除 */
	function attr_del() {
		$this->mo ()->del ( post_array_param ( 'attrid' ) );
	}
	
	/* 当前处理 */
	function mo() {
		$o = loader ( 'class:class_common_attribute', _M (), true, true );
		return $o;
	}
	/* 初始化模块 */
	function model_import() {
		admin_access ( 'index', 'mod,ac,op,ao' );
		$this->load_mod ( 'ao', new self () );
	}
}
?>