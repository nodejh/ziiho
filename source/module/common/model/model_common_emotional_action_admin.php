<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}
class model_common_emotional_action_admin extends class_common {
	
	/* 析构函数 */
	function __construct() {
		parent::__construct ();
	}
	function model_common_emotional_action_admin() {
		$this->__construct ();
	}
	
	/* 表情管理 */
	function emot() {
		loader ( 'model:model_common_emotional_admin', _M (), true, true )->model_import ();
	}
	/* 组管理 */
	function group() {
		loader ( 'model:model_common_emotional_group_admin', _M (), true, true )->model_import ();
	}
	
	/* 初始化模块 */
	function model_import() {
		$this->load_mod ( 'ao', new self () );
	}
}
?>