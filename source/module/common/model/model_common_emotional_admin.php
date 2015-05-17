<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}
class model_common_emotional_admin extends class_common {
	
	/* 析构函数 */
	function __construct() {
		parent::__construct ();
	}
	function model_common_emotional_admin() {
		$this->__construct ();
	}
	
	/* 列表 */
	function emot() {
		loader ( 'admin:assign:emotional', _M () );
	}
	/* 查询 */
	function emot_qrs() {
		loader ( 'admin:assign:emotional_query', _M () );
	}
	/* 上传模板 */
	function emot_upload() {
		loader ( 'admin:assign:emotional_upload', _M () );
	}
	/* 上传保存 */
	function emot_uploaddo() {
		$this->mo ()->upload ( $_FILES ['filearr'], post_param ( 'ac_uid' ), post_param ( 'emotgroupid' ) );
	}
	/* 基本编辑 */
	function emot_baseedit() {
		$this->mo ()->baseedit ( post_array_param ( 'emotid' ), post_array_param ( 'listorder' ), post_array_param ( 'title' ), post_array_param ( 'description' ) );
	}
	/* 移动 */
	function emot_move() {
		$this->mo ()->move ( post_array_param ( 'emotid' ), post_param ( 'emotgroupid' ) );
	}
	/* 删除 */
	function emot_del() {
		$this->mo ()->del ( post_array_param ( 'emotid' ) );
	}
	
	/* 当前处理 */
	function mo() {
		$o = loader ( 'class:class_common_emotional', _M (), true, true );
		return $o;
	}
	/* 初始化模块 */
	function model_import() {
		admin_access ( 'index', 'mod,ac,op,ao,bo' );
		$this->load_mod ( 'bo', new self () );
	}
}
?>