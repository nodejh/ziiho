<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}
class geshai_value {
	function __construct() {
	}
	function geshai_value() {
		$this->__construct ();
	}
	function geshai($k = null) {
		$dir = sdir ( ':data' );
		$filename = $dir . '/info.php';
		if (is_file ( $filename )) {
			$data = include ($filename);
		} else {
			$data = null;
		}
		return my_array_value ( $k, $data );
	}
	function checkcode($k = null, $v = null) {
		$k = (! _g ( 'validate' )->em ( $k ) ? $k : 'checkcode');
		if (func_num_args () != 2) {
			return my_session ( $k );
		} else {
			my_session ( $k, $v );
		}
	}
	function checkcode_destroy($k = null) {
		if (func_num_args () < 1) {
			$k = 'checkcode';
		} else {
			if (_g ( 'validate' )->em ( $k )) {
				return null;
			}
		}
		my_session_delete ( $k );
	}
	function user($k = null, $v = null) {
		if (func_num_args () != 2) {
			$data = my_serialize ( my_session ( 'user' ), true );
			return my_array_value ( $k, $data );
		} else {
			if (! _g ( 'validate' )->em ( $k )) {
				$data = my_serialize ( my_session ( 'user' ), true );
				$data = (is_array ( $data ) ? $data : array ());
				$data [$k] = $v;
			} else {
				$data = $v;
			}
			my_session ( 'user', $data );
		}
	}
	function v2second($n = null, $t = 'm') {
		$n = intval ( $n );
		switch ($t) {
			
			case 'd' :
				return ($n * 24 * 60 * 60);
				break;
			
			case 'h' :
				return ($n * 60 * 60);
				break;
			
			case 'm' :
				return ($n * 60);
				break;
			
			default :
				return 0;
				break;
		}
	}
	function ra($v) {
		return (! is_array ( $v ) ? array () : $v);
	}
	function sbs() {
		return _g ( 'value' )->ra ( _g ( 'module' )->dv ( '@', 100002 ) );
	}
	function sb($k = null, $k2 = false) {
		if ($k === true) {
			$k = 'true';
		} else {
			if ($k === false) {
				$k = 'false';
			}
		}
		
		$arr = $this->sbs();
		if (! my_array_key_exist ( $k, $arr )) {
			return _g ( 'module' )->dv ( '@', '100002>' . ($k2 !== true ? 'false' : 'true') . '>v' );
		}
		return _g ( 'module' )->dv ( '@', '100002>' . $k . '>v' );
	}
	function randchar($len, $mode = null) {
		$data = array (
				'0123456789',
				'abcdefghijklmnopqrstuvwxyz',
				'ABCDEFGHIJKLMNOPQRSTUVWXYZ' 
		);
		switch ($mode) {
			case 1 :
				$str = $data [0];
				break;
			case 2 :
				$str = $data [1];
				break;
			case 3 :
				$str = $data [2];
				break;
			case 4 :
				$str = ($data [1] . $data [2]);
				break;
			case 5 :
				$str = ($data [0] . $data [1]);
				break;
			case 6 :
				$str = ($data [0] . $data [2]);
				break;
			default :
				$str = ($data [0] . $data [1] . $data [2]);
				break;
		}
		$slen = strlen ( $str ) - 1;
		$value = null;
		for($i = 0; $i < $len; $i ++) {
			$value .= $str [mt_rand ( 0, $slen )];
		}
		return $value;
	}
	function vm($v, $min, $max) {
		if ($v < $min) {
			$v = $min;
		}
		if ($v > $max) {
			$v = $max;
		}
		return $v;
	}
	function eu($v = null) {
		return ('http://mail.' . my_end ( my_explode ( '@', $v ) ));
	}
	function nl2arr($str){
		$pattern = "/\r/";
		if(!preg_match($pattern, $str)){
			$pattern = "/\n/";
		}
		$d = preg_split($pattern, $str);
		return $d;
	}
	function arr2nl($v){
		$d = null;
		if(is_array($v)){
			$isLoop = false;
			foreach ($v as $str){
				if($isLoop){
					$d .= "\n";
				}
				$d .= $str;
				$isLoop = true;
			}
		}
		return $d;
	}
	function s2pnsplit($v) {
		$str = null;
		$d = $v;
		if (!is_array( $v )) {
			if (strlen( $v ) < 1) {
				return $str;
			}
			$d = my_explode( ',', $v );
		}
		foreach ( $d as $_d ) {
			$str .= (',' . $_d . ',');
		}
		return $str;
	}
	function serverinfo() {
		$S = array ();
		$S ['servdomain'] = array (
				'name' => '服务器域名',
				'value' => $_SERVER ['SERVER_NAME']
		);
		$S ['opsys'] = array (
				'name' => '服务器操作系统',
				'value' => @getenv ( 'OS' )
		);
		;
		$S ['sysserver'] = array (
				'name' => '服务器解译引擎',
				'value' => $_SERVER ['SERVER_SOFTWARE']
		);
		$S ['phpversion'] = array (
				'name' => 'PHP版本',
				'value' => phpversion ()
		);
		$S ['mysqlversion'] = array (
				'name' => 'MySql版本',
				'value' => _g ( 'db' )->server ( 1 )
		);
		$S ['fileupload'] = array (
				'name' => '上传文件',
				'value' => (@ini_get ( 'file_uploads' ) ? ini_get ( 'upload_max_filesize' ) : 'unknown')
		);
		return $S;
	}
}
?>