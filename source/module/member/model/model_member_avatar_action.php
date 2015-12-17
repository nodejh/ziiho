<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}
class model_member_avatar_action extends class_common {
	
	/* 析构函数 */
	function __construct() {
		parent::__construct ();
	}
	function model_member_avatar_action() {
		$this->__construct ();
	}
	
	/* 头像上传模板 */
	function upload() {
		loader ( 'assign:setting_avatar_upload', _M () );
	}
	/* 头像上传保存 */
	function uploaddo() {
		$this->mo ()->avatar_upload ( array_key_val ( 'files', $_FILES ), post_param ( 'ac_uid' ) );
	}
	/* 头像裁剪保存 */
	function cropdo() {
		$this->mo ()->avatar_crop ( post_param ( 'x' ), post_param ( 'y' ), post_param ( 'width' ), post_param ( 'height' ) );
	}
	/* 头像取消 */
	function canceldo() {
		$this->mo ()->avatar_cancel ();
	}
	
	/* 当前处理 */
	function mo() {
		$o = loader ( 'class:class_member_avatar', _M (), true, true );
		return $o;
	}
	/* 初始化模块 */
	function model_import() {
		$this->load_mod ( 'ao', new self () );
	}
}
?>