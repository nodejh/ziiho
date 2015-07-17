<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}
class model_common_credit_admin extends class_common {
	
	/* 析构函数 */
	function __construct() {
		parent::__construct ();
	}
	function model_common_credit_admin() {
		$this->__construct ();
	}
	
	/* ------------------积分设置----------------- */
	/*基本设置_模板*/
	function baseset() {
		loader ( 'admin:assign:credit_baseset', _M () );
	}
	/* 基本设置_保存 */
	function baseset_setdo() {
		$this->mo ()->baseset ( post_array_param ( 'credit' ), post_array_param ( 'title' ), post_array_param ( 'unit' ), post_array_param ( 'description' ) );
	}
	/* ------------------积分策略----------------- */
	/*策略设置_模板*/
	function policy() {
		loader ( 'admin:assign:credit_policy', _M () );
	}
	/* 策略_添加模板 */
	function policy_add() {
		loader ( 'admin:assign:credit_policy_add', _M () );
	}
	/* 策略_添加保存 */
	function policy_adddo() {
		$this->mo ()->policy_add ( post_param ( 'title' ), post_param ( 'module' ), post_param ( 'action' ), post_param ( 'cycletype' ), post_val ( 'cycletime' ), post_param ( 'rewardnum' ), post_array_param ( 'credit' ) );
	}
	/* 策略_编辑模板 */
	function policy_edit() {
		loader ( 'admin:assign:credit_policy_edit', _M () );
	}
	/* 策略_编辑保存 */
	function policy_editdo() {
		$this->mo ()->policy_edit ( post_param ( 'ruleid' ), post_param ( 'title' ), post_param ( 'module' ), post_param ( 'action' ), post_param ( 'cycletype' ), post_val ( 'cycletime' ), post_param ( 'rewardnum' ), post_array_param ( 'credit' ) );
	}
	/* 策略_列表编辑保存 */
	function policy_baseedit() {
		$this->mo ()->policy_baseedit ( post_array_param ( 'ruleid' ), post_array_param ( 'credit' ) );
	}
	/* 策略_删除 */
	function policy_del() {
		$this->mo ()->policy_del ( post_array_param ( 'ruleid' ) );
	}
	/* ------------------积分兑换----------------- */
	/*兑换_模板*/
	function change() {
		loader ( 'admin:assign:credit_change', _M () );
	}
	/* 兑换_添加 */
	function change_baseadd() {
		$this->mo ()->change_baseadd ( post_param ( 'outcost' ), post_param ( 'outcredit' ), post_param ( 'incost' ), post_param ( 'incredit' ), post_param ( 'disabled' ) );
	}
	/* 兑换_编辑 */
	function change_baseedit() {
		$this->mo ()->change_baseedit ( post_array_param ( 'changeid' ), post_array_param ( 'disabled' ) );
	}
	/* 兑换_删除 */
	function change_del() {
		$this->mo ()->change_del ( post_array_param ( 'changeid' ) );
	}
	
	/* 当前处理 */
	function mo() {
		$o = loader ( 'class:class_common_credit_admin', _M (), true, true );
		return $o;
	}
	/* 初始化模块 */
	function model_import() {
		admin_access ( 'index', 'mod,ac,op,ao' );
		$this->load_mod ( 'ao', new self () );
	}
}
?>