<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}
class model_common_showdata extends class_common {
	
	/* 析构函数 */
	function __construct() {
		parent::__construct ();
	}
	function model_common_showdata() {
		$this->__construct ();
	}
	
	/* 列表 */
	function data() {
		loader ( 'admin:assign:showdata', _M () );
	}
	/* 添加 */
	function data_add() {
		loader ( 'admin:assign:showdata_add', _M () );
	}
	/* 添加保存 */
	function data_adds() {
		$this->mo ()->add ( post_param ( 'listorder' ), post_param ( 'title' ), post_param ( 'url' ), post_param ( 'cgroupid' ), post_param ( 'covertype' ), post_param ( 'coverimage' ), post_param ( 'status' ), post_param ( 'description' ) );
	}
	/* 编辑 */
	function data_edit() {
		loader ( 'admin:assign:showdata_edit', _M () );
	}
	/* 编辑保存 */
	function data_edits() {
		$this->mo ()->edit ( post_param ( 'cdataid' ), post_param ( 'listorder' ), post_param ( 'title' ), post_param ( 'url' ), post_param ( 'cgroupid' ), post_param ( 'covertype' ), post_param ( 'coverimage' ), post_param ( 'status' ), post_param ( 'description' ) );
	}
	/* 列表编辑 */
	function data_baseedit() {
		$this->mo ()->baseedit ( post_array_param ( 'cdataid' ), post_array_param ( 'listorder' ), post_array_param ( 'status' ) );
	}
	/* 删除 */
	function data_del() {
		$this->mo ()->del ( post_array_param ( 'cdataid' ) );
	}
	/* 封面图片上传 */
	function data_coverupload() {
		$this->mo ()->coverupload ( $_FILES ['filearr'], post_param ( 'ac_uid' ), post_param ( 'cdataid' ) );
	}
	
	/* 当前处理 */
	function mo() {
		$o = loader ( 'class:class_common_showdata', _M (), true, true );
		return $o;
	}
	/* 初始化模块 */
	function model_import() {
		admin_access ( 'index', 'mod,ac,op,ao,bo' );
		$this->load_mod ( 'bo', new self () );
	}
}
?>