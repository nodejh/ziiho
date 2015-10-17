<?php
if (! defined ( 'APP_PATH' )) {
	exit ( 'no direct access allowed' );
}

/* 返回操作状态类型 */
function dostatus($type = NULL) {
	global $_G;
	$strVal = NULL;
	switch ($type) {
		case 's' :
			$strVal = $_G ['dns'] ['db_zq'];
			break;
		case 'e' :
			$strVal = $_G ['dns'] ['db_cw'];
			break;
	}
	return $strVal;
}
/* 操作信息标签 */
function ajaxactioncallback($str) {
	$str = '{ajaxactioncallback}' . $str . '{/ajaxactioncallback}';
	return $str;
}
/* 显示信息 */
function showmsg($data = NULL, $url = NULL, $callFunc = NULL, $msg_array = NULL) {
	$msg_arr = array (
			'data' => $data,
			'url' => $url,
			'callFunc' => $callFunc 
	);
	/* 附加参数 */
	if (check_is_array ( $msg_array ) == 1) {
		$msg_arr = array_merge ( $msg_arr, $msg_array );
	}
	if (msg_param ( 'isajax' ) == 1 || post_param ( 'isajax' ) == 1) {
		/* echo ajaxactioncallback(arraytojson($msg_arr)); */
		echo ajaxactioncallback ( json_encode ( $msg_arr ) );
	} else {
		global $_G;
		if (empty ( $url )) {
			$msg_arr ['url'] = get_index ();
		}
		/* 获取模板名 */
		$msg_tpl_name = array_key_val ( 'msg_tpl', $msg_arr, 'msgtell' );
		/* 模板信息 */
		$msg_file = array_key_val ( 'path_source', $_G ['app'] ) . 'module/common/template/' . $msg_tpl_name . '.php';
		if (check_is_file ( $msg_file ) == 1) {
			include $msg_file;
		} else {
			echo $data;
		}
	}
	exit ();
}
/* 信息回调类型 */
function msg_call_way() {
	/* 删除回调msg_call函数 */
	msg_func ();
	/* 回调函数 */
	$call_fun = msg_callback_func ();
	/* 回调参数 */
	$param = msg_callback_param ();
	if ($call_fun !== NULL) {
		showmsg ( lang ( 'member:member_no_access' ), NULL, $call_fun, $param );
	} else {
		showmsg ( lang ( 'member:member_no_access' ), get_index () );
	}
}
/* 获取回调js信息参数名 */
function msg_callback_param_name() {
	$str = 'callback_param';
	return $str;
}
/* 获取回调js信息参数 */
function msg_param($_key = 'url') {
	$val = msg_callback_func ( $_key, false );
	return $val;
}
/* 获取回调js信息参数值 */
function msg_func($_key = 'callFunc') {
	$val = msg_callback_func ( $_key, true );
	return $val;
}
/* 获取回调js信息参数 */
function msg_callback_param() {
	$param = post_array_param ( msg_callback_param_name () );
	return $param;
}
/* 获取回调js信息 */
function msg_callback_func($_key = 'callback_func', $is_func = true) {
	$val = NULL;
	$func = 'post_array_param';
	if (check_is_fun ( $func ) < 1) {
		return $val;
	}
	$param_key = msg_callback_param_name ();
	$postarr = $func ( $param_key );
	$call_fun = array_key_val ( $_key, $postarr, false );
	/* 是否参数,则为js函数 */
	if ($is_func !== false) {
		return $call_fun;
	}
	return $call_fun;
}
/* 日期时间格式样式 */
function datestyle($date_time = NULL, $style_str = NULL, $is_person = 0, $space_num = 0) {
	$date_time = trim ( $date_time );
	$style_str = trim ( $style_str );
	$is_person = trim ( $is_person );
	$space_num = trim ( $space_num );
	/* 时间戳格式 */
	if (check_nums ( $date_time ) < 1) {
		global $_G;
		$date_time = $_G ['app'] ['sys_time'];
	}
	/* 输出时间格式 */
	if (empty ( $style_str )) {
		$style_str = 'Y-m-d H:i:s';
	}
	/* 是否人性化 */
	if (check_nums ( $is_person ) < 1 || check_nums ( $space_num ) < 1) {
		$dstr = date ( $style_str, $date_time );
	} else {
		$dstr = person_time ( $date_time, 0, $style_str, $space_num );
	}
	return $dstr;
}
/* 获取语言 */
function lang($typestr, $param = NULL) {
	$strVal = $typestr;
	if (preg_match ( "/^([a-z0-9_]+)\:([a-z0-9_]+)$/i", $typestr, $matchs )) {
		global $_G;
		$moduleStr = array_key_val ( 1, $matchs );
		$langStr = array_key_val ( 2, $matchs );
		/* 设置路径 */
		$path = $_G ['app'] ['path_source'];
		/* 默认为全局 */
		if ($moduleStr == 'global') {
			$filepath = $path . 'lang/lang_' . $moduleStr . '.php';
		} else {
			/* 含下划线的规则 */
			$ofmodule = explode ( '_', $moduleStr );
			if (count ( $ofmodule ) == 1) {
				$filepath .= $path . 'module/' . $moduleStr . '/lang/lang_' . $moduleStr . '.php';
			} else {
				$filepath = $path . 'module/' . $ofmodule [0] . '/lang/lang_' . $moduleStr . '.php';
			}
		}
		if (check_is_file ( $filepath ) == 1) {
			$arr = include $filepath;
			$strVal = array_key_val ( $langStr, $arr, $langStr );
		}
		/* 解析需要替换的变量 */
		if (! empty ( $param ) && gettype ( $param ) != 'boolean') {
			if (! is_array ( $param ))
				$param = array (
						$param 
				);
			$strVal = vsprintf ( $strVal, $param );
		}
	}
	return $strVal;
}
/* 载入datacall数据调用文件 */
function datacallfile($file = NULL) {
	global $_G;
	$file_name = $_G ['app'] ['path_data'] . 'datacall' . $_G ['app'] ['ds'] . $file . '.php';
	if (is_file ( $file_name )) {
		$fc = 'return true; ?>' . file_get_contents ( $file_name );
		(@eval ( $fc ));
	}
}
/* 缩略图生成 */
function imagethumb($src_img, $dst_img, $w, $h, $img_quality = 90) {
	global $_G;
	$iObj = loader ( 'class:class_image', NULL, true, true );
	$iObj->img_display_quality = $img_quality;
	$iObj->srcimage ( $src_img );
	$iObj->dstimage ( $dst_img );
	$sv = $iObj->createimage ( $w, $h );
	return $sv;
}
/* 图剪切 */
function imagecut($img = NULL, $des_img = NULL, $xy = NULL, $wh = NULL, $display_quality = 90) {
	$arr = image_size ( $img );
	if ($arr [0] < 1) {
		return $img;
	}
	loader ( 'class:class_image', NULL, true );
	new imagecutwater ( $img, $des_img, 2, $xy, $wh, $display_quality );
}
/* 图水印 */
function imagewater($img = NULL, $des_img = NULL, $waterimg = NULL, $postion = NULL, $display_quality = 90, $merge_quality = 90, $ox = 0, $oy = 0) {
	$arr = image_size ( $img );
	if ($arr [0] < 1) {
		return $img;
	}
	loader ( 'class:class_image', NULL, true );
	new imagecutwater ( $img, $des_img, 1, $waterimg, $postion, $display_quality, $merge_quality, $ox, $oy );
}
/* 文字水印 */
function textwater($img, $des_img = NULL, $ttf, $txt = NULL, $fontsize = NULL, $position = NULL, $fontcolor = NULL, $jiaodu = NULL, $display_quality = 90, $ox = 0, $oy = 0) {
	$arr = image_size ( $img );
	if ($arr [0] < 1) {
		return $img;
	}
	loader ( 'class:class_image', NULL, true );
	new imagetxtwater ( $img, $des_img, $ttf, $txt, $fontsize, $position, $fontcolor, $jiaodu, $display_quality, $ox, $oy );
}
/* 标签生成缩略图命名 */
function tagimagecreatename($src, $width, $height, $type) {
	/* 缩略图规则名 */
	$thumbrule = config_value_get ( 'uploadthumbrule', 'name', 'val' );
	/* 原图扩展名 */
	$ext = '.' . get_file_ext ( $src );
	/* 图名称 */
	$filename = $src . $thumbrule . $width . 'x' . $height . '=' . $type . $ext;
	return $filename;
}
/* 解析标签参数的数据排序 */
function de_db_orderby($str, $_default = NULL) {
	if (str_len ( $str ) < 1) {
		if (str_len ( $_default ) < 1) {
			return NULL;
		}
		$str = $_default;
	}
	$data = array ();
	$arr = explode_str ( $str, '/' );
	if (check_is_array ( $arr ) == 1) {
		foreach ( $arr as $d ) {
			$f = explode_str ( trim ( $d ), ',' );
			if (check_is_array ( $f ) < 1 && array_number ( $f ) < 2) {
				continue;
			}
			$_key = trim ( array_key_val ( 0, $f, 0 ) );
			$_val = trim ( array_key_val ( 1, $f, 0 ) );
			$data [$_key] = strtoupper ( $_val );
		}
	}
	return $data;
}
/* 解析标签参数的页码 */
function de_page_param($str = '', $_default = 1) {
	$dstr = 'get/page';
	if (str_len ( $str ) < 1) {
		$str = $dstr;
	}
	/* 解析 */
	$arr = explode_str ( $str, '/' );
	/* 获取方式和参数 */
	$type = array_key_val ( 0, $arr );
	$key = array_key_val ( 1, $arr );
	/* 是否合法 */
	if (check_enl_el ( $type ) < 1) {
		return $_default;
	}
	/* 检查是否定义 */
	$func = $type . '_page';
	if (check_is_fun ( $func ) < 1) {
		return $_default;
	}
	$val = $func ( $key, $_default );
	return $val;
}
/* 上传附件文件名组合 */
function show_uf($file_name, $is_url = false) {
	if (str_len ( $file_name ) < 1) {
		return $file_name;
	}
	global $_G;
	if ($is_url == true) {
		/* 本地路径 */
		$file_name = $_G ['app'] ['path_uploadfile'] . $file_name;
	} else {
		/* 网络地址 */
		$file_name = current_url ( 'uploadfile' . $_G ['app'] ['ds'] . $file_name );
	}
	return $file_name;
}
/* html文件名组合 */
function html_show($file_name, $is_url = false) {
	global $_G;
	if ($is_url == true) {
		/* 本地路径 */
		$file_name = $_G ['app'] ['path_html'] . $file_name;
	} else {
		/* 网络地址 */
		$file_name = current_url ( 'html' . $_G ['app'] ['ds'] . $file_name );
	}
	return $file_name;
}
/* url链接解析 */
function url($filename, $param = NULL, $isfullurl = false, $isrewrite = false, $ishide_Index = false) {
	global $_G;
	$rd = '_rd_';
	$filename = $filename . ($_G ['app'] ['ext_php']);
	if (! empty ( $param )) {
		$paramarr = explode ( '/', $param );
		$index = 0;
		$paramstr = NULL;
		foreach ( $paramarr as $val ) {
			$index ++;
			if ($index % 2 === 0) {
				if ($val == $rd) {
					$val = getrand ( 6, 1 );
				}
				$paramstr .= '=' . $val;
			} else {
				if ($index > 2) {
					$paramstr .= '&' . $val;
				} else {
					$paramstr .= $val;
				}
			}
		}
		$urlstr = $filename . '?' . $paramstr;
	} else {
		$urlstr = $filename;
	}
	/* 如果隐藏(index)文件名为(?) */
	if (_isbool ( $ishide_Index )) {
		$urlstr = preg_replace ( "/^index\.php\?/i", '?', $urlstr );
	}
	return current_url ( $urlstr, $isfullurl );
}
/* url追加参数合并 */
function urladdto($param, $add = NULL) {
	$str = NULL;
	if (empty ( $param )) {
		$str = $add;
	} else {
		if (empty ( $add )) {
			$str = $param;
		} else {
			$str = $param . '/' . $add;
		}
	}
	return $str;
}
?>