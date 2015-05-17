<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}
class model_common_datastyle extends class_common {
	
	/* 析构函数 */
	function __construct() {
		parent::__construct ();
	}
	function model_common_datastyle() {
		$this->__construct ();
	}
	
	/* 列表 */
	function lists() {
		loader ( 'admin:assign:datastyle', _M () );
	}
	/* 添加选择 */
	function add() {
		loader ( 'admin:assign:datastyle_add', _M () );
	}
	/* 模块检查 */
	function addcheck() {
		$this->mo ()->datastyle_add_check ( post_param ( 'module' ) );
	}
	/* 更新排序 */
	function updateorder() {
		$this->mo ()->datastyle_updateorder ( post_array_param ( 'dsid' ), post_array_param ( 'listorder' ) );
	}
	/* 删除 */
	function del() {
		$this->mo ()->datastyle_del ( post_array_param ( 'dsid' ) );
	}
	
	/* 当前处理 */
	function mo() {
		$o = loader ( 'class:class_common_datastyle', _M (), true, true );
		return $o;
	}
	/* 初始化模块 */
	function model_import() {
		admin_access ( 'index', 'mod,ac,op,ao' );
		$this->load_mod ( 'ao', new self () );
	}
}
?>