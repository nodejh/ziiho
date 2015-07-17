<?php
if (! defined ( 'APP_PATH' )) {
	exit ( 'no direct access allowed' );
}

/* 获取配置参数 */
function common_value_get($m_key, $_key = NULL, $_kk = 'val', $_default_val = NULL) {
	$val = $_default_val;
	$arr = common_value ( $m_key );
	if (check_is_key ( $_key, $arr ) == 1) {
		$d = (str_len ( $_kk ) < 1) ? $arr [$_key] : $_default_val;
		$val = array_key_val ( $_kk, $arr [$_key], $d );
	} else {
		$val = (str_len ( $_key ) < 1) ? $arr : $_default_val;
	}
	unset ( $arr );
	return $val;
}
/* 解析主题列表类型 */
function common_subject_template($_module, $_key = 'space') {
	$func = $_module . '_value';
	if (check_is_fun ( $func ) < 1) {
		return NULL;
	}
	$arr = $func ( 'subject_template' );
	$val = NULL;
	if (check_is_key ( $_key, $arr ) == 1) {
		$val = array_key_val ( 'val', $arr [$_key] );
	}
	unset ( $arr );
	return $val;
}
/* 网站导航类型 */
function common_nav_type($_key = 'site') {
	$returnVal = NULL;
	$arr = dc_value ( 'nav_type' );
	if (check_is_key ( $_key, $arr ) == 1) {
		$returnVal = array_key_val ( 'field', $arr [$_key] );
	}
	return $returnVal;
}
/* 附件类型 */
function common_attachment_type($_key = 'image', $_kk = 'val') {
	$returnVal = common_value_get ( 'attachment_type', $_key, $_kk );
	return $returnVal;
}
/* 获取站点首页 */
function get_index($_key = 'navurl') {
	global $_G;
	/* 获取设置 */
	$sets = get_db_set ( array (
			'smodule' => 'common',
			'stype' => config_name_val ( 'sitestyle' ),
			'svariable' => 'navid' 
	) );
	if (check_is_key ( 'navid', $sets ) < 1) {
		return NULL;
	}
	$N = loader ( 'class:class_common_nav', 'common', true, true );
	$nav = $N->nav_query ( array (
			'navid' => config_val ( 'navid', $sets ),
			'disabled' => yesno_val ( 'normal' ) 
	) );
	/* 获取指定值 */
	if (check_is_key ( $_key, $nav )) {
		$nav = $nav [$_key];
	}
	return $nav;
}
/* 站点首页 */
function http_index() {
	global $_G;
	/* 初始化模块 */
	$moduleArr = get_module ();
	/* 获取首页 */
	$indexUrl = get_index ();
	/* 解析url参数 */
	$urlArr = de_urlparam ( $indexUrl );
	/* 获取mod参数 */
	$mod = array_key_val ( 'mod', $urlArr );
	/* 如果mod参数模块不存在则默认common */
	$module = array_key_val ( $mod, $moduleArr );
	$module = array_key_val ( 'module', $module, 'common' );
	/* 初始化mod */
	$_GET ['mod'] = $module;
	/* 清空值 */
	unset ( $moduleArr, $urlArr );
	/* 设置模块 */
	set_module ( $module );
	$_G ['module'] = get_module ( $module );
	/* 载入模块 */
	loader ( 'assign:' . $module, $module );
}
/* 选中当前导航 */
function isnavcurrent($key, $val) {
	$keyVal = get_param ( $key );
	if (! empty ( $keyVal )) {
		$keyVal = strtolower ( $keyVal );
	}
	if (! empty ( $val )) {
		$val = strtolower ( $val );
		if ($keyVal == $val) {
			return true;
		}
	}
	return false;
}
/* 获取模块模板 */
function get_datastyle($_key = NULL, $_val = NULL) {
	$d = loader ( 'class:class_common_datastyle', 'common', true, true );
	$result = $d->datastyle_query ( $_key, $_val );
	return $result;
}
/* 获取模块模板列表 */
function get_module_datastyle($_module = NULL) {
	$a = loader ( 'class:class_common_datastyle', 'common', true, true );
	$result = $a->datastyle_lists ( $_module );
	return $result;
}
/* 数据调用 */
function common_datablock($dcid = NULL) {
	if (check_nums ( $dcid ) < 1) {
		return NULL;
	}
	$a = loader ( 'class:class_common_datablock', 'common', true, true );
	$result = $a->datablock_show ( $dcid );
	return $result;
}
/* 获取模块数据调用代码 */
function common_datablock_code($_key = NULL, $param = NULL, $_default_val = NULL) {
	$val = $_default_val;
	$arr = common_value ( 'datablock_code' );
	if (check_is_key ( $_key, $arr ) == 1) {
		$val = array_key_val ( 'val', $arr [$_key], $_default_val );
		$val = replace_str ( $val, '{dcid}', $param );
	}
	unset ( $arr );
	return $val;
}
/* 主题属性标签列表 */
function common_attr_list() {
	global $_G;
	$a = loader ( 'class:class_common_attribute', 'common', true, true );
	$result = $a->lists ();
	return $result;
}
/* 主题属性标签获取一个 */
function common_attr_query($_key, $_val = NULL, $_getkey = NULL) {
	global $_G;
	$a = loader ( 'class:class_common_attribute', 'common', true, true );
	$result = $a->attr_query ( $_key, $_val );
	$result = array_key_val ( $_getkey, $result, $result );
	return $result;
}
/* 获取已启用积分字段 */
function common_creditfield($delField = 'credit0') {
	/* 获取 */
	$sets = get_db_set ( array (
			'smodule' => 'common',
			'stype' => common_value_get ( 'set_field', 'creditfield', 'field' ) 
	) );
	if (check_is_array ( $sets ) < 1) {
		return NULL;
	}
	/* 还原成数组 */
	$fieldArr = de_serialize ( config_val ( 'fieldinfo', $sets ) );
	if (check_is_key ( $delField, $fieldArr ) == 1) {
		unset ( $fieldArr [$delField] );
	}
	return $fieldArr;
}
/* ---------内容分类--------- */
/*分类查询*/
function common_category_query($_key, $_val = NULL) {
	global $_G;
	$C = loader ( 'class:class_common_category', 'common', true, true );
	$result = $C->category_query ( $_key, $_val );
	if (check_is_array ( $result ) < 1) {
		return NULL;
	}
	return $result;
}
/* 分类列表查询 */
function common_category_list_query($_key, $_val = NULL) {
	global $_G;
	$C = loader ( 'class:class_common_category', 'common', true, true );
	$result = $C->category_list_query ( $_key, $_val );
	return $result;
}
/* 分类列表显示 */
function common_category_list($_key, $_val = NULL, $template = NULL, $current_catid = 0, $showchild = true) {
	global $_G;
	$C = loader ( 'class:class_common_category', 'common', true, true );
	$result = $C->category_list ( $_key, $_val, $template, $current_catid, $showchild );
	return $result;
}
/* 分类导航 */
function common_category_nav($_key, $_val = NULL, $catid = NULL) {
	global $_G;
	$C = loader ( 'class:class_common_category', 'common', true, true );
	$result = $C->category_nav ( $_key, $_val, $catid );
	return $result;
}
/* ---------主题聚合记录--------- */
function common_blend_content_query($_key, $_val = NULL) {
	global $_G;
	$C = loader ( 'class:class_common_blend_content', 'common', true, true );
	$result = $C->blend_content_query ( $_key, $_val );
	if (check_is_array ( $result ) < 1) {
		return NULL;
	}
	return $result;
}
function common_blend_content_add($_key, $_val = NULL) {
	global $_G;
	$C = loader ( 'class:class_common_blend_content', 'common', true, true );
	$result = $C->blend_content_add ( $_key, $_val );
	return $result;
}
function common_blend_content_del($_key, $_val = NULL) {
	global $_G;
	$C = loader ( 'class:class_common_blend_content', 'common', true, true );
	$result = $C->blend_content_del ( $_key, $_val );
	return $result;
}
/* ---------附件--------- */
function common_temp_attachment_query($_key, $_val = NULL, $islist = false) {
	global $_G;
	$C = loader ( 'class:class_common_temp_attachment', 'common', true, true );
	$result = $C->temp_attachment_query ( $_key, $_val, $islist );
	return $result;
}
function common_temp_attachment_count($_key, $_val = NULL) {
	global $_G;
	$C = loader ( 'class:class_common_temp_attachment', 'common', true, true );
	$result = $C->temp_attachment_count ( $_key, $_val );
	return $result;
}
function common_temp_attachment_add($data, $isinsertid = false) {
	global $_G;
	$C = loader ( 'class:class_common_temp_attachment', 'common', true, true );
	$result = $C->temp_attachment_add ( $data, $isinsertid );
	return $result;
}
function common_temp_attachment_edit($data, $_key, $_val = NULL) {
	global $_G;
	$C = loader ( 'class:class_common_temp_attachment', 'common', true, true );
	$result = $C->temp_attachment_edit ( $data, $_key, $_val );
	return $result;
}
function common_temp_attachment_del($_key, $_val = NULL) {
	global $_G;
	$C = loader ( 'class:class_common_temp_attachment', 'common', true, true );
	$result = $C->temp_attachment_del ( $_key, $_val );
	return $result;
}
?>