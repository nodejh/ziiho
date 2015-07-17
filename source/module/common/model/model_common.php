<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}
class model_common extends class_common {
	
	/* 析构函数 */
	function __construct() {
		parent::__construct ();
	}
	function model_common() {
		$this->__construct ();
	}
	
	/* 网站首页 */
	function home() {
		http_index ();
	}
	/* 验证码模块 */
	function captcha() {
		loader ( 'model:model_common_captcha', _M (), true, true )->model_import ();
	}
	/* 管理模块 */
	function admin() {
		loader ( 'model:model_common_admin', _M (), true, true )->model_import ();
	}
	/* 表情 */
	function emotional() {
		loader ( 'model:model_common_emotional', _M (), true, true )->model_import ();
	}
	
	/* 初始化模块 */
	function model_import() {
		$this->load_mod ( 'ac', new self () );
	}
}
?>