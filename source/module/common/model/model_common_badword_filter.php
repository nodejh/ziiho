<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}
class model_common_badword_filter extends class_common {
	
	/* 析构函数 */
	function __construct() {
		parent::__construct ();
	}
	function model_common_badword_filter() {
		$this->__construct ();
	}
	
	/* 列表 */
	function filter() {
		loader ( 'admin:assign:badword_filter', _M () );
	}
	/* 添加 */
	function filter_baseadd() {
		$this->mo ()->baseadd ( post_param ( 'listorder' ), post_param ( 'badword' ), post_param ( 'filterword' ) );
	}
	/* 更新 */
	function filter_baseedit() {
		$this->mo ()->baseedit ( post_array_param ( 'cwordid' ), post_array_param ( 'listorder' ), post_array_param ( 'badword' ), post_array_param ( 'filterword' ) );
	}
	/* 删除 */
	function filter_del() {
		$this->mo ()->del ( post_array_param ( 'cwordid' ) );
	}
	
	/* 当前处理 */
	function mo() {
		$o = loader ( 'class:class_common_badword_filter', _M (), true, true );
		return $o;
	}
	/* 初始化模块 */
	function model_import() {
		admin_access ( 'index', 'mod,ac,op,ao,bo' );
		$this->load_mod ( 'bo', new self () );
	}
}
?>