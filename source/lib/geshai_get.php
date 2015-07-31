<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}
class geshai_get {
	function __construct() {
	}
	function geshai_get() {
		$this->__construct ();
	}
	
	function selectitem($k, $siid = null, $vk = null) {
		$len = func_num_args();
		if ($len == 1) {
			return _g('module')->trigger('@', 'selectitem', null, 'finds', array('status'=>1, 'selectid'=>$k));
		} else {
			$data = _g('module')->trigger('@', 'selectitem', null, 'find', array('siid'=>$id, 'status'=>1, 'selectid'=>$k));
			if (my_is_array($data)) {
				if ($len == 3) {
					return my_array_value($vk, $data);
				} else {
					return $data;
				}
			} else {
				if ($len == 3) {
					return null;
				} else {
					return array ();
				}
			}
		}
	}
}
?>