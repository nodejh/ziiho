<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}
class model_member_task_admin extends class_common {
	
	/* 析构函数 */
	function __construct() {
		parent::__construct ();
	}
	function model_member_task_admin() {
		$this->__construct ();
	}
	
	/* 基本任务列表 */
	function tbl() {
		loader ( 'admin:assign:m_task_base', _M () );
	}
	/* 基本任务列表编辑 */
	function tbledit() {
		$this->mo ()->task_base_list_edit ( post_array_param ( 'tb_id' ), post_array_param ( 'tb_disabled' ) );
	}
	/* 基本任务_添加模板 */
	function tbadd() {
		loader ( 'admin:assign:m_task_base_add', _M () );
	}
	/* 基本任务_添加保存 */
	function tbadds() {
		$this->mo ()->task_base_add ( post_param ( 'tb_listorder' ), post_param ( 'tb_name' ), post_param ( 'tb_content' ), post_param ( 'tb_disabled' ), post_param ( 'tb_type' ) );
	}
	/* 基本任务_编辑设置模板 */
	function tbedit() {
		loader ( 'admin:assign:m_task_base_edit', _M () );
	}
	/* 基本任务_编辑设置保存 */
	function tbedits() {
		$this->mo ()->task_base_edit ( post_param ( 'tb_id' ), post_param ( 'tb_listorder' ), post_param ( 'tb_name' ), post_param ( 'tb_content' ), post_param ( 'tb_disabled' ), post_param ( 'tb_type' ) );
	}
	
	/* 当前处理 */
	function mo() {
		$o = loader ( 'class:class_member_task_admin', _M (), true, true );
		return $o;
	}
	/* 初始化模块 */
	function model_import() {
		$this->load_mod ( 'ao', new self () );
	}
}
?>