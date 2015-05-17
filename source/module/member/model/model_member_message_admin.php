<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}
class model_member_message_admin extends class_common {
	
	/* 析构函数 */
	function __construct() {
		parent::__construct ();
	}
	function model_member_message_admin() {
		$this->__construct ();
	}
	
	/* 发送信息查找会员_模板 */
	function send() {
		loader ( 'admin:assign:message_send_findmember', _M () );
	}
	/* 发送信息查找会员_提交 */
	function send_findmember() {
		loader ( 'admin:assign:message_send_findmemberdo', _M () );
	}
	/* 写信息 */
	function send_write() {
		loader ( 'admin:assign:message_write', _M () );
	}
	/* 写信息提交 */
	function send_writedo() {
		$this->mo ()->write ( post_param ( 'msg_to_uid' ), post_param ( 'msg_title' ), post_param ( 'msg_content' ), post_param ( 'msg_send_status' ) );
	}
	
	/* 当前处理 */
	function mo() {
		$o = loader ( 'class:class_member_message_admin', _M (), true, true );
		return $o;
	}
	/* 初始化模块 */
	function model_import() {
		admin_access ( 'index', 'mod,ac,op,ao' );
		$this->load_mod ( 'ao', new self () );
	}
}
?>