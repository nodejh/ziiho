<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}
class model_member extends class_common {
	
	/* 析构函数 */
	function __construct() {
		parent::__construct ();
	}
	function model_member() {
		$this->__construct ();
	}
	
	/* 管理模块 */
	function admin() {
		loader ( 'model:model_member_admin', 'member', true, true )->model_import ();
	}
	/* 会员验证模块 */
	function entry() {
		loader ( 'model:model_member_entry', 'member', true, true )->model_import ();
	}
	/* 会员大厅模块 */
	function infocenter() {
		loader ( 'model:model_member_infocenter', 'member', true, true )->model_import ();
	}
	/* 会员设置 */
	function setting() {
		loader ( 'model:model_member_setting', 'member', true, true )->model_import ();
	}
	/* 朋友 */
	function friend() {
		loader ( 'model:model_member_friend', 'member', true, true )->model_import ();
	}
	/* 通知 */
	function notice() {
		loader ( 'model:model_member_notice', 'member', true, true )->model_import ();
	}
	/* 消息 */
	function message() {
		loader ( 'model:model_member_message', 'member', true, true )->model_import ();
	}
	/* 标签 */
	function tag() {
		loader ( 'model:model_member_tag', 'member', true, true )->model_import ();
	}
	
	/* 初始化模块 */
	function membermodel() {
		$this->load_mod ( 'ac', new self () );
	}
}
?>