<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}
class model_member_friend extends class_common {
	
	/* 析构函数 */
	function __construct() {
		parent::__construct ();
	}
	function model_member_friend() {
		$this->__construct ();
	}
	
	/* ---------------------关注的人---------------------- */
	/*关注的人*/
	function follow() {
		loader ( 'assign:follow', _M () );
	}
	/* 关注的人_显示 */
	function followshow() {
		loader ( 'assign:follow_show', _M () );
	}
	/* ---------------------粉丝---------------------- */
	/*粉丝*/
	function fans() {
		loader ( 'assign:fans', _M () );
	}
	/* 粉丝_显示 */
	function fansshow() {
		loader ( 'assign:fans_show', _M () );
	}
	/* ---------------------朋友---------------------- */
	/*朋友*/
	function friend() {
		loader ( 'assign:friend', _M () );
	}
	/* 粉丝_显示 */
	function friendshow() {
		loader ( 'assign:friend_show', _M () );
	}
	/* 操作 */
	function action() {
		loader ( 'model:model_member_friend_action', _M (), true, true )->model_import ();
	}
	
	/* 初始化模块 */
	function model_import() {
		$this->load_mod ( 'op', new self () );
	}
}
?>