<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}
class model_member_notice_admin extends class_common {
	
	/* 析构函数 */
	function __construct() {
		parent::__construct ();
	}
	function model_member_notice_admin() {
		$this->__construct ();
	}
	
	/* 提交发送 */
	function sends() {
		$this->mo ()->send ( post_param ( 'msg_to_uid' ), post_param ( 'msg_title' ), post_param ( 'msg_content' ), post_param ( 'msg_content_type' ) );
	}
	
	/* 当前处理 */
	function mo() {
		$o = loader ( 'class:class_member_notice_admin', _M (), true, true );
		return $o;
	}
	/* 初始化模块 */
	function model_import() {
		$this->load_mod ( 'ao', new self () );
	}
}
?>