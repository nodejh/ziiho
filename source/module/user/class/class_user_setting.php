<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}
class class_user_setting extends geshai_model {
	
	function __construct() {
		parent::__construct ();
	}
	function class_user_setting() {
		$this->__construct ();
	}
	
	function email($data){
		$settings = array();
		foreach ( $data as $k => $v ){
			my_array_push($settings, array('user', 'emailSetting', $k, $v));
		}
		
		return _g ( 'module' )->trigger ( '@', 'setting', null, 'save', $settings );
	}
}
?>