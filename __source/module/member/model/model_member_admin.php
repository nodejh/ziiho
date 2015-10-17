<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}
class model_member_admin extends class_common {
	
	/* 析构函数 */
	function __construct() {
		parent::__construct ();
	}
	function model_member_admin() {
		$this->__construct ();
	}
	
	/* 设置模块 */
	function set() {
		loader ( 'model:model_member_set_admin', _M (), true, true )->model_import ();
	}
	/* 会员权限组模块 */
	function membergroup() {
		loader ( 'model:model_member_group_admin', _M (), true, true )->model_import ();
	}
	/* 会员操作模块 */
	function operation() {
		$c = loader ( 'model:model_member_operation_admin', _M (), true, true )->model_import ();
	}
	/* 会员任务模块 */
	function mtask() {
		loader ( 'model:model_member_task_admin', _M (), true, true )->model_import ();
	}
	/* 标签模块 */
	function tag() {
		loader ( 'model:model_member_tag_admin', _M (), true, true )->model_import ();
	}
	/* 区域模块 */
	function area() {
		loader ( 'model:model_member_area_admin', _M (), true, true )->model_import ();
	}
	/* 信息模块 */
	function message() {
		loader ( 'model:model_member_message_admin', _M (), true, true )->model_import ();
	}
	/* 提醒模块 */
	function notice() {
		loader ( 'model:model_member_notice_admin', _M (), true, true )->model_import ();
	}
	/* email模块 */
	function email() {
		loader ( 'model:model_member_email_admin', _M (), true, true )->model_import ();
	}
	/* 数据调用 */
	function datacall() {
		loader ( 'model:model_member_datacall_admin', _M (), true, true )->model_import ();
	}
	/* 数据调用 */
	function datastyle() {
		loader ( 'model:model_member_datastyle_admin', _M (), true, true )->model_import ();
	}
	
	/* 初始化模块 */
	function model_import() {
		$this->load_mod ( 'op', new self () );
	}
}
?>