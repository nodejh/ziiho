<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}
class class_job_model extends geshai_model {
	
	function __construct() {
		parent::__construct ();
	}
	function class_job_model() {
		$this->__construct ();
	}
	/* page */
	function page(&$data = null, $t = 'page'){
		$filename = _g ( 'template' )->name ( '@', $t, true );
		if(is_file($filename)){
			$data = _g('value')->ra($data);
			include ($filename);
		}
	}
	
	function nav($t = null){
		$__isFlag = false;
		$data = include _g('module')->helper('job', $t);
		
		include _g ( 'template' )->name ( 'job', 'job-nav', true );
	}
	
	function readSort($parentid = 0){
		$data = array();
		$cacheFile = sdir(':data') . '/cache/job/sort.php';
		if(is_file($cacheFile)){
			$arr = include $cacheFile;
			if(my_is_array($arr)){
				foreach ($arr as $v){
					if($parentid != $v['parentid']){
						continue;
					}
					$data[] = $v;
				}
			}
		}
		return $data;
	}
	function sortValue($sortid, $k = null){
		$data = array();
		$arr = null;
		$cacheFile = sdir(':data') . '/cache/job/sort.php';
		if(is_file($cacheFile)){
			$arr = include $cacheFile;
			$arr = my_array_value($sortid, $arr);
			
			if(func_num_args() > 1){
				$data = my_array_value($k, $arr);
			}else{
				$data = (is_array($arr) ? $arr : array());
			}
		}
		return $data;
	}
	function sortShow($sortid, $k = null){
		$__sortid = null;
		$__value = null;
		$__data = array();
		if(preg_match_all("/(\d+)/", $sortid, $__sortid)){
			$cacheFile = sdir(':data') . '/cache/job/sort.php';
			if(is_file($cacheFile)){
				$arr = include $cacheFile;
			}
			foreach ((is_array($__sortid[0]) ? $__sortid[0] : array()) as $id){
				$__value = my_array_value($id, $arr);
				if(func_num_args() > 1){
					$__data[] = my_array_value($k, $__value);
				}else{
					$__data[] = $__value;
				}
			}
		}
		if(func_num_args() > 1){
			$__data = my_join('<br/>', $__data);
		}
		return $__data;
	}
	
	function sortSrc($value = null){
		if(strlen($value) < 1){
			return null;
		}
		return (sdir('uploadfile') . '/' . $value);
	}
	
	function src($value = null){
		if(strlen($value) < 1){
			return (_g('template')->dir('job') . '/image/def/nopicture.jpg');
		}
		return (sdir('uploadfile') . '/' . $value);
	}
	
	function areaPos($areaid, $detail = null){
		$data = null;
		$areaid = my_end(my_explode(',', $areaid));
		if(!_g('validate')->pnum($areaid)){
			return '&nbsp;' . $detail;
		}
		$area = _g('module')->trigger('job', 'area');
		$pos = $area->cpos($areaid);
		
		foreach ($pos as $v){
			$data .= $v['aname'] . '&nbsp;';
		}
		return ($data . $detail);
	}
	
	function qsType($key = null, $key2 = null){
		$arr = _g ( 'value' )->ra ( _g ( 'module' )->dv ( 'job', 100000 ) );
		switch (func_num_args()){
			case 1:
				return my_array_value($key, $arr);
				break;
			case 2:
				return my_array_value($key . '>' . $key2, $arr);
				break;
			default:
				return $arr;
				break;
		}
	}
	
	function qsHasType($k){
		return my_array_key_exist($k, $this->qsType());
	}
	
	function qsTypeGroup($value = null){
		if(in_array($value, array('radio', 'checkbox'))){
			return 100;
		}else if(in_array($value, array('input', 'textarea'))){
			return 200;
		}
	}
	
	function qsOptionId($value = null){
		if(strlen($value) < 19){
			return (_g('cfg>time') . _g('value')->randchar(9));
		}else{
			return $value;
		}
	}
	
	function qsOptionDe($option){
		return _g('value')->ra(str2array($option));
	}
	function qsOptionOrder($num){
		$arr = array( A, B, C, D, E, F, G, H, I, J, K, L, M, N, O, P, Q, R, S, T, U, V, W, X, Y, Z );
		return my_array_value($num, $arr, $num);
	}
	function qsSAnswer($answer, $option, $isStr = false){
		$answer = $this->qsOptionDe($answer);
		$option = $this->qsOptionDe($option);
		
		$value = array();
		$i = 0;
		foreach($option as $k=>$v){
			if(my_in_array($k, $answer)){
				$value[] = $this->qsOptionOrder($i);
			}
			$i++;
		}
		return ($isStr != true ? $value : my_join(',', $value));
	}
}
?>