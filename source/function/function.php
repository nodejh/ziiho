<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}
function my_is_array($arr) {
	if (! is_array ( $arr )) {
		return false;
	}
	if (count ( $arr ) < 1) {
		return false;
	}
	return true;
}
function my_in_array($str, $arr) {
	if (strlen ( $str ) < 1) {
		return false;
	}
	if (! my_is_array ( $arr )) {
		return false;
	}
	if (! in_array ( $str, $arr )) {
		return false;
	}
	return true;
}
function my_join($delimiter, $arr, $def = null) {
	if (! my_is_array ( $arr )) {
		return $def;
	}
	return join ( $delimiter, $arr );
}
function my_count($arr) {
	if (! is_array ( $arr )) {
		return 0;
	}
	return count ( $arr );
}
function my_explode($s, $str) {
	if (strlen ( $str ) < 1) {
		return array ();
	}
	return explode ( $s, $str );
}
function my_fisrt($arr, $def = null) {
	if(!my_is_array($arr)){
		return $def;
	}
	return current( $arr );
}
function my_end($arr, $def = null) {
	if(!my_is_array($arr)){
		return $def;
	}
	return end ($arr );
}
function my_keys($arr, $def = NULL) {
	if (! my_is_array ( $arr )) {
		return $def;
	}
	return array_keys ( $arr );
}
function my_array_key_exist($keys, $value) {
	$types = array (
			'integer',
			'float',
			'string',
			'double' 
	);
	if (! in_array ( gettype ( $keys ), $types )) {
		return false;
	}
	if (! my_is_array ( $value )) {
		return false;
	}
	
	$ks = explode ( '>', $keys );
	foreach ( $ks as $k ) {
		if (! is_array ( $value )) {
			return false;
		}
		if (! array_key_exists ( $k, $value )) {
			return false;
		}
		$value = $value [$k];
	}
	
	return true;
}
function my_array_filp($val, $isRe = false) {
	if (! my_is_array ( $val )) {
		return null;
	}
	$val = array_flip ( $val );
	$val = ($isRe !== true ? $val : array_flip ( $val ));
	return $val;
}

function my_array_push(&$data, $v = null, $k = null) {
	$data = (! is_array ( $data ) ? array () : $data);
	switch (func_num_args ()) {
		case 2 :
			$data [] = $v;
			break;
		case 3 :
			$data [$k] = $v;
			break;
	}
	return $v;
}

function my_array_unshift(&$data, $v = null) {
	if (! is_array ( $data )) {
		$data = array ();
	}
	array_unshift ( $data, $v );
	return $data;
}

function my_array_value($keys = null, $value = array(), $def = null) {
	if (strlen ( $keys ) < 1) {
		return $def;
	}
	$ks = explode ( '>', $keys );
	if (! my_is_array ( $value )) {
		return $def;
	}
	foreach ( $ks as $k ) {
		if (! my_array_key_exist ( $k, $value )) {
			return $def;
		}
		$value = $value [$k];
	}
	return $value;
}

function than2eq($v, $v2, $r1 = null, $r2 = null){
	if ($v == $v2) {
		return $r1;
	} else {
		return $r2;
	}
}

function _g_set($k, $v = null) {
	global $_G;
	$_G [$k] = $v;
	return $v;
}

function _g($keys = null, $def = null) {
	global $_G;
	
	if (strlen ( $keys ) < 1) {
		return $def;
	}
	$keys = str_ireplace('@', 'common', $keys);
	return my_array_value ( $keys, $_G, $def );
}

function my_addslashes($_data) {
	if (is_array ( $_data )) {
		foreach ( $_data as $key => $val ) {
			$_data [$key] = my_addslashes ( $val );
		}
	} else {
		$_data = trim ( (is_string ( $_data ) ? addslashes ( $_data ) : $_data) );
	}
	return $_data;
}

function my_stripslashes($_data) {
	if (is_array ( $_data )) {
		foreach ( $_data as $key => $val ) {
			$_data [$key] = my_stripslashes ( $val );
		}
	} else {
		$_data = trim ( (is_string ( $_data ) ? stripslashes ( $_data ) : $_data) );
	}
	return $_data;
}

function my_htmlspecialchars($_data) {
	if (is_array ( $_data )) {
		foreach ( $_data as $key => $val ) {
			$_data [$key] = my_htmlspecialchars ( $val );
		}
	} else {
		$_data = trim ( (is_string ( $_data ) ? htmlspecialchars ( $_data ) : $_data) );
	}
	return $_data;
}

function my_htmlspecialchars_decode($_data) {
	if (is_array ( $_data )) {
		foreach ( $_data as $key => $val ) {
			$_data [$key] = my_htmlspecialchars_decode ( $val );
		}
	} else {
		$_data = trim ( (is_string ( $_data ) ? htmlspecialchars_decode ( $_data ) : $_data) );
	}
	return $_data;
}

function _get($k, $v = null) {
	$len = func_num_args ();
	if ($len == 1) {
		return my_addslashes ( my_array_value ( $k, $_GET ) );
	} else if ($len == 2) {
		$_GET [$k] = $v;
	}
}

function _post($k, $v = null) {
	$len = func_num_args ();
	if ($len == 1) {
		return my_addslashes ( my_array_value ( $k, $_POST ) );
	} else if ($len == 2) {
		$_POST [$k] = $v;
	}
}

function _ifile($key = null) {
	return my_array_value ( $key, $_FILES );
}

function my_session($k, $v = null) {
	$arglen = func_num_args ();
	if ($arglen == 1) {
		return _g ( 'session' )->value ( $k );
	} else if ($arglen == 2) {
		_g ( 'session' )->value ( $k, $v );
	}
}

function my_session_id($v = null) {
	return _g ( 'session' )->id ( $v );
}

function my_session_delete($k) {
	_g ( 'session' )->delete ( $k );
}

function my_session_destroy(){
	_g ( 'session' )->destroy ();
}

function my_serialize($value, $t = false) {
	if (func_num_args () == 1) {
		if (! is_array ( $value )) {
			return null;
		} else {
			return serialize ( $value );
		}
	} else {
		$def = array ();
		if ($t === true) {
			$r = unserialize ( $value );
			if (! is_array ( $r )) {
				$r = $def;
			}
			return $r;
		} else {
			return $def;
		}
	}
}

function my_md5($s, $n = 1) {
	$n = intval ( $n );
	if (strlen ( $s ) < 1 || $n < 1) {
		return $s;
	}
	$n --;
	$s = my_md5 ( md5 ( $s ), $n );
	return $s;
}

function my_unset(&$data = null, $name = null) {
	$len = func_num_args ();
	if ($len == 1) {
		$data = null;
	} else if ($len == 2) {
		$keys = my_explode ( ',', $name );
		foreach ( $keys as $k ) {
			if (my_array_key_exist ( $k, $data )) {
				unset ( $data [$k] );
			}
		}
	}
}

function my_less0value($v, $def = null){
	return (_g('validate')->num($v) ? $v : $def);
}

function my_less1value($v, $def = null){
	return (_g('validate')->pnum($v) ? $v : $def);
}

function v2bool($v){
	$arr = array( '1', 1, 'true', 'on', 't', 'y');
	if(preg_match("/^(\d+)$/", $v)){
		$v = strtolower($v);
	}
	return in_array($v, $arr);
}

function sdir($kn = null) {
	if (func_num_args () < 1) {
		return _g ( 'loader' )->sdir ();
	} else {
		return _g ( 'loader' )->sdir ( $kn );
	}
}
function lang($name = null, $rep = null) {
	return _g ( 'module' )->lang ( $name, $rep );
}

function smsg($message = null, $redirectUrl = null, $param = null) {
	return _g ( 'loader' )->print_message ( $message, $redirectUrl, $param );
}

function prt() {
	foreach ( func_get_args () as $v ) {
		print_r ( $v );
	}
}

function uploadfile($v = null, $isdefault = false){
	if(_g('validate')->em($v)){
		return (_g('template')->dir('@')  . '/image/default.jpg');
	}
	$path = sdir('uploadfile');
	$path = ($path . '/' . $v);
	return $path;
}

function str2array($data) {
	if (! preg_match ( "/array\((.+?)\)(;)?$/i", $data )) {
		return array ();
	}
	eval ( '$arr=' . $data . ';' );
	$arr = (! is_array ( $arr ) ? array () : $arr);
	return $arr;
}

function array2str($data) {
	if (my_is_array ( $data )) {
		$i = 0;
		$str = 'array(';
		foreach ( $data as $key => $val ) {
			$i ++;
			if ($i > 1) {
				$str .= ',';
			}
			if (my_is_array ( $val )) {
				$str .= "'{$key}'=>" . array2str ( $val );
			} else {
				if (strpos ( $val, '$' ) === 0) {
					$str .= "'{$key}'=>" . $val;
				} else {
					$str .= "'{$key}'=>'" . my_addslashes ( $val ) . "'";
				}
			}
		}
		return ($str . ')');
	}
	return ('array()');
}

function array2json($array) {
	if (! my_is_array ( $array )) {
		return '{}';
	}
	$associative = my_count ( array_diff ( array_keys ( $array ), array_keys ( array_keys ( $array ) ) ) );
	if ($associative >= 1) {
		$construct = array ();
		foreach ( $array as $key => $value ) {
			if (is_numeric ( $key )) {
				$key = "key_{$key}";
			}
			$key = "'" . my_addslashes ( $key ) . "'";
			if (my_is_array ( $value )) {
				$value = array2json ( $value );
			} else if (! is_numeric ( $value ) || is_string ( $value )) {
				$value = "'" . my_addslashes ( $value ) . "'";
			}
			$construct [] = "{$key}: {$value}";
		}
		$result = '{ ' . implode ( ',', $construct ) . ' }';
	} else {
		$construct = array ();
		foreach ( $array as $value ) {
			if (my_is_array ( $value )) {
				$value = array2json ( $value );
			} else if (! is_numeric ( $value ) || is_string ( $value )) {
				$value = "'" . my_addslashes ( $value ) . "'";
			}
			$construct [] = $value;
		}
		$result = '[' . implode ( ',', $construct ) . ']';
	}
	return $result;
}

function person_time($beforeTime, $dt_format = 'Y-m-d') {
	$nowTime = time();
	$times = $nowTime - $beforeTime;
	
	if($times < 86400){
		if(date('Ymd', $beforeTime) != date('Ymd', $nowTime)){
			return ('昨天' . date('H:i', $beforeTime));
		}else{
			if($times >= 3600){
				$hours = ($times - ($times % 3600)) / 3600;
				return ($hours . '小时前');
			}else{
				if($times > 60){
					$minutes = ($times - ($times % 60)) / 60;
					return ($minutes . '分钟前');
				}else{
					if($times > 3){
						return ($times . '秒钟前');
					}else{
						return ('刚刚');
					}
				}
			}
		}
	}else{
		$day = round($times / 86400);
		switch($day){
			case 1:
				return ('昨天' . date('H:i', $beforeTime));
				break;
			case 2:
				return ('前天' . date('H:i', $beforeTime));
				break;
			default:
				if($day < 15){
					return ($day . '天前');
				}else{
					return date($dt_format, $beforeTime);
				}
				break;
		}
	}
}
function my_substr($content, $start, $length = NULL, $appendStr = NULL){
	$content = trim($content);
	$length = intval($length);
	$start = intval($start);
	if($start === 0 && $length === 0){
		return $content;
	}
	if (function_exists('mb_substr') && function_exists('mb_strlen')) {
		$contLen = mb_strlen($cStr, _g('cfg>charset'));
		$cStr = mb_substr($content, $start, ($length < 1 ? $contLen : $length), _g('cfg>charset'));
		return ($contLen <= $length ? $cStr : ($cStr . $appendStr));
	}
	$contLen = strlen($content);
	$str = substr($content, $start, ($length < 1 ? $contLen : $length));
	$char = 0;
	for ($i = 0; $i < strlen($str); $i++) {
		if (ord($str[$i]) >= 128){
			$char++;
		}
	}
	$str2 = substr($content, $start, $length + 1);
	$str3 = substr($content, $start, $length + 2);
	if ($char % 3 == 1) {
		if ($length <= strlen($content)) {
			$str3 = $str3 . $appendStr;
		}
		return $str3;
	}
	if ($char % 3 == 2) {
		if ($length <= strlen($content)) {
			$str2 = $str2 . $appendStr;
		}
		return $str2;
	}
	if ($char % 3 == 0) {
		if ($length <= strlen($content)) {
			$str = $str . $appendStr;
		}
		return $str;
	}
}

function image_size($v) {
	$arr = NULL;
	if (is_file ( $v )) {
		$arr = getimagesize ( $v );
		if (!my_is_array ( $arr )) {
			$arr = array (
					0,
					0
			);
		}
	}
	return $arr;
}
function imagenewseize($imgsrc, $img_w, $img_h = NULL) {
	$srcsize = image_size ( $imgsrc );
	if (!my_is_array ( $srcsize )) {
		return array (
				0,
				0
		);
	}
	
	if ($img_w < 1) {
		$img_w = $srcsize [0];
	}
	if ($img_h < 1) {
		$img_h = $srcsize [1];
	}
	
	$fill_w = ( int ) $img_w;
	$fill_h = ( int ) $img_h;
	$rate_w = $srcsize [0] / $fill_w;
	$rate_h = $srcsize [1] / $fill_h;
	
	if ($rate_w < 1 && $rate_h < 1) {
		$new_w = ( int ) $srcsize [0];
		$new_h = ( int ) $srcsize [1];
	} else {
		if ($rate_w >= $rate_h) {
			$new_w = ( int ) $fill_w;
			$new_h = round ( $srcsize [1] / $rate_w );
		} else {
			$new_w = round ( $srcsize [0] / $rate_h );
			$new_h = ( int ) $fill_h;
		}
	}
	return array (
			max ( 0, $new_w ),
			max ( 0, $new_h )
	);
}
function imagethumb($src_img, $dst_img, $w, $h, $img_quality = 90) {
	global $_G;
	$iObj = _g('loader')->lib ( 'image', null, true );
	$iObj->img_display_quality = $img_quality;
	$iObj->srcimage ( $src_img );
	$iObj->dstimage ( $dst_img );
	$sv = $iObj->createimage ( $w, $h );
	return $sv;
}
function imagecut($img = NULL, $des_img = NULL, $xy = NULL, $wh = NULL, $display_quality = 90) {
	$arr = image_size ( $img );
	if ($arr [0] < 1) {
		return $img;
	}
	_g('loader')->lib ( 'image', null, true );
	new geshai_imagecutwater ( $img, $des_img, 2, $xy, $wh, $display_quality );
}
function imagewater($img = NULL, $des_img = NULL, $waterimg = NULL, $postion = NULL, $display_quality = 90, $merge_quality = 90, $ox = 0, $oy = 0) {
	$arr = image_size ( $img );
	if ($arr [0] < 1) {
		return $img;
	}
	_g('loader')->lib ( 'image', null, true );
	new geshai_imagecutwater ( $img, $des_img, 1, $waterimg, $postion, $display_quality, $merge_quality, $ox, $oy );
}
function textwater($img, $des_img = NULL, $ttf, $txt = NULL, $fontsize = NULL, $position = NULL, $fontcolor = NULL, $jiaodu = NULL, $display_quality = 90, $ox = 0, $oy = 0) {
	$arr = image_size ( $img );
	if ($arr [0] < 1) {
		return $img;
	}
	_g('loader')->lib ( 'image', null, true );
	new geshai_imagetxtwater ( $img, $des_img, $ttf, $txt, $fontsize, $position, $fontcolor, $jiaodu, $display_quality, $ox, $oy );
}

function getip() {
	if (getenv ( "HTTP_CLIENT_IP" ) && strcasecmp ( getenv ( "HTTP_CLIENT_IP" ), "unknown" )) {
		$ip = getenv ( "HTTP_CLIENT_IP" );
	} else {
		if (getenv ( "HTTP_X_FORWARDED_FOR" ) && strcasecmp ( getenv ( "HTTP_X_FORWARDED_FOR" ), "unknown" )) {
			$ip = getenv ( "HTTP_X_FORWARDED_FOR" );
		} else {
			if (getenv ( "REMOTE_ADDR" ) && strcasecmp ( getenv ( "REMOTE_ADDR" ), "unknown" )) {
				$ip = getenv ( "REMOTE_ADDR" );
			} else {
				if (isset ( $_SERVER ['REMOTE_ADDR'] ) && $_SERVER ['REMOTE_ADDR'] && strcasecmp ( $_SERVER ['REMOTE_ADDR'], "unknown" )) {
					$ip = $_SERVER ['REMOTE_ADDR'];
				} else {
					$ip = 'unknown';
				}
			}
		}
	}
	return $ip;
}
/* 数字转为大写 */
function numtostr($number) {
	$number = sub_str ( $number, 0, 2 );
	$arr = array (
			'零',
			'一',
			'二',
			'三',
			'四',
			'五',
			'六',
			'七',
			'八',
			'九' 
	);
	if (str_len ( $number ) == 1) {
		$result = $arr [$number];
	} else {
		if ($number == 10) {
			$result = '十';
		} else {
			if ($number < 20) {
				$result = '十';
			} else {
				$result = ($arr [sub_str ( $number, 0, 1 )]) . '十';
			}
			if (sub_str ( $number, 1, 1 ) != '0') {
				$result .= $arr [sub_str ( $number, 1, 1 )];
			}
		}
	}
	return $result;
}
/* 清除html */
function html_clear($str) {
	$st = - 1; /* 开始 */
	$et = - 1; /* 结束 */
	$stmp = array ();
	$stmp [] = '&nbsp;';
	$len = strlen ( $str );
	for($i = 0; $i < $len; $i ++) {
		$ss = substr ( $str, $i, 1 );
		if (ord ( $ss ) == 60) {
			$st = $i;
		}
		if (ord ( $ss ) == 62) {
			$et = $i;
			if ($st != - 1) {
				$stmp [] = substr ( $str, $st, $et - $st + 1 );
			}
		}
	}
	$str = str_replace ( $stmp, NULL, $str );
	return $str;
}
/* 读取网络图片并保持于本地 */
function remote_img_local($url, $filename = NULL) {
	if (str_len ( $url ) < 1) {
		return NULL;
	}
	if ($filename == NULL) {
		return NULL;
	}
	$fp = @fopen ( $url, 'r' );
	@fclose ( $fp );
	if (! $fp) {
		return NULL;
	}
	unset ( $fp );
	/* 写入图片 */
	ob_start ();
	readfile ( $url );
	$img = ob_get_contents ();
	ob_end_clean ();
	$size = strlen ( $img );
	
	$fp2 = @fopen ( $filename, 'a' );
	fwrite ( $fp2, $img );
	fclose ( $fp2 );
	return $filename;
}
/* 计算文件大小 */
function format_file_size($file_size) {
	if (check_nums ( $file_size ) < 1) {
		return 0;
	}
	$str = array (
			'B',
			'KB',
			'MB',
			'GB',
			'TB' 
	);
	/* KB */
	$kb = 1024;
	/* MB */
	$mb = 1024 * $kb;
	/* GB */
	$gb = 1024 * $mb;
	/* TB */
	$tb = 1024 * $gb;
	if ($file_size < $kb) {
		return $file_size . $str [0];
	} else if ($file_size < $mb) {
		return round ( $file_size / $kb, 2 ) . $str [1];
	} else if ($file_size < $gb) {
		return round ( $file_size / $mb, 2 ) . $str [2];
	} else if ($file_size < $tb) {
		return round ( $file_size / $gb, 2 ) . $str [3];
	} else {
		return round ( $file_size / $tb, 2 ) . $str [4];
	}
}
/* 获取主机地址 */
function get_current_domain() {
	/* 协议 */
	$protocol = (isset ( $_SERVER ['HTTPS'] ) && (strtolower ( $_SERVER ['HTTPS'] ) != 'off')) ? url_pre_val ( 'https' ) : url_pre_val ( 'http' );
	/* 域名或IP地址 */
	if (isset ( $_SERVER ['HTTP_X_FORWARDED_HOST'] )) {
		$host = $_SERVER ['HTTP_X_FORWARDED_HOST'];
	} elseif (isset ( $_SERVER ['HTTP_HOST'] )) {
		$host = $_SERVER ['HTTP_HOST'];
	} else {
		/* 端口 */
		if (isset ( $_SERVER ['SERVER_PORT'] )) {
			$port = ':' . $_SERVER ['SERVER_PORT'];
			if (((':80' == $port) && (url_pre_val ( 'http' )) == $protocol) || ((':443' == $port) && (url_pre_val ( 'https' ) == $protocol))) {
				$port = '';
			}
		} else {
			$port = '';
		}
		if (isset ( $_SERVER ['SERVER_NAME'] )) {
			$host = $_SERVER ['SERVER_NAME'] . $port;
		} elseif (isset ( $_SERVER ['SERVER_ADDR'] )) {
			$host = $_SERVER ['SERVER_ADDR'] . $port;
		}
	}
	return $protocol . $host;
}
/* 获取服务器信息 */
function get_webinfo() {
	$result = array ();
	$result ['self'] = strtolower ( $_SERVER ['PHP_SELF'] ? $_SERVER ['PHP_SELF'] : $_SERVER ['SCRIPT_NAME'] );
	$result ['domain'] = strtolower ( $_SERVER ['SERVER_NAME'] );
	$result ['agent'] = $_SERVER ['HTTP_USER_AGENT'];
	$result ['referer'] = isset ( $_SERVER ['HTTP_REFERER'] ) ? $_SERVER ['HTTP_REFERER'] : '';
	$result ['scheme'] = $_SERVER ['SERVER_PORT'] == '443' ? url_pre_val ( 'https' ) : url_pre_val ( 'http' );
	$result ['reuri'] = isset ( $_SERVER ['REQUEST_URI'] ) ? $_SERVER ['REQUEST_URI'] : '';
	$result ['port'] = $_SERVER ['SERVER_PORT'] == '80' ? '' : ':' . $_SERVER ['SERVER_PORT'];
	$result ['url'] = $result ['scheme'] . $result ['domain'] . $result ['port'];
	return $result;
}
/* 获取url地址名 */
function url_domain($url) {
	$url = strtolower ( $url );
	$url = replace_str ( $url, '\\', '/' );
	$url = replace_str ( $url, url_pre_val ( 'http' ), '' );
	$url = replace_str ( $url, url_pre_val ( 'https' ), '' );
	$url = replace_str ( $url, url_pre_val ( 'ftp' ), '' );
	$url = replace_str ( $url, 'www.', '' );
	$url = explode_str ( $url, '/' );
	$url = array_key_val ( 0, $url );
	return $url;
}
/* 默认添加url前缀 */
function url_pre_append($url) {
	if (str_len ( $url ) < 1) {
		return $url;
	}
	/* http */
	$pre_http = url_pre_val ( 'http' );
	list ( , $len ) = explode_str ( $url, $pre_http, true );
	if ($len > 1) {
		return $url;
	}
	/* https */
	$pre_https = url_pre_val ( 'https' );
	list ( , $len ) = explode_str ( $url, $pre_https, true );
	if ($len > 1) {
		return $url;
	}
	/* ftp */
	$pre_ftp = url_pre_val ( 'ftp' );
	list ( , $len ) = explode_str ( $url, $pre_ftp, true );
	if ($len > 1) {
		return $url;
	}
	return $pre_http . $url;
}
/* 获取url域名 */
function get_url_domain($url = NULL) {
	global $_G;
	$host = url_domain ( $url );
	$domain = $host;
	
	$filepath = ($_G ['app'] ['path_data']) . 'sys/domain_suffix.php';
	if (is_file ( $filepath )) {
		$dSuffix = include $filepath;
		$dSuffix = ($dSuffix [0] . ',' . $dSuffix [1]);
		$dSuffix = preg_replace ( "/\s/", '', $dSuffix );
		$dSuffix = str_replace ( ',', '|', $dSuffix );
		
		$pattern = "[^\.]+\.(?:(" . $dSuffix . ")|\w{2}|((" . $dSuffix . ")\.\w{2}))$";
		if (preg_match ( "/" . $pattern . "/ies", $host, $matchs )) {
			$domain = $matchs ['0'];
		}
	}
	return $domain;
}
/* 检查url是否正确 */
function url_check($url) {
	$url = url_domain ( $url );
	list ( $arr, $len ) = explode_str ( $url, '.', true );
	if ($len < 2) {
		return 0;
	}
	/*
	 * if(!preg_match("/^([a-zA-Z0-9_\.])+$/",$url)){ return 0; }
	 */
	if (! preg_match ( "/^(\w+(-\w+)*)(\.(\w+(-\w+)*))*(\?\s*)?$/", $url )) {
		return 0;
	}
	return 1;
}
/* 检查url是否有效 */
function url_open_check($url) {
	$handle = @fopen ( $url, "r" );
	@fclose ( $handle );
	if (! $handle) {
		return 0;
	}
	return 1;
}
/* 解析url参数 */
function de_urlparam($url = NULL) {
	$url_arr = parse_url ( $url );
	parse_str ( array_key_val ( 'query', $url_arr ), $p_arr );
	return $p_arr;
}
/* 得到当前URL */
function current_url($addStr = NULL, $isDomain = false) {
	global $_G;
	$urlPre = ($isDomain != false) ? get_current_domain () : NULL;
	$urlVal = $urlPre . $_G ['app'] ['path_web'] . $addStr;
	return $urlVal;
}
/* 设置当前url */
function set_current_url($is_encode = false, $is_cookie = false, $skey = 'sess_current_url') {
	global $_G;
	$res = replace_str ( $_SERVER ["REQUEST_URI"], '%23', '#' );
	$_val = (get_current_domain ()) . $res;
	if ($is_encode === true) {
		$_val = tostr_encode ( $_val );
	}
	if ($is_cookie === true) {
		$_time = ($_G ['app'] ['sys_time']) + (86400 * 30);
		setcookie ( $skey, $_val, $_time );
	}
	return $_val;
}
/* 获取设置当前url */
function get_current_url($is_decode = false, $skey = 'sess_current_url') {
	if (check_is_key ( $skey, $_COOKIE ) == 1) {
		$_val = $_COOKIE [$skey];
		if ($is_decode === true) {
			$_val = tostr_decode ( $_val );
		}
	} else {
		$_val = get_index ();
	}
	return $_val;
}
/* 字符串加密解密 */
function str_authcode($string, $operation = 0, $key = '123456', $expiry = 0) {
	$operation = (($operation != 1) ? 'ENCODE' : 'DECODE');
	$ckey_length = 4;
	// 随机密钥长度 取值 0-32;
	// 加入随机密钥，可以令密文无任何规律，即便是原文和密钥完全相同，加密结果也会每次不同，增大破解难度。
	// 取值越大，密文变动规律越大，密文变化 = 16 的 $ckey_length 次方
	// 当此值为 0 时，则不产生随机密钥
	$key = md5 ( $key ? $key : '123456' );
	$keya = md5 ( substr ( $key, 0, 16 ) );
	$keyb = md5 ( substr ( $key, 16, 16 ) );
	$keyc = $ckey_length ? ($operation == 'DECODE' ? substr ( $string, 0, $ckey_length ) : substr ( md5 ( microtime () ), - $ckey_length )) : '';
	
	$cryptkey = $keya . md5 ( $keya . $keyc );
	$key_length = strlen ( $cryptkey );
	
	$string = $operation == 'DECODE' ? base64_decode ( substr ( $string, $ckey_length ) ) : sprintf ( '%010d', $expiry ? $expiry + time () : 0 ) . substr ( md5 ( $string . $keyb ), 0, 16 ) . $string;
	$string_length = strlen ( $string );
	
	$result = '';
	$box = range ( 0, 255 );
	
	$rndkey = array ();
	for($i = 0; $i <= 255; $i ++) {
		$rndkey [$i] = ord ( $cryptkey [$i % $key_length] );
	}
	
	for($j = $i = 0; $i < 256; $i ++) {
		$j = ($j + $box [$i] + $rndkey [$i]) % 256;
		$tmp = $box [$i];
		$box [$i] = $box [$j];
		$box [$j] = $tmp;
	}
	
	for($a = $j = $i = 0; $i < $string_length; $i ++) {
		$a = ($a + 1) % 256;
		$j = ($j + $box [$a]) % 256;
		$tmp = $box [$a];
		$box [$a] = $box [$j];
		$box [$j] = $tmp;
		$result .= chr ( ord ( $string [$i] ) ^ ($box [($box [$a] + $box [$j]) % 256]) );
	}
	
	if ($operation == 'DECODE') {
		if ((substr ( $result, 0, 10 ) == 0 || substr ( $result, 0, 10 ) - time () > 0) && substr ( $result, 10, 16 ) == substr ( md5 ( substr ( $result, 26 ) . $keyb ), 0, 16 )) {
			return substr ( $result, 26 );
		} else {
			return '';
		}
	} else {
		return $keyc . str_replace ( '=', '', base64_encode ( $result ) );
	}
}
/* 文件扩展名格式转为字符串 */
function ext2str($ext) {
	$strVal = NULL;
	if (check_is_array ( $ext ) == 1) {
		foreach ( $ext as $v ) {
			if (! empty ( $strVal )) {
				$strVal .= ';';
			}
			$strVal .= '*.' . $v;
		}
	}
	return $strVal;
}
/* url跳转 */
function locationUrl($url = NULL, $isCurrent = true) {
	if ($isCurrent != false) {
		$url = current_url ( $url, true );
	} else {
		if (empty ( $url )) {
			$url = current_url ( NULL, true );
		}
	}
	header ( "Location: {$url}" );
}
/* 获取目录下的文件 */
function get_file_list($dir, $getType = NULL, $firstFileName = false, $orderBy = NULL) {
	if (! is_dir ( $dir )) {
		return NULL;
	}
	$dirArr = NULL;
	if (false != ($handle = opendir ( $dir ))) {
		$i = 0;
		while ( false !== ($fileName = readdir ( $handle )) ) {
			if ($fileName == '.' || $fileName == '..') {
				continue;
			}
			$filePath = $dir . '/' . $fileName;
			switch ($getType) {
				case 'dir' :
					if (! is_dir ( clearfilestr ( $filePath ) )) {
						continue;
					} else {
						$dirArr [$i] = getfileinfo ( $filePath );
					}
					break;
				case 'file' :
					if (! is_file ( clearfilestr ( $filePath ) )) {
						continue;
					} else {
						$dirArr [$i] = getfileinfo ( $filePath );
					}
					break;
				default :
					$dirArr [$i] = getfileinfo ( $filePath );
					break;
			}
			if ($firstFileName == true) {
				break;
			}
			$i ++;
		}
		closedir ( $handle );
	}
	return $dirArr;
}
/* 返回文件信息 */
function getfileinfo($fileName) {
	$fileName = clearfilestr ( $fileName );
	if (! file_exists ( $fileName )) {
		return NULL;
	}
	$Arr = array ();
	
	$fileArr = explode ( '/', $fileName );
	$name = end ( $fileArr );
	unset ( $fileArr [count ( $fileArr ) - 1] );
	$Arr ['filename'] = $fileName;
	$Arr ['path'] = implode ( '/', $fileArr );
	$Arr ['name'] = $name;
	
	if (is_file ( $fileName )) {
		$Arr ['filetype'] = 'file';
	} else {
		$Arr ['filetype'] = 'dir';
	}
	$Arr ['ctime'] = filectime ( $fileName );
	return $Arr;
}
/* 读取文件内容 */
function read_file_content($fileName, $defaultStr = NULL) {
	if (! is_file ( $fileName )) {
		return NULL;
	}
	if (! @$fp = fopen ( $fileName, 'r' )) {
		return NULL;
	}
	if (! flock ( $fp, LOCK_SH | LOCK_NB )) {
		fclose ( $fp );
		return NULL;
	}
	$contentLen = filesize ( $fileName );
	if ($contentLen < 1) {
		$ContentStr = $defaultStr;
	} else {
		$ContentStr = fread ( $fp, $contentLen );
	}
	flock ( $fp, LOCK_UN );
	fclose ( $fp );
	return $ContentStr;
}
/* 写入内容到文件 */
function file_write_content($fileName, $contentStr = NULL, $mode = 'w') {
	if (! @$fp = fopen ( $fileName, $mode )) {
		return false;
	}
	if (! flock ( $fp, LOCK_EX | LOCK_NB )) {
		fclose ( $fp );
		return false;
	}
	fwrite ( $fp, $contentStr );
	flock ( $fp, LOCK_UN );
	fclose ( $fp );
	return true;
}
/* 模板列表 */
function template_list_get() {
	global $_G;
	$pathRoot = ($_G ['app'] ['path_template']) . 'main';
	if (strlen ( $pathRoot ) < 1) {
		return NULL;
	}
	if (! is_dir ( $pathRoot )) {
		return NULL;
	}
	return get_file_list ( $pathRoot, 'dir' );
}
/* 模板检查是否存在 */
function template_check($dirName) {
	global $_G;
	if (check_en ( $dirName ) < 1) {
		return false;
	}
	$pathRoot = ($_G ['app'] ['path_template']) . 'main';
	if (strlen ( $pathRoot ) < 1) {
		return false;
	}
	if (! is_dir ( $pathRoot )) {
		return false;
	}
	if (! is_dir ( $pathRoot . DS . $dirName )) {
		return false;
	}
	return true;
}
?>