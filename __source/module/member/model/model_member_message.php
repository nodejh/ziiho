<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}
class model_member_message extends class_common {
	
	/* 析构函数 */
	function __construct() {
		parent::__construct ();
	}
	function model_member_message() {
		$this->__construct ();
	}
	
	/* 收件箱 */
	function inbox() {
		loader ( 'assign:message_inbox', _M () );
	}
	/* 收件箱_删除 */
	function inboxdel() {
		$this->mo ()->inbox_del ( post_param ( 'messageid' ) );
	}
	/* 发件箱 */
	function outbox() {
		loader ( 'assign:message_outbox', _M () );
	}
	/* 发件箱_删除 */
	function outboxdel() {
		$this->mo ()->outbox_del ( post_param ( 'messageid' ) );
	}
	/* 发送消息 */
	function write() {
		loader ( 'assign:message_write', _M () );
	}
	/* 发送消息_保存 */
	function writedo() {
		$this->mo ()->message_write ( post_param ( 'username' ), post_param ( 'title' ), post_param ( 'content' ) );
	}
	
	/* 当前处理 */
	function mo() {
		$o = loader ( 'class:class_member_message', _M (), true, true );
		return $o;
	}
	/* 初始化模块 */
	function model_import() {
		member_access ();
		$this->load_mod ( 'op', new self () );
	}
}
?>