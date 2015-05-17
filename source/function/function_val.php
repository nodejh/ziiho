<?php
if (! defined ( 'APP_PATH' )) {
	exit ( 'no direct access allowed' );
}

/* 获取配置参数 */
function value_get($module, $m_key, $_key = NULL, $_kk = 'val', $_def = NULL) {
	$module = (empty ( $module ) ? 'common' : $module);
	if (! check_module ( $module )) {
		return $_def;
	}
	$func = $module . '_value';
	if (! function_exists ( $func )) {
		return $_def;
	}
	$arr = $func ( $m_key );
	if (check_is_key ( $_key, $arr ) == 1) {
		$d = (strlen ( $_kk ) < 1) ? $arr [$_key] : $_def;
		$val = my_array_value ( $_kk, $arr [$_key], $d );
	} else {
		$val = (strlen ( $_key ) < 1) ? $arr : $_def;
	}
	return $val;
}
/* 天数 */
function day_val($_key = NULL, $_def = 0) {
	return value_get ( NULL, 'where_day', $_key, 'val', 0 );
}
/* 排序 */
function order_val($_key = 1, $_def = 1) {
	$_def = value_get ( NULL, 'orderby', $_def, 'val' );
	return value_get ( NULL, 'orderby', $_key, 'val', $_def );
}
/* 显示条数 */
function data_num_val($_key = NULL, $_def = 1) {
	$_def = value_get ( NULL, 'data_num', $_def, 'val' );
	return value_get ( NULL, 'data_num', $_key, 'val', $_def );
}
/* 会员性别 */
function gender_val($_key = NULL, $_kk = 'val', $_def = 2) {
	$_def = value_get ( NULL, 'gender', $_def, $_kk );
	return value_get ( NULL, 'gender', $_key, $_kk, $_def );
}
/* 是否 */
function yesno_val($_key = NULL, $_kk = 'val', $_def = NULL) {
	return value_get ( NULL, 'yesno', $_key, $_kk, $_def );
}
/* image标签类型 */
function imageaction_val($_key = NULL, $_kk = 'val', $_def = NULL) {
	return value_get ( NULL, 'imageaction', $_key, $_kk, $_def );
}
/* url前缀 */
function url_pre_val($_key = NULL, $_def = NULL) {
	return value_get ( NULL, 'url_pre', $_key, 'val', $_def );
}
/* 两个数的运算 */
function op2num($a, $b = 1, $optype = 1) {
	if (check_num ( $a ) < 1 || check_num ( $b ) < 1) {
		return lang ( 'global:op2num_invalid_number' );
	}
	$a = intval ( $a );
	$b = intval ( $b );
	$val = 0;
	switch ($optype) {
		case 1 :
			$val = $a + $b;
			break;
		case 2 :
			$val = $a - $b;
			break;
		case 3 :
			$val = $a * $b;
			break;
		case 4 :
			if ($b != 0) {
				$val = $a / $b;
			} else {
				$val = lang ( 'global:cannot_divide_by_0' );
			}
			break;
		case 5 :
			if ($b != 0) {
				$val = $a % $b;
			} else {
				$val = lang ( 'global:cannot_divide_by_0' );
			}
			break;
	}
	return $val;
}
/* 简化获取配置value */
function config_val($_key, $_val, $default_val = NULL) {
	$val = $default_val;
	$arr = my_array_value ( $_key, $_val );
	unset ( $_val );
	if ($arr != NULL) {
		$val = my_array_value ( 'svalue', $arr, $default_val );
		unset ( $arr );
	}
	return $val;
}
/* 获取指定配置变量值 */
function set_field($module = NULL, $_key = NULL, $_kk = 'field', $_def = NULL) {
	return value_get ( $module, 'set_field', $_key, $_kk, $_def );
}
/* 获取内置seo变量名 */
function seo_global($_key = NULL, $_kk = NULL, $_def = NULL) {
	return value_get ( NULL, 'seo_global_name', $_key, $_kk, $_def );
}
/* 设置变量 */
function set_define($_key = NULL, $_val = NULL) {
	if ((strlen ( $_key ) < 1) || (strlen ( $_val ) < 1)) {
		return NULL;
	}
	define ( $_key, $_val );
	return $_val;
}
/* 获取变量 */
function get_define($_key = NULL) {
	if (strlen ( $_key ) < 1) {
		return NULL;
	}
	if (! defined ( $_key )) {
		return NULL;
	}
	eval ( ('$val=' . $_key . ';') );
	return $val;
}
/* 设置cookie */
function set_cookie($_key = NULL, $_val = NULL, $is_encode = false) {
	if (check_enl_len ( $_key, 1, 50 ) < 1) {
		return NULL;
	}
	if (str_len ( $_val ) < 1) {
		return NULL;
	}
	global $_G;
	if ($is_encode === true) {
		$_val = tostr_encode ( $_val );
	}
	$systime = my_array_value ( 'sys_time', my_array_value ( 'app', $_G ) );
	$_time = (( int ) $systime) + (86400 * 30);
	setcookie ( $_key, $_val, $_time );
	return $_val;
}
/* 获取cookie */
function get_cookie($_key = NULL, $is_decode = false, $is_del = false, $defaultval = NULL) {
	if (check_enl_len ( $_key, 1, 50 ) < 1) {
		return NULL;
	}
	$_val = $defaultval;
	if (check_is_key ( $_key, $_COOKIE ) == 1) {
		$_val = $_COOKIE [$_key];
		if ($is_decode === true) {
			$_val = tostr_decode ( $_val );
		}
	}
	/* 删除cookie */
	if ($is_del === true) {
		del_cookie ( $_key );
	}
	return $_val;
}
/* 删除cookie */
function del_cookie($_key = NULL) {
	if (check_enl_len ( $_key, 1, 50 ) < 1) {
		return 0;
	}
	global $_G;
	$systime = my_array_value ( 'sys_time', my_array_value ( 'app', $_G ) );
	$_time = (( int ) $systime) - (86400 * 30);
	setcookie ( $_key, NULL, $_time );
	return 1;
}
/* 默认图片显示nopic */
function show_nopic($isUrl = false) {
	global $_G;
	$nopic = 'image/nopic.jpg';
	if ($isUrl == true) {
		/* 本地路径 */
		$file_name = $_G ['app'] ['path_template_static'] . $nopic;
	} else {
		/* 网络地址 */
		$file_name = $_G ['app'] ['path_static'] . $nopic;
	}
	return $file_name;
}
/* 文件路径包含系统参数解析 */
function de_file_dir($str, $timeval = NULL) {
	global $_G;
	$timeval = (check_nums ( $timeval ) < 1) ? $_G ['app'] ['sys_time'] : $timeval;
	$str = replace_str ( $str, '{y}', date ( 'Y', $timeval ) );
	$str = replace_str ( $str, '{m}', date ( 'm', $timeval ) );
	$str = replace_str ( $str, '{d}', date ( 'd', $timeval ) );
	return $str;
}
/* 获取id下的子id */
function get_child_id($id, $ids) {
	$list .= $id;
	if (check_is_key ( $id, $ids ) == 1) {
		foreach ( $ids [$id] as $parent ) {
			$list .= ',' . get_child_id ( $parent, $ids );
		}
	}
	return $list;
}
/* 获取新的一天的时间 */
function get_newday_time() {
	global $_G;
	$val = date ( 'Ymd', $_G ['app'] ['sys_time'] );
	$val = str_strtotime ( $val );
	return $val;
}
/* 获取一整天的时间 */
function get_dayall_time($is_strtotime = true) {
	global $_G;
	$val = (date ( 'Ymd', $_G ['app'] ['sys_time'] )) . '235959';
	if ($is_strtotime === true) {
		$val = str_strtotime ( $val );
	}
	return $val;
}
/* 简化获取配置 */
function get_db_set($_key, $_val = NULL) {
	global $_G;
	/* 初始化配置 */
	$S = loader ( 'class:class_common_set', 'common', true, true );
	$result = $S->set_query ( $_key, $_val );
	unset ( $S );
	return $result;
}
/* 组合标签变量名 */
function tag_var_name($str = NULL, $pre = '{', $end = '}') {
	if (strlen ( $str ) < 1) {
		return $str;
	}
	$str = ($pre . $str . $end);
	return $str;
}
/* SEO解析 */
function get_seo($module = NULL, $mType = NULL, $seoType = NULL, $varData = NULL, $seoData = NULL, $custom = false) {
	/* 站点信息(全局) */
	$siteInfo = get_db_set ( array (
			'smodule' => 'common',
			'stype' => set_field ( NULL, 'sitebase' ) 
	) );
	
	/* 始化seo,当不为手动设置 */
	if ($custom === false) {
		/* 获取模块seo信息 */
		$seoConfig = get_db_set ( array (
				'smodule' => $module,
				'stype' => $mType 
		) );
		if (! is_array ( $seoConfig )) {
			return NULL;
		}
		$seoDataSet = array (
				'title' => config_val ( $seoType . '_title', $seoConfig ),
				'keywords' => config_val ( $seoType . '_keywords', $seoConfig ),
				'description' => config_val ( $seoType . '_description', $seoConfig ) 
		);
		/* 解析模块变量 */
		if (is_array ( $varData )) {
			foreach ( $varData as $vK => $vV ) {
				$r = (isset ( $vV ['range'] ) ? explode ( ':', $vV ['range'] ) : array ());
				if (in_array ( $seoType, $r )) {
					foreach ( $seoDataSet as $sdsK => $sdsV ) {
						$seoDataSet [$sdsK] = str_ireplace ( $vV ['val'], (isset ( $seoData [$vK] ) ? $seoData [$vK] : NULL), $seoDataSet [$sdsK] );
					}
				}
				unset ( $r );
			}
		}
	} else {
		$seoDataSet = $seoData;
	}
	/* 解析全局变量 */
	$globalVars = seo_global ();
	if (is_array ( $globalVars )) {
		foreach ( $globalVars as $gk => $gv ) {
			foreach ( $seoDataSet as $sdsK => $sdsV ) {
				$seoDataSet [$sdsK] = str_ireplace ( $gv ['val'], config_val ( $gv ['field'], $siteInfo ), $seoDataSet [$sdsK] );
			}
		}
	}
	return $seoDataSet;
}
/* 获取当前会员值 */
function get_user($_key = NULL, $_def = NULL) {
	global $_G;
	$arr = my_array_value ( 'user', $_G );
	if (! my_is_array ( $arr )) {
		return $_def;
	}
	if ($_key != NULL) {
		$val = my_array_value ( $_key, $arr, $_def );
	} else {
		$val = $arr;
	}
	return $val;
}
?>