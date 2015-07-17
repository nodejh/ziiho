<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}
class class_common_get extends class_model {
	
	/* 析构函数 */
	function __construct() {
		parent::__construct ();
	}
	function class_common_get() {
		$this->__construct ();
	}
	
	/* 默认 */
	function _default_get() {
	}
	/* 获取属性标签名 */
	function attrrs($data, $param) {
		$attrid = array_key_val ( 'attrid', $data );
		$result = NULL;
		if (check_num ( $attrid ) == 1) {
			$al = loader ( 'class:class_common_attribute', 'common', true, true );
			$result = $al->attr_query ( 'attrid', $attrid );
		}
		return $result;
	}
}
?>