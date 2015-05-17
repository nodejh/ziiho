<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}
class model_common_sense_action_admin extends class_common {
	
	/* 析构函数 */
	function __construct() {
		parent::__construct ();
	}
	function model_common_sense_action_admin() {
		$this->__construct ();
	}
	
	/* 表态类型 */
	function type() {
		loader ( 'model:model_common_sense_type_admin', _M (), true, true )->model_import ();
	}
	/* 表态动作 */
	function sense() {
		loader ( 'model:model_common_sense_admin', _M (), true, true )->model_import ();
	}
	
	/* 初始化模块 */
	function model_import() {
		$this->load_mod ( 'ao', new self () );
	}
}
?>