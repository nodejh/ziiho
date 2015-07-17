<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}
class model_member_credit_action extends class_common {
	
	/* 析构函数 */
	function __construct() {
		parent::__construct ();
	}
	function model_member_credit_action() {
		$this->__construct ();
	}
	
	/* 我的账户 */
	function my() {
		loader ( 'assign:setting_credit_my', _M () );
	}
	/* 充值 */
	function charge() {
		loader ( 'assign:setting_credit_charge', _M () );
	}
	/* 转账 */
	function transfer() {
		loader ( 'assign:setting_credit_transfer', _M () );
	}
	/* 兑换 */
	function change() {
		loader ( 'assign:setting_credit_change', _M () );
	}
	/* 订单记录 */
	function orders() {
		loader ( 'assign:setting_credit_orders', _M () );
	}
	/* 积分日志 */
	function logs() {
		loader ( 'assign:setting_credit_logs', _M () );
	}
	
	/* 当前处理 */
	function mo() {
		$o = loader ( 'class:class_member_credit', _M (), true, true );
		return $o;
	}
	/* 初始化模块 */
	function model_import() {
		$this->load_mod ( 'ao', new self () );
	}
}
?>