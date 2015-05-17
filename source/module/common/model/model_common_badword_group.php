<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}
class model_common_badword_group extends class_common {
	
	/* 析构函数 */
	function __construct() {
		parent::__construct ();
	}
	function model_common_badword_group() {
		$this->__construct ();
	}
	
	/* 列表 */
	function group() {
		loader ( 'admin:assign:badword_group', _M () );
	}
	/* 添加 */
	function group_baseadd() {
		$this->mo ()->baseadd ( post_param ( 'listorder' ), post_param ( 'title' ) );
	}
	/* 更新 */
	function group_baseedit() {
		$this->mo ()->baseedit ( post_array_param ( 'cgroupid' ), post_array_param ( 'listorder' ), post_array_param ( 'title' ) );
	}
	/* 删除 */
	function group_del() {
		$this->mo ()->del ( post_array_param ( 'cgroupid' ) );
	}
	
	/* 当前处理 */
	function mo() {
		$o = loader ( 'class:class_common_badword_group', _M (), true, true );
		return $o;
	}
	/* 初始化模块 */
	function model_import() {
		admin_access ( 'index', 'mod,ac,op,ao,bo' );
		$this->load_mod ( 'bo', new self () );
	}
}
?>