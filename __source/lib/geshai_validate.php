<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}
class geshai_validate {
	function __construct() {
	}
	function geshai_validate() {
		$this->__construct ();
	}
	
	
	function match($partten, $v = null) {
		return preg_match ( $partten, $v );
	}
	
	
	function num($v = null) {
		if (is_array ( $v )) {
			return false;
		}
		return $this->match ( "/^([0-9]|[1-9][0-9]+)$/", $v );
	}
	
	function pnum($v = null) {
		if (is_array ( $v )) {
			return false;
		}
		return $this->match ( "/^([1-9]|[1-9][0-9]+)$/", $v );
	}
	
	function minu($v = null) {
		if (is_array ( $v )) {
			return false;
		}
		return $this->match ( "/^\-([1-9]|[0-9]+)$/", $v );
	}
	
	function e($v) {
		if (is_array ( $v )) {
			return false;
		}
		return $this->match ( "/^[a-zA-Z]+$/", $v );
	}
	
	function el($v) {
		if (is_array ( $v )) {
			return false;
		}
		return $this->match ( "/^[a-zA-Z_]+$/", $v );
	}
	
	function enl($v = null) {
		if (is_array ( $v )) {
			return false;
		}
		return $this->match ( "/^[a-zA-Z0-9_]+$/", $v );
	}
	
	function enl_len($v = null, $start = 1, $offset = 50) {
		if (is_array ( $v )) {
			return false;
		}
		return $this->match ( "/^[a-zA-Z0-9_]{{$start},{$offset}}$/", $v );
	}
	
	function en($v) {
		if (is_array ( $v )) {
			return false;
		}
		return $this->match ( "/^[a-zA-Z0-9]+$/", $v );
	}
	
	function en_len($v = null, $start = 1, $offset = 50) {
		if (is_array ( $v )) {
			return false;
		}
		return $this->match ( "/^[a-zA-Z0-9]{{$start},{$offset}}$/", $v );
	}
	
	function en_e($v = null, $start = 1, $offset = 50) {
		if (is_array ( $v )) {
			return false;
		}
		$offset = max ( $offset - 1, 1 );
		return $this->match ( "/^([a-zA-Z]|[a-zA-Z][a-zA-Z0-9]{{$start},{$offset}})$/", $v );
	}
	
	function enl_el($v = null, $start = 1, $offset = 50) {
		if (is_array ( $v )) {
			return false;
		}
		$offset = max ( $offset - 2, 1 );
		return $this->match ( "/^([a-zA-Z_]|[a-zA-Z_][a-zA-Z0-9_]{{$start},{$offset}})$/", $v );
	}
	
	function url($v) {
		if (is_array ( $v )) {
			return false;
		}
		return $this->match ( "/^(https?:\/\/)?(((www\.)?[a-zA-Z0-9_-]+(\.[a-zA-Z0-9_-]+)?\.([a-zA-Z]+))|(([0-1]?[0-9]?[0-9]|2[0-5][0-5])\.([0-1]?[0-9]?[0-9]|2[0-5][0-5])\.([0-1]?[0-9]?[0-9]|2[0-5][0-5])\.([0-1]?[0-9]?[0-9]|2[0-5][0-5]))(\:\d{0,4})?)(\/[\w- .\/?%&=]*)?$/i", $v );
	}
	
	function is_ip($val = NULL) {
		if (is_array ( $v )) {
			return false;
		}
		return $this->match ( "/^\d{1,3}.\d{1,3}.\d{1,3}.\d{1,3}$/", $v );
	}
	
	function email($v, $start = 1, $offset = 50) {
		if (is_array ( $v )) {
			return false;
		}
		return $this->match ( "/^([0-9a-z\\-_\\.]{{$start},{$offset}})@([0-9a-z]+\\.[a-z]{2,3}(\\.[a-z]{2,3})?)$/i", $v );
	}
	
	function dt($v) {
		if (is_array ( $v )) {
			return false;
		}
		return $this->match ( "/^\d{4}\-\d{1,2}\-\d{1,2}\s\d{1,2}:\d{1,2}:\d{1,2}$/s", $v );
	}
	
	function d($v) {
		if (is_array ( $v )) {
			return false;
		}
		return $this->match ( "/^\d{4}\-\d{1,2}\-\d{1,2}$/s", $v );
	}
	
	function fn($v = null, $ext = 'jpg') {
		if (is_array ( $v )) {
			return false;
		}
		return $this->match ( "/^([a-zA-Z0-9_]|[a-zA-Z0-9_.])+\.({$ex})$/i", $v );
	}
	
	function imagetype($v) {
		$t = getimagesize ( $v );
		$datas = array (
				'image/gif',
				'image/png',
				'image/x-png',
				'image/jpeg',
				'image/pjpeg' 
		);
		return in_array ( my_array_value ( 'mime', $t ), $datas );
	}
	
	function fsover($fsize, $v) {
		$fsize = ceil ( $fsize / 1024 );
		if ($fsize > ($v * 1024)) {
			return true;
		}
		return false;
	}
	
	
	function lr($s, $start = 1, $offset = 1) {
		if (is_array ( $v )) {
			return false;
		}
		$slen = strlen ( $s );
		if ($slen < $start || $slen > $offset) {
			return false;
		}
	}
	
	function em($v) {
		if (my_is_array ( $v )) {
			return false;
		}
		if ($v === true || $v === false) {
			return false;
		}
		if ($v == '0' || $v === 0) {
			return false;
		}
		return empty ( $v );
	}
	
	function sess_exist($k = null) {
		return _g ( 'session' )->_is_exist ( $k );
	}
	
	function hasget($k) {
		return my_array_key_exist ( $k, $_GET );
	}
	
	function haspost($k) {
		return my_array_key_exist ( $k, $_POST );
	}
	
	function fmflag() {
		$k = 'fsubmit_flag';
		if ($this->hasget ( $k )) {
			return _get ( $k );
		} else {
			if ($this->haspost ( $k )) {
				return _post ( $k );
			}
		}
		return '';
	}
	
	function fm($message = false) {
		$b = false;
		$name = $this->fmflag ();
		$key = 'fsubmit_key';
		$g_fmkey = null;
		switch ($name) {
			case 'post' :
				$g_fmkey = _post ( $key );
				break;
			
			case 'get' :
				$g_fmkey = _get ( $key );
				break;
		}
		if (strlen ( $name ) >= 1 && strlen ( $g_fmkey ) >= 1) {
			$k_fmkey = _g ( 'cfg>fmkey>' . $name );
			if (strlen ( $k_fmkey ) >= 1 && $k_fmkey === $g_fmkey) {
				$b = true;
			}
		}
		if ($b != true) {
			if ($message == true) {
				smsg ( lang ( '200001' ) );
			}
		}
		return $b;
	}
	
	function ajax($name = 'post') {
		$b = false;
		$g_str = null;
		switch ($name) {
			case 'post' :
				$g_str = _post ( 'fsubmit_ajax' );
				break;
			
			case 'get' :
				$g_str = _get ( 'fsubmit_ajax' );
				break;
		}
		if (strlen ( $name ) >= 1 && strlen ( $g_str ) >= 1) {
			$k_str = _g ( 'cfg>fmkey>ajax' );
			if (strlen ( $k_str ) >= 1 && $k_str === $g_str) {
				$b = true;
			}
		}
		return $b;
	}
	
	function onlybody($name = 'post') {
		$b = false;
		$g_str = null;
		switch ($name) {
			case 'post' :
				$g_str = _post ( 'fsubmit_onlybody' );
				break;
			
			case 'get' :
				$g_str = _get ( 'fsubmit_onlybody' );
				break;
		}
		if (strlen ( $name ) >= 1 && strlen ( $g_str ) >= 1) {
			$k_str = _g ( 'cfg>fmkey>onlybody' );
			if (strlen ( $k_str ) >= 1 && $k_str === $g_str) {
				$b = true;
			}
		}
		return $b;
	}
	
	function checkcode($v = null, $k = null) {
		$code = _g ( 'value' )->checkcode ( $k );
		if (strlen ( $code ) < 1) {
			return false;
		}
		if (strlen ( $v ) < 1) {
			return false;
		}
		return (strtolower ( $v ) === $code);
	}
	
	function v2eq($a, $b, $isfull = false) {
		if ($this->em ( $a ) || $this->em ( $b )) {
			return false;
		}
		if ($isfull != true) {
			return ($a == $b);
		} else {
			return ($a === $b);
		}
	}
	
	function expire($time, $expire) {
		if (! $this->pnum ( $time )) {
			return true;
		}
		if (! $this->pnum ( $expire )) {
			return true;
		}
		$v = _g ( 'cfg>time' ) - intval ( $time );
		if ($v > $expire) {
			return true;
		}
		return false;
	}
	
	function sb2eq($v = null) {
		return ($v == 1);
	}
	
	function sb2in($v = null) {
		return my_array_key_exist ( $v, _g ( 'value' )->sbs () );
	}
	
	function vm($v, $min, $max) {
		if ($v < $min) {
			return false;
		}
		if ($v > $max) {
			return false;
		}
		return true;
	}
	
	function filetype ($file, $arr) {
		if (strlen( $file ) < 1 ) {
			return false;
		}
		$fd = my_explode( '.', $file );
		if (my_count( $fd ) < 2) {
			return false;
		}
		$fd = strtolower( my_end( $fd ) );
		$arr = (is_array( $arr ) ? $arr : my_explode( ',', $arr ));
		return my_in_array( $fd , $arr);
	}
}
?>