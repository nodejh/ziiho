<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}
class model_member_action extends class_common {
	
	/* 析构函数 */
	function __construct() {
		parent::__construct ();
	}
	function model_member_action() {
		$this->__construct ();
	}
	
	/* 朋友 */
	function friend() {
		loader ( 'model:model_member_friend_action', _M (), true, true )->model_import ();
	}
	/* 提醒 */
	function notice() {
		loader ( 'model:model_member_notice_action', _M (), true, true )->model_import ();
	}
	/* 消息 */
	function msg() {
		loader ( 'model:model_member_message_action', _M (), true, true )->model_import ();
	}
	
	/* 初始化模块 */
	function model_import() {
		member_access ();
		$this->load_mod ( 'op', new self () );
	}
}
?>