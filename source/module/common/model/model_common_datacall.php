<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}
class model_common_datacall extends class_common {
	
	/* 析构函数 */
	function __construct() {
		parent::__construct ();
	}
	function model_common_datacall() {
		$this->__construct ();
	}
	
	/* 列表 */
	function lists() {
		loader ( 'admin:assign:datacall', _M () );
	}
	/* 添加选择 */
	function add() {
		loader ( 'admin:assign:datacall_add', _M () );
	}
	/* 模块检查 */
	function addcheck() {
		$this->mo ()->datacall_add_check ( post_param ( 'module' ) );
	}
	/* 更新排序 */
	function updateorder() {
		$this->mo ()->datacall_updateorder ( post_array_param ( 'dcid' ), post_array_param ( 'listorder' ) );
	}
	/* 删除 */
	function del() {
		$this->mo ()->datacall_del ( post_array_param ( 'dcid' ) );
	}
	
	/* 当前处理 */
	function mo() {
		$o = loader ( 'class:class_common_datacall', _M (), true, true );
		return $o;
	}
	/* 初始化模块 */
	function model_import() {
		admin_access ( 'index', 'mod,ac,op,ao' );
		$this->load_mod ( 'ao', new self () );
	}
}
?>