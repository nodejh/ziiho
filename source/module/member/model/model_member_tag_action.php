<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}
class model_member_tag_action extends class_common {
	
	/* 析构函数 */
	function __construct() {
		parent::__construct ();
	}
	function model_member_tag_action() {
		$this->__construct ();
	}
	
	/* 标签设置模板 */
	function my() {
		loader ( 'assign:setting_tag_my', _M () );
	}
	/* 标签设置保存 */
	function mydo() {
		$this->mo ()->tagof_set ( post_array_param ( 'tagid' ) );
	}
	
	/* 当前处理 */
	function mo() {
		$o = loader ( 'class:class_member_tag', _M (), true, true );
		return $o;
	}
	/* 初始化模块 */
	function model_import() {
		$this->load_mod ( 'ao', new self () );
	}
}
?>