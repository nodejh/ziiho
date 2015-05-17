<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}
class model_member_setting extends class_common {
	
	/* 析构函数 */
	function __construct() {
		parent::__construct ();
	}
	function model_member_setting() {
		$this->__construct ();
	}
	
	/* 头像 */
	function avatar() {
		loader ( 'model:model_member_avatar_action', _M (), true, true )->model_import ();
	}
	/* 资料 */
	function profile() {
		loader ( 'model:model_member_profile_action', _M (), true, true )->model_import ();
	}
	/* 标签x */
	function tag() {
		loader ( 'model:model_member_tag_action', _M (), true, true )->model_import ();
	}
	/* 账号管理 */
	function account() {
		loader ( 'model:model_member_account_action', _M (), true, true )->model_import ();
	}
	/* 积分 */
	function credit() {
		loader ( 'model:model_member_credit_action', _M (), true, true )->model_import ();
	}
	
	/* 初始化模块 */
	function model_import() {
		member_access ();
		$this->load_mod ( 'op', new self () );
	}
}
?>