<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}
class model_member_tag_admin extends class_common {
	
	/* 析构函数 */
	function __construct() {
		parent::__construct ();
	}
	function model_member_tag_admin() {
		$this->__construct ();
	}
	
	/* 列表 */
	function tag() {
		loader ( 'admin:assign:tag', _M () );
	}
	/* 添加 */
	function tag_baseadd() {
		$this->mo ()->baseadd ( post_param ( 'listorder' ), post_param ( 'title' ), post_param ( 'disabled' ) );
	}
	/* 列表编辑 */
	function tag_baseedit() {
		$this->mo ()->baseedit ( post_array_param ( 'tagid' ), post_array_param ( 'listorder' ), post_array_param ( 'title' ), post_array_param ( 'disabled' ) );
	}
	/* 删除 */
	function tag_del() {
		$this->mo ()->del ( post_array_param ( 'tagid' ) );
	}
	
	/* 当前处理 */
	function mo() {
		$o = loader ( 'class:class_member_tag_admin', _M (), true, true );
		return $o;
	}
	/* 初始化模块 */
	function model_import() {
		admin_access ( 'index', 'mod,ac,op,ao' );
		$this->load_mod ( 'ao', new self () );
	}
}
?>