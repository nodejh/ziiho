<?php
if (! defined ( 'APP_PATH' )) {
	exit ( 'no direct access allowed' );
}

/* 获取当前模块组件 */
function _M($_kk = NULL, $_def = NULL) {
	global $_G;
	$_key = my_array_value ( 'module', my_array_value ( 'app', $_G ) );
	if (empty ( $_key )) {
		return NULL;
	}
	if (! defined ( $_key )) {
		return NULL;
	}
	eval ( ('$val=' . $_key . ';') );
	/* 模块参数 */
	if (check_enl_len ( $_kk ) == 1) {
		$val = get_module ( $val, $_kk, $_def );
	}
	return $val;
}
/* 设置模块值 */
function set_module($val) {
	global $_G;
	$_key = my_array_value ( 'module', my_array_value ( 'app', $_G ) );
	set_define ( $_key, $val );
	$_G ['module'] = get_module ( $val );
}
/* 返回模块目录 */
function module_path($module, $path = NULL, $ext = '.php') {
	global $_G;
	if (strlen ( $module ) < 1) {
		return NULL;
	}
	$pathRoot = ($_G ['app'] ['path_source']) . 'module/' . $module . DS;
	if (strlen ( $path ) >= 1) {
		$pathRoot .= $path . $ext;
	}
	return $pathRoot;
}
/* 检查模块 */
function check_module($_key = NULL, $_kk = 'module', $_def = NULL) {
	$_key = trim ( $_key );
	if (empty ( $_key )) {
		return false;
	}
	if (! get_module_isValid ( $_key )) {
		return false;
	}
	$val = get_module ( $_key, $_kk, $_def );
	if (empty ( $val )) {
		return false;
	}
	return true;
}
/* 获取指定化模块值 */
function get_module($_key = NULL, $_kk = NULL, $_def = NULL) {
	global $_G;
	$_key = strtolower ( trim ( $_key ) );
	
	$cacheFile = ($_G ['app'] ['path_data']) . 'config/module' . ($_G ['app'] ['ext_php']);
	if (is_file ( $cacheFile )) {
		$mData = include $cacheFile;
	} else {
		$mData = get_module_installed ();
	}
	if (check_is_key ( $_key, $mData ) == 1) {
		$d = (strlen ( $_kk ) < 1) ? $mData [$_key] : $_def;
		$val = my_array_value ( $_kk, $mData [$_key], $d );
	} else {
		$val = (strlen ( $_key ) < 1) ? $mData : $_def;
	}
	return $val;
}
/* 核心模块 */
function get_module_core() {
	$mData = array (
			'common',
			'member',
			'admin',
			'article' 
	);
	return $mData;
}
/* 模块状态 */
function get_module_status() {
	$mData = array (
			'on',
			'off' 
	);
	return $mData;
}
/* 模块安装日期 */
function get_module_insTime($module) {
	global $_G;
	if (! get_module_isValid ( $module )) {
		return NULL;
	}
	$module = strtolower ( trim ( $module ) );
	$mDir = ($_G ['app'] ['path_source']) . 'module/' . $module;
	if (! is_dir ( $mDir )) {
		return NULL;
	}
	$insFile = $mDir . '/install/' . INSTALL_LOCK_FILE;
	if (! is_file ( $insFile )) {
		return NULL;
	}
	$insTime = filectime ( $insFile );
	return $insTime;
}
/* 模块信息info */
function get_module_info($module) {
	global $_G;
	if (! get_module_isValid ( $module )) {
		return NULL;
	}
	$module = strtolower ( trim ( $module ) );
	$mDir = ($_G ['app'] ['path_source']) . 'module/' . $module;
	if (! is_dir ( $mDir )) {
		return NULL;
	}
	$infoFile = $mDir . '/install/info.php';
	if (! is_file ( $infoFile )) {
		return NULL;
	}
	include $infoFile;
	
	$mCore = get_module_core ();
	if (in_array ( $module, $mCore )) {
		$_ModuleInfo ['iscore'] = 1;
	} else {
		$_ModuleInfo ['iscore'] = 0;
	}
	$_ModuleInfo ['ctime'] = get_module_insTime ( $module );
	$_ModuleInfo ['mtime'] = NULL;
	return $_ModuleInfo;
}
/* 获取module下的模块 */
function get_module_dir() {
	global $_G;
	$mDir = ($_G ['app'] ['path_source']) . 'module/';
	if (! is_dir ( $mDir )) {
		return NULL;
	}
	$files = get_file_list ( $mDir, 'dir' );
	return $files;
}
/* 模块合法性 */
function get_module_isValid($module) {
	$module = strtolower ( trim ( $module ) );
	if (empty ( $module )) {
		return false;
	}
	if (check_enl_el ( $module ) < 1) {
		return false;
	}
	return true;
}
/* 模块目录是否存在 */
function get_module_isDir($module) {
	global $_G;
	if (! get_module_isValid ( $module )) {
		return false;
	}
	$module = strtolower ( trim ( $module ) );
	$mDir = ($_G ['app'] ['path_source']) . 'module/' . $module;
	if (! is_dir ( $mDir )) {
		return false;
	}
	return true;
}
/* 模块是否安装 */
function get_module_isInstall($module) {
	global $_G;
	if (! get_module_isValid ( $module )) {
		return false;
	}
	$module = strtolower ( trim ( $module ) );
	$mDir = ($_G ['app'] ['path_source']) . 'module/' . $module;
	if (! is_dir ( $mDir )) {
		return false;
	}
	$ins_LockFile = $mDir . '/install/' . INSTALL_LOCK_FILE;
	if (! is_file ( $ins_LockFile )) {
		return false;
	}
	return true;
}
/* 模块是否开启 */
function get_module_isOn($module) {
	global $_G;
	if (! get_module_isInstall ( $module )) {
		return false;
	}
	$module = strtolower ( trim ( $module ) );
	$mDir = ($_G ['app'] ['path_source']) . 'module/' . $module;
	if (! is_dir ( $mDir )) {
		return false;
	}
	$ins_StatusFile = $mDir . '/install/on.txt';
	if (! is_file ( $ins_StatusFile )) {
		return false;
	}
	return true;
}
/* 模块是否为核心 */
function get_module_isCore($module) {
	if (! get_module_isValid ( $module )) {
		return false;
	}
	$module = strtolower ( trim ( $module ) );
	$coreData = get_module_core ();
	if (! in_array ( $module, $coreData )) {
		return false;
	}
	return true;
}
/* 模块列表 */
function get_module_list() {
	global $_G;
	$modules = get_module_dir ();
	if (! is_array ( $modules )) {
		return NULL;
	}
	$mData = NULL;
	foreach ( $modules as $mK => $mV ) {
		$mData [$mV ['name']] = get_module_info ( $mV ['name'] );
	}
	return $mData;
}
/* 已安装的模块 */
function get_module_installed($GetSpecify = NULL, $isStatus = 'on') {
	global $_G;
	$modules = get_module_dir ();
	if (! is_array ( $modules )) {
		return NULL;
	}
	$isStatus = strtolower ( trim ( $isStatus ) );
	$onName = 'on';
	$mData = NULL;
	/* 存放模块目录 */
	$mDir = ($_G ['app'] ['path_source']) . 'module/';
	foreach ( $modules as $mK => $mV ) {
		$ins_LockFile = $mDir . $mV ['name'] . '/install/' . INSTALL_LOCK_FILE;
		if (! is_file ( $ins_LockFile )) {
			continue;
		}
		if ($isStatus == $onName) {
			if (! get_module_isOn ( $mV ['name'] )) {
				continue;
			}
		}
		if (is_array ( $GetSpecify )) {
			if (! array_key_exists ( $mV ['name'], $GetSpecify )) {
				continue;
			}
		}
		$mData [$mV ['name']] = get_module_info ( $mV ['name'] );
	}
	return $mData;
}
/* 获取支持指定功能的模块 */
function get_module_support($supportType) {
	global $_G;
	$supportType = trim ( strtolower ( $supportType ) );
	if (empty ( $supportType )) {
		return NULL;
	}
	$mData = get_module_installed ();
	if (! is_array ( $mData )) {
		return NULL;
	}
	$supportModule = NULL;
	$mDir = ($_G ['app'] ['path_source']) . 'module/';
	foreach ( $mData as $mK => $mV ) {
		$ini_File = $mDir . $mV ['module'] . '/install/ini.php';
		if (! is_file ( $ini_File )) {
			continue;
		}
		$iniData = NULL;
		$supportData = NULL;
		
		include $ini_File;
		
		if (! isset ( $_ini )) {
			continue;
		}
		$iniData = $_ini;
		if (! is_array ( $iniData )) {
			continue;
		}
		if (! array_key_exists ( 'support', $iniData )) {
			continue;
		}
		$supportData = $iniData ['support'];
		if (! is_array ( $supportData )) {
			continue;
		}
		if (! in_array ( $supportType, $supportData )) {
			continue;
		}
		$supportModule [$mV ['module']] = $mV;
	}
	return $supportModule;
}
/* 设置模块状态 */
function set_module_status($module, $statusType = 'on') {
	global $_G;
	$onType = 'on';
	$module = strtolower ( trim ( $module ) );
	$statusType = strtolower ( trim ( $statusType ) );
	
	if (! get_module_isInstall ( $module )) {
		return false;
	}
	if (! in_array ( $statusType, get_module_status () )) {
		return false;
	}
	if ($statusType == $onType) {
		if (get_module_isOn ( $module )) {
			return true;
		}
	} else {
		if (! get_module_isOn ( $module )) {
			return true;
		}
	}
	$mDir = ($_G ['app'] ['path_source']) . 'module/' . $module;
	if (! is_dir ( $mDir )) {
		return false;
	}
	$ins_StatusFile = $mDir . '/install/on.txt';
	if (is_file ( $ins_StatusFile )) {
		if ($statusType != $onType) {
			if (! unlink ( $ins_StatusFile )) {
				return false;
			}
		}
	} else {
		if ($statusType == $onType) {
			if (! write_file_content ( $ins_StatusFile, 'ok' )) {
				return false;
			}
		}
	}
	return true;
}
/* 模块缓存 */
function module_cache_write($isUpdateTemplate = false) {
	global $_G;
	$mData = get_module_installed ();
	
	$cacheDir = ($_G ['app'] ['path_data']) . 'config';
	if (! is_dir ( $cacheDir )) {
		return false;
	}
	if (! is_writable ( $cacheDir )) {
		return false;
	}
	$cacheFile = $cacheDir . '/module' . ($_G ['app'] ['ext_php']);
	$writeContent = "<?php\r if(!defined('APP_PATH')){exit('no direct access allowed');}\r\r";
	$writeContent .= "return array(\r\t";
	if (is_array ( $mData )) {
		$mDataLen = count ( $mData );
		$mIndex = 0;
		foreach ( $mData as $mK => $mV ) {
			$mVLen = count ( $mV );
			$mVIndex = 0;
			if ($mIndex != 0) {
				$writeContent .= ",\r\t";
			}
			$writeContent .= '\'' . $mV ['module'] . '\' => array(';
			if ($mVLen >= 1) {
				foreach ( $mV as $mVK => $mVV ) {
					$mVV = trim ( $mVV );
					if ($mVIndex != 0) {
						$writeContent .= ',';
					}
					$writeContent .= "\r\t\t\t";
					$writeContent .= '\'' . $mVK . '\' => ' . (strlen ( trim ( $mVV ) ) < 1 ? '\'\'' : '\'' . addslashes ( $mVV ) . '\'');
					$mVIndex ++;
				}
			}
			$writeContent .= "\r\t\t)";
			$mIndex ++;
		}
	}
	$writeContent .= "\r);\r ?>";
	if (! write_file_content ( $cacheFile, $writeContent )) {
		return false;
	}
	/* 更新模板 */
	if ($isUpdateTemplate != false) {
		$templateC_Dir = ($_G ['app'] ['path_data']) . 'template_c';
		delete_dir ( $templateC_Dir, 'main' );
	}
	return true;
}
/* 将指定的模块重新排序 */
function module_sort($_arr, $_key = NULL) {
	if (empty ( $_key )) {
		$_key = array (
				'common',
				'member',
				'admin',
				'article' 
		);
	}
	if (! is_array ( $_arr )) {
		return $_arr;
	}
	$re_arr = array ();
	if (! is_array ( $_key )) {
		$_key = array (
				$_key 
		);
	}
	foreach ( $_key as $k ) {
		if (! array_key_exists ( $k, $_arr )) {
			continue;
		}
		$re_arr [$k] = $_arr [$k];
		unset ( $_arr [$k] );
	}
	return array_merge ( $re_arr, $_arr );
}
?>