<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}
class model_comment_content_admin extends class_common {
	
	/* 析构函数 */
	function __construct() {
		parent::__construct ();
	}
	function model_comment_content_admin() {
		$this->__construct ();
	}
	
	/* 内容管理 */
	function content() {
		loader ( 'admin:assign:content', _M () );
	}
	function content_qrs() {
		loader ( 'admin:assign:content_query', _M () );
	}
	/* status */
	function content_status() {
		$this->mo ()->comment_status ( post_array_param ( 'commentid' ), post_param ( 'status' ) );
	}
	/* edit */
	function content_edit() {
		loader ( 'admin:assign:content_edit', _M () );
	}
	/* edit_do */
	function content_editdo() {
		$this->mo ()->comment_edit ( post_param ( 'commentid' ), post_param ( 'content' ) );
	}
	/* del */
	function content_del() {
		$this->mo ()->comment_del ( post_array_param ( 'commentid' ) );
	}
	
	/* 当前处理 */
	function mo() {
		$o = loader ( 'class:class_comment_admin', _M (), true, true );
		return $o;
	}
	/* 初始化模块 */
	function model_import() {
		admin_access ( 'index', 'mod,ac,op,ao' );
		$this->load_mod ( 'ao', new self () );
	}
}
?>