<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}
class model_common_admin extends class_common {
	
	/* 析构函数 */
	function __construct() {
		parent::__construct ();
	}
	function model_common_admin() {
		$this->__construct ();
	}
	
	/* 数据调用 */
	function datacall() {
		loader ( 'model:model_common_datacall', _M (), true, true )->model_import ();
	}
	/* 数据模板 */
	function datastyle() {
		loader ( 'model:model_common_datastyle', _M (), true, true )->model_import ();
	}
	/* 展示内容 */
	function show() {
		loader ( 'model:model_common_show', _M (), true, true )->model_import ();
	}
	/* 敏感词 */
	function badword() {
		loader ( 'model:model_common_badword', _M (), true, true )->model_import ();
	}
	/* 主题属性标签 */
	function attr() {
		loader ( 'model:model_common_attribute', _M (), true, true )->model_import ();
	}
	/* 表情管理 */
	function emotional() {
		loader ( 'model:model_common_emotional_action_admin', _M (), true, true )->model_import ();
	}
	/* 表态动作 */
	function sense() {
		loader ( 'model:model_common_sense_action_admin', _M (), true, true )->model_import ();
	}
	/* 设置 */
	function set() {
		loader ( 'model:model_common_set_admin', _M (), true, true )->model_import ();
	}
	/* 模板管理 */
	function template() {
		loader ( 'model:model_common_template_admin', _M (), true, true )->model_import ();
	}
	/* 导航 */
	function nav() {
		loader ( 'model:model_common_nav_admin', _M (), true, true )->model_import ();
	}
	/* 邀请码 */
	function invitecode() {
		loader ( 'model:model_common_invitecode_admin', _M (), true, true )->model_import ();
	}
	/* 积分设置 */
	function credit() {
		loader ( 'model:model_common_credit_admin', _M (), true, true )->model_import ();
	}
	/* 分类 */
	function category() {
		loader ( 'model:model_common_category_admin', _M (), true, true )->model_import ();
	}
	
	/* 初始化模块 */
	function model_import() {
		$this->load_mod ( 'op', new self () );
	}
}
?>