<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}
class geshai_uri {
	function __construct() {
	}
	function geshai_uri() {
		$this->__construct ();
	}
	function referer($isSet = false) {
		if ($isSet === true) {
			_g ( 'cookie' )->value ( 'http_referer', $_SERVER ['REQUEST_URI'] );
		} else {
			$referer = _g ( 'cookie' )->value ( 'http_referer' );
			if (strlen ( $referer ) < 1) {
				return sdir ();
			} else {
				return $referer;
			}
		}
	}
	function su($value = null, $isRewrite = true, $isFull = false, $hideIndex = true) {
		$value = trim ( $value );
		if (strlen ( $value ) < 1) {
			return sdir ();
		}
		
		$valueData = my_explode ( '/', $value );
		$filename = trim ( $valueData [0] );
		unset ( $valueData [0] );
		
		$filename = (strlen ( $filename ) >= 1 ? ($filename . _g ( 'cfg>php' )) : '');
		$rntData = $filename;
		if (my_is_array ( $valueData )) {
			$rd = '__rd__';
			$index = 0;
			$splitStr = null;
			foreach ( $valueData as $v ) {
				$index ++;
				if ($index % 2 === 0) {
					if ($v === $rd) {
						$v = _g ( 'value' )->randchar ( 10 );
					}
					$splitStr .= ('=' . $v);
				} else {
					$splitStr .= ($index > 2 ? ('&' . $v) : $v);
				}
			}
			$rntData .= '?' . $splitStr;
		}
		
		if ($hideIndex === true) {
			$rntData = preg_replace ( "/index\.php/i", '', $rntData );
		}
		return (sdir () . '/' . $rntData);
	}
	function ser() {
		$s = 'http://' . $_SERVER ['HTTP_HOST'];
		return $s;
	}
	
	function value($v) {
		if (strlen($v) < 1) {
			return $v;
		}
		if (!preg_match("/^(http|https|ftp):\/\//i", $v)) {
			return ('http://' . $v);
		}
		return $v;
	}
}
?>