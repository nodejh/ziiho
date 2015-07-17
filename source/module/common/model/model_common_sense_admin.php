<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}
class model_common_sense_admin extends class_common {
	
	/* 析构函数 */
	function __construct() {
		parent::__construct ();
	}
	function model_common_sense_admin() {
		$this->__construct ();
	}
	
	/* 列表 */
	function sense() {
		loader ( 'admin:assign:sense', _M () );
	}
	/* 查询 */
	function sense_qrs() {
		loader ( 'admin:assign:sense_query', _M () );
	}
	/* 添加 */
	function sense_baseadd() {
		$this->mo ()->baseadd ( post_param ( 'sensetypeid' ), post_param ( 'listorder' ), post_param ( 'title' ), post_param ( 'filename' ), post_param ( 'disabled' ) );
	}
	/* 编辑 */
	function sense_baseedit() {
		$this->mo ()->baseedit ( post_array_param ( 'senseid' ), post_array_param ( 'listorder' ), post_array_param ( 'title' ), post_array_param ( 'filename' ), post_array_param ( 'disabled' ) );
	}
	/* 删除 */
	function sense_del() {
		$this->mo ()->del ( post_array_param ( 'senseid' ) );
	}
	
	/* 当前处理 */
	function mo() {
		$o = loader ( 'class:class_common_sense', _M (), true, true );
		return $o;
	}
	/* 初始化模块 */
	function model_import() {
		admin_access ( 'index', 'mod,ac,op,ao,bo' );
		$this->load_mod ( 'bo', new self () );
	}
}
?>