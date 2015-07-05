<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}
class class_user_model extends geshai_model {
	
	function __construct() {
		parent::__construct ();
	}
	function class_user_model() {
		$this->__construct ();
	}
	
	function suser($k = null){
		$suser = my_serialize(my_session('suser'), true);
		$suser = _g('value')->ra($suser);
		if(my_array_value('login_type', $suser) == 1){
			if(strlen(my_array_value('nickname', $suser)) < 1){
				my_array_push($suser, my_array_value('username', $suser), 'nickname');
			}
		}else if (my_array_value('login_type', $suser) == 2){
			if(strlen(my_array_value('cname', $suser)) < 1){
				my_array_push($suser, my_array_value('username', $suser), 'cname');
			}
		}
		if(func_num_args() < 1){
			return _g('value')->ra($suser);
		}
		return my_array_value($k, $suser);
	}
	
	function is_suser(){
		return my_is_array($this->suser());
	}
	
	function forgetUser($k = null){
		$user = my_serialize(my_session('forget_user'), true);
		if(func_num_args() < 1){
			return _g('value')->ra($user);
		}
		return my_array_value($k, $user);
	}
	
	function result($r){
		return $this->db->fetch_array($r);
	}
}
?>