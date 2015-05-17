<?php
if (! defined ( 'APP_PATH' )) {
	exit ( 'no direct access allowed' );
}

/* 匹配对应的模块配置值 */
function common_inc_module_datacall($module, $m_key = NULL, $_key = NULL, $_kk = NULL, $_default = NULL) {
	if (str_len ( $module ) < 1) {
		return NULL;
	}
	$mfun = $module . '_config_value_get';
	if (check_is_fun ( $mfun ) < 1) {
		return NULL;
	}
	$val = $mfun ( $m_key, $_key, $_kk, $_default );
	return $val;
}

?>