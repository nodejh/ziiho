<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}
class model_comment_set_admin extends class_common {
	
	/* 析构函数 */
	function __construct() {
		parent::__construct ();
	}
	function model_comment_set_admin() {
		$this->__construct ();
	}
	
	/* 模块配置_模板 */
	function baseset() {
		loader ( 'admin:assign:baseset', _M () );
	}
	/* 模块配置_保存 */
	function baseset_do() {
		$this->mo ()->baseset ( post_param ( 'fn_allow' ), post_param ( 'status' ), post_param ( 'content_minlen' ), post_param ( 'content_maxlen' ) );
	}
	
	/* 当前处理 */
	function mo() {
		$o = loader ( 'class:class_comment_set_admin', _M (), true, true );
		return $o;
	}
	/* 初始化模块 */
	function model_import() {
		admin_access ( 'index', 'mod,ac,op,ao' );
		$this->load_mod ( 'ao', new self () );
	}
}
?>