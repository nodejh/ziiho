<?php
if (! defined ( 'APP_PATH' )) {
	exit ( 'no direct access allowed' );
}

/* 全局变量 */
function _g() {
	global $_G;
	return $_G;
}
/* 分页省略号 */
function page_omit() {
	global $_G;
	$val = $_G ['app'] ['page_omit'];
	return $val;
}
/* 统计字符串 */
function str_len($str) {
	global $_G;
	$str = trim ( $str );
	return mb_strlen ( $str, $_G ['app'] ['tpl_charset'] );
}
/* 字符串截取 */
function sub_str($str, $star_len, $end_len = NULL, $link_str = NULL) {
	global $_G;
	$str = trim ( $str );
	$str_len = str_len ( $str );
	if ($str_len < 1) {
		return $str;
	}
	if (check_num ( $star_len ) < 1) {
		$star_len = 0;
	}
	if (check_nums ( $end_len ) < 1) {
		$end_len = $str_len;
	}
	$new_str = mb_substr ( $str, $star_len, $end_len, $_G ['app'] ['tpl_charset'] );
	if ($str_len > $end_len) {
		$new_str = ($link_str != NULL) ? $new_str . $link_str : $new_str;
	}
	return $new_str;
}
/* 字符串替换 */
function replace_str($str, $search_str = '', $replace_str = '') {
	if (str_len ( $str ) < 1) {
		return $str;
	}
	$str = str_replace ( $search_str, $replace_str, $str );
	return $str;
}
/* 字符串结束 */
function explode_str($str, $sign_str = ',', $is_count = false, $is_end = false) {
	if (str_len ( $str ) < 1) {
		return $str;
	}
	$arr = explode ( $sign_str, $str );
	if ($is_count == true) {
		if ($is_end != true) {
			$arr = array (
					$arr,
					count ( $arr ) 
			);
		} else {
			$arr = array (
					$arr,
					count ( $arr ),
					end ( $arr ) 
			);
		}
	}
	return $arr;
}
/* 字符转换为html编码 */
function html_special($str = NULL) {
	global $_G;
	if (str_len ( $str ) < 1) {
		return $str;
	}
	$str = htmlspecialchars ( $str, ENT_QUOTES, $_G ['app'] ['tpl_charset'] );
	return $str;
}
/* 字符转换为html编码 */
function html_special_de($str = NULL) {
	global $_G;
	if (str_len ( $str ) < 1) {
		return $str;
	}
	$str = htmlspecialchars_decode ( $str, ENT_QUOTES );
	return $str;
}
/* 数组转换成json */
function tojson_encode($val_arr, $is_obj = false) {
	if (is_array ( $val_arr )) {
		$json_arr = array ();
		foreach ( $val_arr as $key => $val ) {
			$json_arr [$key] = $val;
		}
		unset ( $val_arr );
		$json_data = json_encode ( $json_arr, $is_obj );
	} else {
		$json_data = $val_arr;
	}
	return $json_data;
}
/* json转换成数组 */
function tojson_decode($val_arr, $is_obj = false) {
	if ($val_arr != NULL && ! empty ( $val_arr )) {
		$val_arr = json_decode ( $val_arr, $is_obj );
		if (is_object ( $val_arr ) || is_array ( $val_arr )) {
			$json_data = array ();
			foreach ( $val_arr as $key => $val ) {
				$json_data [$key] = $val;
			}
			unset ( $val_arr );
		} else {
			$json_data = $val_arr;
		}
	} else {
		$json_data = $val_arr;
	}
	return $json_data;
}
/* MD5加密 str=字符串,num=md5加密次数 */
function md5_str($str = NULL, $num = 1) {
	if (str_len ( $str ) < 1) {
		return $str;
	}
	if (check_nums ( $num ) < 1) {
		return $str;
	}
	$num --;
	$str = md5_str ( md5 ( $str ), $num );
	return $str;
}
/* 字符串64加密 */
function tostr_encode($val_str) {
	if ($val_str != NULL && ! empty ( $val_str )) {
		$val_str = base64_encode ( $val_str );
	}
	return $val_str;
}
/* 字符串64解密 */
function tostr_decode($val_str) {
	if ($val_str != NULL && ! empty ( $val_str )) {
		$val_str = base64_decode ( $val_str );
	}
	return $val_str;
}
/* 数据序列成字符 */
function en_serialize($val = NULL) {
	if (check_is_array ( $val ) == 1) {
		$val = serialize ( $val );
	} else {
		$val = NULL;
	}
	return $val;
}
/* 解析数组序列字符 */
function de_serialize($val = NULL) {
	if (is_array ( $val )) {
		return $val;
	}
	if (strlen ( $val ) >= 1) {
		$val = unserialize ( $val );
	} else {
		$val = NULL;
	}
	return $val;
}
/* url参数加密 */
function str_urlencode($val = NULL) {
	if (strlen ( $val ) < 1) {
		return $val;
	}
	$val = urlencode ( tostr_encode ( $val ) );
	return $val;
}
/* url参数解密 */
function str_urldecode($val = NULL) {
	if (strlen ( $val ) < 1) {
		return $val;
	}
	$val = urldecode ( tostr_decode ( $val ) );
	return $val;
}
/* 清除前后空格并对字符addslashes */
function trim_addslashes($str = NULL) {
	if (empty ( $str )) {
		return $str;
	}
	$str = trim ( addslashes ( $str ) );
	return $str;
}
/* 还原由addslashes处理的字符 */
function str_stripslashes($str = NULL) {
	if (empty ( $str )) {
		return $str;
	}
	$str = stripslashes ( $str );
	return $str;
}
/* 转义一个数组中的符号 */
function array_addslashes($arr) {
	if (check_is_array ( $arr ) < 1) {
		if (is_array ( $arr )) {
			return $arr;
		} else {
			return trim_addslashes ( $arr );
		}
	} else {
		foreach ( $arr as $k => $v ) {
			$arr [$k] = array_addslashes ( $v );
		}
	}
	return $arr;
}
/* 还原一个数组中的符号转义 */
function array_stripslashes($arr) {
	if (check_is_array ( $arr ) < 1) {
		if (is_array ( $arr )) {
			return $arr;
		} else {
			return str_stripslashes ( $arr );
		}
	} else {
		foreach ( $arr as $k => $v ) {
			$arr [$k] = array_stripslashes ( $v );
		}
	}
	return $arr;
}
/* 检查是否为数组 */
function check_is_array($val = NULL) {
	if (empty ( $val )) {
		return 0;
	}
	if (is_array ( $val ) != true) {
		return 0;
	}
	return 1;
}
/* 检查数组键值 */
function check_is_key($_key, $arr) {
	/* 允许的键值类型 */
	$keyTypeArr = array (
			'integer',
			'float',
			'string',
			'double' 
	);
	/* 键值类型 */
	$kt = gettype ( $_key );
	if (! in_array ( $kt, $keyTypeArr )) {
		return 0;
	}
	if (check_is_array ( $arr ) < 1) {
		return 0;
	}
	if (! array_key_exists ( $_key, $arr )) {
		return 0;
	}
	return 1;
}
/* 翻转数组 */
function array_flip_val($arr) {
	if (check_is_array ( $arr ) < 1) {
		return 0;
	}
	$arr = array_flip ( $arr );
	return $arr;
}
/* 判断字符是否在数组中存在 */
function str_in_array($str, $arr) {
	if (str_len ( $str ) < 1) {
		return 0;
	}
	if (check_is_array ( $arr ) < 1) {
		return 0;
	}
	if (! in_array ( $str, $arr )) {
		return 0;
	}
	return 1;
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
function my_array_key($key, $arr) {
	if (! my_is_array ( $arr )) {
		return false;
	}
	if (! array_key_exists ( $key, $arr )) {
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
function my_join($delimiter, $arr, $def = NULL) {
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
function my_array_value($key, $arr, $def = NULL) {
	if (! my_array_key ( $key, $arr )) {
		return $def;
	}
	return $arr [$key];
}
/* 获取数组值_转为索引形式 */
function get_array_value($arr) {
	if (check_is_array ( $arr ) < 1) {
		return NULL;
	}
	$arr_val = array_values ( $arr );
	unset ( $arr );
	return $arr_val;
}
/* 获取数组键_转为索引形式 */
function get_array_key($arr) {
	if (check_is_array ( $arr ) < 1) {
		return NULL;
	}
	$arr_val = array_keys ( $arr );
	unset ( $arr );
	return $arr_val;
}
/* 把数组转为字符并和字符连接 */
function array_join_str($str, $arr, $defaultval = NULL) {
	if (str_len ( $str ) < 1) {
		$str = '';
	}
	if (check_is_array ( $arr ) < 1) {
		return $defaultval;
	}
	$str = join ( $str, $arr );
	return $str;
}
/* 获取数组值(a/b,如同$a['a']['b']) */
function array_key_val($arrKey, $arrData, $defaultVal = NULL) {
	if (! is_array ( $arrKey )) {
		if (strlen ( $arrKey ) < 1) {
			return $defaultVal;
		}
		if (strpos ( $arrKey, '/' ) >= 1) {
			$arrKey = explode ( '/', $arrKey );
		}
	}
	if (is_array ( $arrKey )) {
		$value = NULL;
		$index = 0;
		foreach ( $arrKey as $keyName ) {
			$index ++;
			if ($index == 1) {
				$value = array_key_val ( $keyName, $arrData, $defaultVal );
			} else {
				$value = array_key_val ( $keyName, $value, $defaultVal );
			}
		}
	} else {
		if (is_array ( $arrKey )) {
			return $defaultVal;
		}
		if (strlen ( $arrKey ) < 1) {
			return $defaultVal;
		}
		if (! is_array ( $arrData )) {
			return $defaultVal;
		}
		if (! array_key_exists ( $arrKey, $arrData )) {
			return $defaultVal;
		}
		$value = $arrData [$arrKey];
	}
	return $value;
}
/* 统计数组量 */
function array_number($arr) {
	if (check_is_array ( $arr ) < 1) {
		return 0;
	}
	$n = count ( $arr );
	$n = (check_nums ( $n ) < 1) ? 0 : $n;
	return $n;
}
/* 可视化数组还原 */
function strforarray($data) {
	if (strlen ( $data ) < 1) {
		return NULL;
	}
	eval ( '$arr=' . $data . ';' );
	return $arr;
}
/* 转换数据为可视化 */
function arraytostr($data) {
	if (check_is_array ( $data ) == 1) {
		$i = 0;
		$str = 'array(';
		foreach ( $data as $key => $val ) {
			$i ++;
			if ($i > 1) {
				$str .= ',';
			}
			if (check_is_array ( $val ) == 1) {
				$str .= "'{$key}'=>" . arraytostr ( $val );
			} else {
				if (strpos ( $val, '$' ) === 0) {
					$str .= "'{$key}'=>" . $val;
				} else {
					$str .= "'{$key}'=>'" . trim_addslashes ( $val ) . "'";
				}
			}
		}
		return $str . ')';
	}
	return '\'\'';
}
/* 数组转为json格式 */
function arraytojson($array) {
	if (check_is_array ( $array ) < 1) {
		return false;
	}
	$associative = array_number ( array_diff ( array_keys ( $array ), array_keys ( array_keys ( $array ) ) ) );
	if ($associative >= 1) {
		$construct = array ();
		foreach ( $array as $key => $value ) {
			if (is_numeric ( $key )) {
				$key = "key_{$key}";
			}
			$key = "'" . trim_addslashes ( $key ) . "'";
			if (check_is_array ( $value ) == 1) {
				$value = arraytojson ( $value );
			} else if (! is_numeric ( $value ) || is_string ( $value )) {
				$value = "'" . trim_addslashes ( $value ) . "'";
			}
			$construct [] = "{$key}: {$value}";
		}
		$result = '{ ' . implode ( ',', $construct ) . ' }';
	} else {
		$construct = array ();
		foreach ( $array as $value ) {
			if (check_is_array ( $value ) == 1) {
				$value = arraytojson ( $value );
			} else if (! is_numeric ( $value ) || is_string ( $value )) {
				$value = "'" . trim_addslashes ( $value ) . "'";
			}
			$construct [] = $value;
		}
		$result = '[' . implode ( ',', $construct ) . ']';
	}
	return $result;
}

/* 获取数组最后一个值 */
function get_array_end($arr, $d = NULL) {
	if (check_is_array ( $arr ) < 1) {
		return $d;
	}
	$val = end ( $arr );
	unset ( $arr );
	return $val;
}
/* 取出字段数据 */
function dedata_field_str($data_arr, $field_str) {
	$data_arr = $data_arr [$field_str];
	$data_arr = tojson_decode ( tostr_decode ( $data_arr ) );
	return $data_arr;
}
/* 取出字段数据 */
function dedata_field_arr($data_arr, $field_str) {
	$data_arr = $data_arr [$field_str];
	$data_arr = tojson_decode ( $data_arr );
	return $data_arr;
}
/* 定义文件路径由字母数字下划线组成 */
function allow_folder($folder_str = NULL) {
	$arr = letter_check_str2 ();
	$arr = explode ( ',', $arr );
	$folder_str_len = str_len ( $folder_str );
	for($i = 0; $i < $folder_str_len; $i ++) {
		$index_str = sub_str ( $folder_str, $i, 1 );
		if (! in_array ( $index_str, $arr )) {
			return 0;
		}
	}
	return 1;
}
/* 检查一个字符,在指定字符里存在 */
function str_in_exist($str = NULL, $str_arr = NULL, $explode_sign = ',') {
	$str_arr = explode ( $explode_sign, $str_arr );
	if (! in_array ( $str, $str_arr )) {
		unset ( $str_arr );
		return 0;
	}
	unset ( $str_arr );
	return 1;
}
/* 定义水印文本字体颜色 */
function watermark_fontcolor($type_str = NULL) {
	/* 是否已#号开头 */
	$pre_str = sub_str ( $type_str, 0, 1 );
	if ($pre_str != '#') {
		return 0;
	}
	/* 取出#号除外的字符 */
	$sub_str = sub_str ( $type_str, 1 );
	$sub_str_len = str_len ( $sub_str );
	/* 允许的字母数字 */
	$arr = check_str3 ();
	$arr = explode ( ',', $arr );
	for($i = 0; $i < $sub_str_len; $i ++) {
		$sub_str_index = sub_str ( $sub_str, $i, 1 );
		if (! in_array ( $sub_str_index, $arr )) {
			return 0;
		}
	}
	return 1;
}
/* 检查类是否存在 */
function check_is_class($cla) {
	if (check_enl_el ( $cla, 1, 50 ) < 1) {
		return 0;
	}
	if (class_exists ( $cla ) != true) {
		return 0;
	}
	return 1;
}
/* 检查类函数是否存在2 */
function class_is_fun($getclass, $func) {
	if (check_enl_el ( $func, 1, 50 ) < 1) {
		return 0;
	}
	if (method_exists ( $getclass, $func ) != true) {
		return 0;
	}
	return 1;
}
/* 检查函数是否存在 */
function check_is_fun($fun) {
	if (check_enl_el ( $fun, 1, 50 ) < 1) {
		return 0;
	}
	if (function_exists ( $fun ) != true) {
		return 0;
	}
	return 1;
}
/* 将十六进制颜色转为rgb */
function hexcolor_rgb($hexcolor) {
	$color = str_replace ( '#', '', $hexcolor );
	if (strlen ( $color ) > 3) {
		$rgb = array (
				'r' => hexdec ( substr ( $color, 0, 2 ) ),
				'g' => hexdec ( substr ( $color, 2, 2 ) ),
				'b' => hexdec ( substr ( $color, 4, 2 ) ) 
		);
	} else {
		$color = str_replace ( '#', '', $hexcolor );
		$r = substr ( $color, 0, 1 ) . substr ( $color, 0, 1 );
		$g = substr ( $color, 1, 1 ) . substr ( $color, 1, 1 );
		$b = substr ( $color, 2, 1 ) . substr ( $color, 2, 1 );
		$rgb = array (
				'r' => hexdec ( $r ),
				'g' => hexdec ( $g ),
				'b' => hexdec ( $b ) 
		);
	}
	return $rgb;
}
/* 解析文件扩展名以(*.扩展名)形式 */
function de_file_ext_as($arr) {
	$val = NULL;
	if (check_is_array ( $arr ) == 1) {
		foreach ( $arr as $v ) {
			$val .= ($val != NULL) ? (';' . '*.' . $v) : ('*.' . $v);
		}
	}
	return $val;
}
/* 获取一个文件扩展名格式 */
function get_file_ext($str, $is_tolower = false) {
	if (str_len ( $str ) < 1) {
		return $str;
	}
	$arr = explode ( '.', $str );
	if (array_number ( $arr ) < 2) {
		return NULL;
	}
	$ext = end ( $arr );
	$ext = ($is_tolower == true) ? (strtolower ( $ext )) : $ext;
	unset ( $arr );
	return $ext;
}
/* 获取一个文件名 */
function get_file_name($str) {
	if (str_len ( $str ) < 1) {
		return $str;
	}
	$arr = explode ( '.', $str );
	$len = array_number ( $arr );
	if ($len < 2) {
		return NULL;
	}
	unset ( $arr [($len - 1)] );
	$arr = join ( '.', $arr );
	return $arr;
}
/* 获取图片尺寸 */
function image_size($file_name) {
	$arr = NULL;
	if (check_is_file ( $file_name ) == 1) {
		$arr = getimagesize ( $file_name );
		if (check_is_array ( $arr ) < 1) {
			$arr = array (
					0,
					0 
			);
		}
	}
	return $arr;
}
/* 计算缩略图尺寸 */
function imagenewseize($imgsrc, $img_w, $img_h = NULL) {
	/* 获取原图尺寸 */
	$srcsize = image_size ( $imgsrc );
	if (check_is_array ( $srcsize ) < 1) {
		return array (
				0,
				0 
		);
	}
	/* 宽高为0时获取原图尺寸 */
	if ($img_w < 1) {
		$img_w = $srcsize [0];
	}
	if ($img_h < 1) {
		$img_h = $srcsize [1];
	}
	/* 计算尺寸 */
	$fill_w = ( int ) $img_w;
	$fill_h = ( int ) $img_h;
	$rate_w = $srcsize [0] / $fill_w;
	$rate_h = $srcsize [1] / $fill_h;
	/* 源图大于缩略图,将缩小,则不缩小 */
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
/* 获取文件大小 */
function get_filesize($file_name) {
	$size = 0;
	if (check_is_file ( $file_name ) == 1) {
		$size = filesize ( $file_name );
	}
	return $size;
}
/* 显示文件大小 */
function show_filesize($filename) {
	$filesize = get_filesize ( $filename );
	$str = format_file_size ( $filesize );
	return $str;
}
/* 文件查找 */
function serachfile($filename) {
	$filename = trim ( $filename );
	if (str_len ( $filename ) < 1) {
		return NULL;
	}
	if ($filename == '*') {
		return NULL;
	}
	$arr = glob ( $filename );
	return $arr;
}
/*
 * 删除匹配的文件,并排除被匹配 * searachfile=匹配字符(a.txt*) * isclearsearch=是否排除匹配项(ture=是,false=不)如果为true则排除a.txt字符的文件,则一并删除
 */
function serachfile_del($searchfile, $isclearsearch = true) {
	$searchfile = trim ( $searchfile );
	if (str_len ( $searchfile ) < 1) {
		return NULL;
	}
	/* 查找 */
	$searcharr = serachfile ( $searchfile );
	if (check_is_array ( $searcharr ) == 1) {
		/* 排除匹配 */
		foreach ( $searcharr as $f ) {
			$f = trim ( $f );
			if ($isclearsearch === true) {
				if (str_replace ( '*', '', get_fs ( $searchfile ) ) == get_fs ( $f )) {
					continue;
				}
			}
			delf ( $f );
		}
	}
}
/* 获取定义文件字符 */
function get_fs($file_name = NULL, $is_dir = false) {
	$file_name = explode ( '/', $file_name );
	$file_str = trim ( end ( $file_name ) );
	if ($is_dir == true) {
		unset ( $file_name [count ( $file_name ) - 1] );
		$g = _g ();
		$dir_name = array_join_str ( $g ['app'] ['ds'], $file_name );
		$file_str = array (
				'dir_name' => $dir_name,
				'file_name' => $file_str 
		);
	}
	unset ( $file_name );
	return $file_str;
}
/* 清除文件不需要的 */
function clearfilestr($str) {
	if (str_len ( $str ) < 1) {
		return NULL;
	}
	$str = str_replace ( '\\', '/', $str );
	$str = str_replace ( '///', '/', $str );
	$str = str_replace ( '//', '/', $str );
	return $str;
}
/* 删除文件 */
function delf($file_name) {
	$file_name = clearfilestr ( $file_name );
	if (check_is_file ( $file_name ) < 1) {
		return 0;
	}
	if (! unlink ( $file_name )) {
		return - 1;
	}
	return 1;
}
/* 删除目录 */
function deld($dir_name) {
	$dir_name = clearfilestr ( $dir_name );
	if (check_is_dir ( $dir_name ) < 1) {
		return 0;
	}
	if (! chmod ( $dir_name, 0777 )) {
		return - 1;
	}
	/* 删除当前文件夹 */
	if (! rmdir ( $dir_name )) {
		return - 1;
	}
	return 1;
}
/* 检查文件是否存在 */
function check_is_file($file_name) {
	$s = 0;
	if (str_len ( $file_name ) < 1) {
		return $s;
	}
	$file_name = clearfilestr ( $file_name );
	if (is_file ( $file_name )) {
		$s = 1;
	}
	return $s;
}
/* 检查目录是否存在 */
function check_is_dir($file_name) {
	if (str_len ( $file_name ) < 1) {
		return 0;
	}
	$file_name = clearfilestr ( $file_name );
	if (! is_dir ( $file_name )) {
		return 0;
	}
	return 1;
}
/* 检查目录是否为空 */
function check_null_dir($dir_str, $is_del = false) {
	if (check_is_dir ( $dir_str ) < 1) {
		return 0;
	}
	/* 是否有文件 */
	$count_num = 0;
	$dir_scan = opendir ( $dir_str );
	while ( $file_arr = readdir ( $dir_scan ) ) {
		if ($file_arr == '.' || $file_arr == '..') {
			continue;
		}
		$count_num ++;
		if ($count_num == 1) {
			break;
		}
	}
	closedir ( $dir_scan );
	if ($is_del == true) {
		if ($count_num == 0) {
			// $val=delete_dir($dir_str,true);
		} else {
			$val = 1;
		}
	} else {
		$val = 1;
	}
	return $val;
}
/* 创建文件要保存的文件夹 */
function create_dir($dir_root, $dir_name) {
	if (str_len ( $dir_root ) < 1) {
		return 0;
	}
	if (str_len ( $dir_name ) < 1) {
		return 0;
	}
	$dir_root = clearfilestr ( $dir_root );
	if (check_is_dir ( $dir_root ) < 1) {
		return 0;
	}
	if (! chmod ( $dir_root, 0777 )) {
		return - 1;
	}
	$dir_name = clearfilestr ( $dir_name );
	$dir_arr = explode ( '/', $dir_name );
	$temp_arr = NULL;
	$temp_name = NULL;
	for($i = 0; $i < count ( $dir_arr ); $i ++) {
		$temp_arr .= '/' . $dir_arr [$i];
		$temp_name = $dir_root . $temp_arr;
		$temp_name = clearfilestr ( $temp_name );
		if (check_is_dir ( $temp_name ) < 1) {
			$oldmask = umask ( 0 );
			if (! mkdir ( $temp_name, 0777 )) {
				return - 1;
			}
			umask ( $oldmask );
		}
	}
	return 1;
}
/* 删除指定目录及目录下的所有文件 */
function delete_dir($dir_root, $dir_name, $isDelDirName = true) {
	$dir_root = trim ( $dir_root );
	$dir_name = trim ( $dir_name );
	if (strlen ( $dir_root ) < 1) {
		return 0;
	}
	if (strlen ( $dir_name ) < 1) {
		return 0;
	}
	/* 检查根目录是否存在 */
	$dir_root = clearfilestr ( $dir_root );
	if (check_is_dir ( $dir_root ) < 1) {
		return 0;
	}
	/* 检查指定目录是否存在 */
	$dir_root = clearfilestr ( $dir_root . '/' . $dir_name );
	if (check_is_dir ( $dir_root ) < 1) {
		return 0;
	}
	if (! chmod ( $dir_root, 0777 )) {
		return - 1;
	}
	/* 清空目录下的文件 */
	$dh = opendir ( $dir_root );
	while ( $file = readdir ( $dh ) ) {
		if ($file == '.' || $file == '..') {
			continue;
		}
		$fullpath = $dir_root . '/' . $file;
		if (check_is_dir ( $fullpath ) < 1) {
			if (delf ( $fullpath ) == - 1) {
				return - 1;
			}
		} else {
			if (delete_dir ( $dir_root, $file ) == - 1) {
				return - 1;
			}
		}
	}
	closedir ( $dh );
	/* 删除文件夹 */
	if (is_bool ( $isDelDirName ) && $isDelDirName == true) {
		if (! rmdir ( $dir_root )) {
			return - 1;
		}
	}
	return 1;
}
/* 获取POST表单值的转换 */
function form_post() {
	$val_arr = NULL;
	if (isset ( $_POST )) {
		$val_arr = array ();
		foreach ( $_POST as $key => $val ) {
			$val_arr [$key] = urldecode ( $val );
		}
	}
	return $val_arr;
}
/* 获取GET表单值的转换 */
function form_get() {
	$val_arr = NULL;
	if (isset ( $_GET )) {
		$val_arr = array ();
		foreach ( $_GET as $key => $val ) {
			$val_arr [$key] = urldecode ( $val );
		}
	}
	return $val_arr;
}
/* 获取GET表单值的转换 */
function get_val($_key = NULL, $is_val = NULL) {
	if (isset ( $_GET [$_key] )) {
		$param_val = trim ( $_GET [$_key] );
	} else {
		$param_val = $is_val;
	}
	return $param_val;
}
/* 获取GET传值页码 */
function get_page($_key = 'page', $default_page = 1) {
	if (isset ( $_GET [$_key] )) {
		$page = trim_addslashes ( $_GET [$_key] );
		if (str_len ( $page ) < 1) {
			$page = $default_page;
		}
		if (check_nums ( $page ) < 1) {
			$page = $default_page;
		}
	} else {
		$page = $default_page;
	}
	return $page;
}
/* 获取GET参数必须为大于0的整数 */
function get_int_param($_key = NULL, $is_val = NULL) {
	if (isset ( $_GET [$_key] )) {
		$param_val = trim_addslashes ( $_GET [$_key] );
		if (str_len ( $param_val ) < 1) {
			$param_val = $is_val;
		}
		if (check_nums ( $param_val ) < 1) {
			$param_val = $is_val;
		}
	} else {
		$param_val = $is_val;
	}
	return $param_val;
}
/* 获取GET参数 */
function get_param($_key = NULL, $is_val = NULL) {
	if (isset ( $_GET [$_key] )) {
		$param_val = trim_addslashes ( $_GET [$_key] );
		if (str_len ( $param_val ) < 1) {
			$param_val = $is_val;
		}
	} else {
		$param_val = $is_val;
	}
	return $param_val;
}
/* 去除GET值 */
function get_param_del($_key) {
	if (check_is_array ( $_key ) == 1) {
		foreach ( $_key as $k ) {
			/* 不允许二维数及以上组 */
			if (check_is_array ( $k ) == 1) {
				return NULL;
			}
			post_param_del ( $k );
		}
	} else {
		if (check_is_key ( $_key, $_GET ) == 1) {
			unset ( $_GET [$_key] );
		}
	}
}
/* 去除POST值 */
function post_param_del($_key) {
	if (check_is_array ( $_key ) == 1) {
		foreach ( $_key as $k ) {
			/* 不允许二维数及以上组 */
			if (check_is_array ( $k ) == 1) {
				return NULL;
			}
			post_param_del ( $k );
		}
	} else {
		if (check_is_key ( $_key, $_POST ) == 1) {
			unset ( $_POST [$_key] );
		}
	}
}
/* 获取POST值 */
function post_val($_key = NULL, $is_val = NULL) {
	if (isset ( $_POST [$_key] )) {
		$val = $_POST [$_key];
	} else {
		$val = $is_val;
	}
	return $val;
}
/* 获取POST传值页码 */
function post_page($_key = 'page', $default_page = 1) {
	if (isset ( $_POST [$_key] )) {
		$page = trim_addslashes ( $_POST [$_key] );
		if (str_len ( $page ) < 1) {
			$page = $default_page;
		}
		if (check_nums ( $page ) < 1) {
			$page = $default_page;
		}
	} else {
		$page = $default_page;
	}
	return $page;
}
/* 获取POST参数必须为大于0的整数 */
function post_int_param($_key = NULL, $is_val = NULL) {
	if (isset ( $_POST [$_key] )) {
		$param_val = trim_addslashes ( $_POST [$_key] );
		if (str_len ( $param_val ) < 1) {
			$param_val = $is_val;
		}
		if (check_nums ( $param_val ) < 1) {
			$param_val = $is_val;
		}
	} else {
		$param_val = $is_val;
	}
	return $param_val;
}
/* 获取POST参数 */
function post_param($_key = NULL, $is_val = NULL) {
	if (isset ( $_POST [$_key] )) {
		$param_val = trim_addslashes ( $_POST [$_key] );
	} else {
		$param_val = $is_val;
	}
	return $param_val;
}
/* 获取POST数组参数 */
function post_array_param($_key = NULL, $is_val = NULL) {
	if (isset ( $_POST [$_key] )) {
		$param_val = $_POST [$_key];
		if (check_is_array ( $param_val ) < 1) {
			$param_val = $is_val;
		}
	} else {
		$param_val = $is_val;
	}
	return $param_val;
}
/* 检查整数并返回设置值 */
function getchecknum($checkVal, $returnVal, $numType = 0) {
	$setVal = $checkVal;
	if ($numType != 1) {
		if (check_num ( $checkVal ) < 1) {
			$setVal = $returnVal;
		}
	} else {
		if (check_nums ( $checkVal ) < 1) {
			$setVal = $returnVal;
		}
	}
	return $setVal;
}
/* 时间转为时间戳 */
function str_strtotime($str) {
	global $_G;
	$defaultVal = $_G ['app'] ['sys_time'];
	if (str_len ( $str ) < 1) {
		return $defaultVal;
	}
	/* 转为时间戳 */
	$str = strtotime ( $str );
	/* 如果非法则返回默认值 */
	if (check_nums ( $str ) < 1) {
		$str = $defaultVal;
	}
	return $str;
}
/* 时间戳转为时间 */
function str_todate($date_str, $time_str) {
	global $_G;
	if ((str_len ( $date_str ) < 1) || (check_nums ( $time_str ) < 1)) {
		$dstr = datestyle ( $_G ['app'] ['sys_time'], 'Y-m-d' );
		return $dstr;
	}
	$str = date ( $date_str, $time_str );
	return $str;
}
/* 一个时间段转为秒钟 */
function tosecond($numVal, $type = 'm') {
	/* 初始化返回值 */
	$returnVal = 0;
	if (check_nums ( $numVal ) < 1) {
		return $returnVal;
	}
	switch ($type) {
		/* 以天数 */
		case 'd' :
			$returnVal = op2num ( $numVal, (24 * 60 * 60), 3 );
			break;
		/* 以小时 */
		case 'h' :
			$returnVal = op2num ( $numVal, (60 * 60), 3 );
			break;
		/* 以分钟 */
		case 'm' :
			$returnVal = op2num ( $numVal, 60, 3 );
			break;
	}
	return $returnVal;
}
/* 计算过期时间 */
function is_expire($startTime, $setExpire) {
	if (check_nums ( $startTime ) < 1) {
		return false;
	}
	global $_G;
	$expire = intval ( $_G ['app'] ['sys_time'] ) - intval ( $startTime );
	if ($expire > $setExpire) {
		return true;
	}
	return false;
}
/* 获取当前时间年月日,转为时间戳 */
function timetoallday($time = NULL) {
	if (check_nums ( $time ) < 1) {
		global $_G;
		$time = $_G ['app'] ['sys_time'];
	}
	$timeFormat = date ( 'Y-m-d', $time );
	$newTime = intval ( strtotime ( $timeFormat ) );
	return $newTime;
}
/* 字符串加密2 */
function en_b_str($val = NULL) {
	$str = getrand ( 6, 3 );
	$str = tostr_encode ( $str . $val );
	return $str;
}
/* 字符串解密2 */
function de_b_str($val = NULL) {
	$val = tostr_decode ( $val );
	$val = sub_str ( $val, 6 );
	return $val;
}
/* 载入标签 */
function hook_template_tag($module, $name) {
	global $_G;
	if (! check_module ( $module )) {
		return false;
	}
	$filepath = $_G ['app'] ['path_source'] . 'module/' . $module . '/tag/tag_' . $module . '_' . $name . $_G ['app'] ['ext_php'];
	$filepath = clearfilestr ( $filepath );
	if (! is_file ( $filepath )) {
		return false;
	}
	include $filepath;
	return true;
}
/* loadfile=文件类型,module=模块,isclass=是否为类,instance=是否new,param=类参数,isreturn=是否返回值 */
function loader($loadfile = NULL, $module = NULL, $isclass = false, $instance = false, $param = NULL, $isreturn = true) {
	global $_G;
	/* 返回值 */
	$returnValue = NULL;
	$module = trim ( $module );
	/* 检查模块是否存在 */
	if (! empty ( $module )) {
		$module = get_module ( $module, 'module' );
		if (empty ( $module )) {
			return NULL;
		}
	}
	/* 解析加载的类型 */
	$loadArr = explode ( ':', $loadfile );
	$loadLen = count ( $loadArr );
	/* 取出要加载的文件名 */
	$loadName = $loadArr [$loadLen - 1];
	unset ( $loadArr [$loadLen - 1] );
	/* 文件扩展名 */
	$ext = $_G ['app'] ['ext_php'];
	/* 当模块存在时 */
	if (! empty ( $module )) {
		$filePath = 'module/' . $module . '/';
	}
	if (is_array ( $loadArr )) {
		foreach ( $loadArr as $v ) {
			$filePath .= $v . '/';
		}
	}
	$fileNamePath = $filePath . $loadName . $ext;
	$allFileNamePath = $_G ['app'] ['path_source'] . $fileNamePath;
	/* 是否为类 */
	if ($isclass == true) {
		if (check_is_class ( $loadName ) < 1) {
			if (! is_file ( $allFileNamePath )) {
				echo lang ( 'global:file_not_exist', $_G ['web'] ['sourcepath'] . $fileNamePath );
				exit ();
			}
			include $allFileNamePath;
		}
		if (check_is_class ( $loadName ) < 1) {
			echo lang ( 'global:class_not_defined', $loadName );
			exit ();
		}
		/* 实例化 */
		if ($instance == true) {
			$instances = ($param != NULL) ? new $loadName ( $param ) : new $loadName ();
			if ($isreturn == true) {
				$returnValue = $instances;
			}
		}
	} else {
		if (! is_file ( $allFileNamePath )) {
			lang ( 'global:file_not_exist', $_G ['web'] ['sourcepath'] . $fileNamePath );
			exit ();
		}
		if ($isreturn == true) {
			$returnValue = include $allFileNamePath;
		}
	}
	return $returnValue;
}
/* 检查一个变量是否为boolean值 */
function _isbool($val) {
	if (empty ( $val )) {
		return false;
	}
	if (is_bool ( $val )) {
		return $val;
	} else if (is_string ( $val )) {
		$str = strtolower ( trim ( $val ) );
		switch ($str) {
			case 'true' :
				return true;
				break;
			case 'false' :
				return false;
				break;
			case '1' :
				return true;
				break;
			case '0' :
				return false;
				break;
			case 'on' :
				return true;
				break;
			case 'off' :
				return false;
				break;
			case 'yes' :
				return true;
				break;
			case 'no' :
				return false;
				break;
			case 'y' :
				return true;
				break;
			case 'n' :
				return false;
				break;
			case 'null' :
				return false;
				break;
			default :
				return false;
				break;
		}
	} else if (is_numeric ( $val )) {
		$str = trim ( $val );
		if ($val == 1) {
			return true;
		} else {
			return false;
		}
	} else {
		return false;
	}
}
?>