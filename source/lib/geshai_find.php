<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}
class geshai_find {
	function __construct() {
	}
	function geshai_find() {
		$this->__construct ();
	}
	
	function profession($k = null, $k2 = null, $def = 'undefined'){
		$data = array();
		$cacheFile = sdir(':data') . '/cache/cuser/profession.php';
		if(is_file($cacheFile)){
			$data = include $cacheFile;
		}
		$len = func_num_args();
		if ($len < 1) {
			return $data;
		} else if ($len == 1){
			return my_array_value($k, $data, array());
		} else {
			return my_array_value($k . '>' . $k2, $data, $def);
		}
	}
}
?>