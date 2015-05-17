<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}
class model_comment_content_member extends class_common {
	
	/* 析构函数 */
	function __construct() {
		parent::__construct ();
	}
	function model_comment_content_member() {
		$this->__construct ();
	}
	
	/* 添加 */
	function add() {
		$this->mo ()->comment_add ( post_param ( 'smodule' ), post_param ( 'idtype' ), post_param ( 'sid' ), post_param ( 'commentid' ), post_param ( 'content' ), post_param ( 'touid' ) );
	}
	/* 删除 */
	function del() {
		$this->mo ()->comment_del ( post_param ( 'commentid' ) );
	}
	
	/* 当前处理 */
	function mo() {
		$o = loader ( 'class:class_comment_member', _M (), true, true );
		return $o;
	}
	/* 初始化模块 */
	function model_import() {
		$this->load_mod ( 'ao', new self () );
	}
}
?>