<?php
if (! defined ( 'APP_PATH' )) {
	exit ( 'no direct access allowed' );
}

/**
 * *
 * ** 模板解析
 * ** $tplfile=模板文件
 * ** $objfile=解析后生成的编译文件
 * *
 */
function parse_template($tplfile = NULL, $objfile = NULL, $header_info = NULL) {
	if (! is_file ( $tplfile )) {
		$fileNameArr = get_fs ( $objfile, true );
		$ShowFile = str_ireplace ( APP_PATH, '/', $fileNameArr ['dir_name'] );
		echo lang ( 'global:file_not_exist', $ShowFile );
		exit ();
	}
	/* 读取模板文件 */
	$template = read_file_content ( $tplfile );
	/* 当模板为空 */
	if (strlen ( trim ( $template ) ) < 1) {
		template_write ( $objfile, $template );
		return true;
	}
	/* 最大内嵌层数 */
	$nest = 5;
	
	$var_regexp = "((\\\$[a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*)(\[[a-zA-Z0-9_\-\.\"\'\[\]\$\x7f-\xff]+\])*)";
	$const_regexp = "([a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*)";
	
	$template = preg_replace ( "/([\n\r\t]+)\t+/s", "\\1", $template );
	$template = preg_replace ( "/\<\!\-\-\{(.+?)\}\-\-\>/s", "{\\1}", $template );
	$template = preg_replace ( "/\{(\\\$[a-zA-Z0-9_\[\]\'\"\$\.\x7f-\xff]+)\/\}/s", "<?php echo \\1; ?>", $template );
	
	$template = str_replace ( "{LF\/}", "<?=\"\\r\\n\"?>", $template );
	/*
	 * $template = preg_replace("/$var_regexp/es", "addquote('<?=\\1?>')", $template);
	 */
	$template = preg_replace ( "/\<\?\=\<\?\=$var_regexp\?\>\?\>/es", "addquote('<?=\\1?>')", $template );
	$template = preg_replace ( "/\<\?\=(.+?)\?\>(\->[a-zA-Z0-9_\x7f-\xff]*)/is", "<?=\\1\\2?>", $template );
	
	$template = preg_replace ( "/[\n\r\t]*\{lang\s+([a-zA-Z0-9_:]+)\/\}[\n\r\t]*/is", "<?php echo lang('\\1'); ?>", $template );
	$template = preg_replace ( "/[\n\r\t]*\{subtemplate\s+([a-zA-Z0-9_\/]+)\}[\n\r\t]*/is", "\n<?php include subtemplate('\\1'); ?>\n", $template );
	$template = preg_replace ( "/[\n\r\t]*\{subtemplate\s+(.+?)\}[\n\r\t]*/ies", "stripvtags('\n<?php include subtemplate(\\1); ?>\n','')", $template );
	$template = preg_replace ( "/[\n\r\t]*\{modtemplate\s+([a-zA-Z0-9_\/]+)\}[\n\r\t]*/is", "\n<?php include modtemplate('\\1'); ?>\n", $template );
	$template = preg_replace ( "/[\n\r\t]*\{modtemplate\s+(.+?)\}[\n\r\t]*/ies", "stripvtags('\n<?php include modtemplate(\\1); ?>\n','')", $template );
	$template = preg_replace ( "/[\n\r\t]*\{include\s+(.+?)\}[\n\r\t]*/ies", "stripvtags('\n<?php if(\$_incfile_=\\1){include (\$_incfile_);} ?>\n','')", $template );
	$template = preg_replace ( "/[\n\r\t]*\{elseif\s+(.+?)\}[\n\r\t]*/ies", "stripvtags('<?php } elseif(\\1) { ?>','')", $template );
	$template = preg_replace ( "/[\n\r\t]*\{else\}[\n\r\t]*/is", "<?php } else { ?>", $template );
	$template = preg_replace ( "/[\n\r\t]*\{eval\s+(.+?)\/\}[\n\r\t]*/ies", "stripvtags('<?php \\1; ?>','')", $template );
	$template = preg_replace ( "/[\n\r\t]*\{print\s+(.+?)\/\}[\n\r\t]*/ies", "stripvtags('<?php echo \\1; ?>','')", $template );
	$template = preg_replace ( "/[\n\r\t]*\{module\s+(.+?)\/\}[\n\r\t]*/ies", "stripvtags('<?php echo get_module(\\1); ?>','')", $template );
	$template = preg_replace ( "/[\n\r\t]*\{sublen\s+(.+?)\/\}[\n\r\t]*/ies", "stripvtags('<?php echo sub_str(\\1); ?>','')", $template );
	$template = preg_replace ( "/[\n\r\t]*\{datestyle\s+(.+?)\/\}[\n\r\t]*/ies", "stripvtags('<?php echo datestyle(\\1); ?>','')", $template );
	$template = preg_replace ( "/[\n\r\t]*\{url\s+(.+?)\/\}[\n\r\t]*/ies", "strip_url('<?php echo url(\\1); ?>','')", $template );
	$template = preg_replace ( "/[\n\r\t]*\{field:([a-zA-Z_]|[a-zA-Z_]+[a-zA-Z0-9_\.\$]+)\/\}[\n\r\t]*/ies", "stripvtags(strip_field('\\1','\\0'),'')", $template );
	$template = preg_replace ( "/[\n\r\t]*\{stripvstr\s+(.+?)\/\}[\n\r\t]*/ies", "stripvtags('\n<?php echo str_stripslashes(\\1); ?>\n','')", $template );
	
	// $template = preg_replace("/[\n\r\t]*\{cj:([a-zA-Z0-9_]+)\s+([^}]+)\}[\n\r\t]*(.+?)[\n\r\t]*\{\/cj\}[\n\r\t]*/ies", "stripvtags(strip_cj_module_tag('\\1','\\2','\\3','\\0'),'')", $template);
	$template = preg_replace ( "/[\n\r\t]*\{cj:([a-zA-Z0-9_]+)\s+([^}]+)\}[\n\r\t]*/ies", "stripvtags(strip_cj_module_tag('\\1','\\2','\\3','\\0'),'')", $template );
	$template = preg_replace ( "/[\n\r\t]*\{\/cj\}[\n\r\t]*/is", "<?php } ?>", $template );
	
	$template = preg_replace ( "/[\n\r\t]*\{datablock\/([1-9]|[1-9][0-9]+)\}[\n\r\t]*/is", "\n<?php if(check_is_fun('common_datablock')==1){ echo common_datablock('\\1'); }else{ lang('datablockundefined',true); } ?>\n", $template );
	$template = preg_replace ( "/\{uploadfile\s+(\\\$[a-zA-Z0-9_\[\]\'\"\$\.\x7f-\xff]+)\/\}/s", "<?php echo show_uf(\\1); ?>", $template );
	
	$template = preg_replace ( "/\{$const_regexp\/\}/s", "<?php echo \\1; ?>", $template );
	$template = preg_replace ( "/ \?\>[\n\r\t]*\<\? /s", " ", $template );
	
	$template = preg_replace ( "/\<\?(\s{1})/is", "<?php\\1", $template );
	$template = preg_replace ( "/\<\?\=(.+?)\?\>/is", "<?php echo \\1;?>", $template );
	
	$template = preg_replace ( "/\"(http)?[\w\.\/:]+\?[^\"]+?&[^\"]+?\"/e", "transamp('\\0')", $template );
	$template = preg_replace ( "/(\<script[^\>]*?src=\"(.+?)\".*?\>\s*\<\/script\>)/ise", "stripscriptamp('\\1','\\2')", $template );
	
	for($i = 0; $i < $nest; $i ++) {
		$template = preg_replace ( "/[\n\r\t]*\{loop\s+(\S+)\s+(\S+)\}[\n\r\t]*(.+?)[\n\r\t]*\{\/loop\}[\n\r\t]*/ies", "stripvtags('\n<?php if(check_is_array(\\1)==1) { foreach(\\1 as \\2) { ?>','\n\\3\n<?php } } ?>\n')", $template );
		$template = preg_replace ( "/[\n\r\t]*\{loop\s+(\S+)\s+(\S+)\s+(\S+)\}[\n\r\t]*(.+?)[\n\r\t]*\{\/loop\}[\n\r\t]*/ies", "stripvtags('\n<?php if(check_is_array(\\1)==1) { foreach(\\1 as \\2 => \\3) { ?>','\n\\4\n<?php } } ?>\n')", $template );
		$template = preg_replace ( "/[\n\r\t]*\{for\s+(.+?)\}[\n\r\t]*(.+?)[\n\r\t]*\{\/for\}[\n\r\t]*/ies", "stripvtags('<?php for(\\1) { ?>','\n\\2<?php } ?>\n')", $template );
		$template = preg_replace ( "/[\n\r\t]*\{if\s+(.+?)\}[\n\r\t]*(.+?)[\n\r\t]*\{\/if\}[\n\r\t]*/ies", "stripvtags('<?php if(\\1) { ?>','\\2<?php } ?>')", $template );
		$template = preg_replace ( "/[\n\r\t]*\{dbres\s+(\S+)\s+(\S+)\}[\n\r]*(.+?)[\n\r]*\{\/dbres\}[\n\r\t]*/ies", "stripvtags('\n<?php if(\\1) { while(\\2 = db_fetch_array(\\1)) { ?>','\n\\3\n<?php } } ?>\n')", $template );
	}
	
	$template = "<?php \r if(!defined('APP_PATH')){exit('no direct access allowed');}\r {$header_info}\r ?>{$template}";
	
	template_write ( $objfile, $template );
}
/* 设置文件头信息 */
function compile_header_info($tplfile = NULL, $info_key = NULL) {
	$tplfile = preg_replace ( "/^" . str_replace ( '/', '\/', APP_PATH ) . "/i", '', $tplfile );
	/* 设置文件信息 */
	$template_info .= '$_file_valid[\'' . $info_key . '\']=array(';
	$template_info .= '\'file_name\'=>\'' . $tplfile . '\',';
	$template_info .= '\'file_time\'=>\'' . filetime ( $tplfile ) . '\'';
	$template_info .= ');unset($_file_valid);';
	return $template_info;
}
/*
 * 调用main模块模板 *template_file=模板文件,compile_id=模板id,cache_id=缓存id,cache_time=缓存时间,compile_check=编译检查
 */
function subtemplate($template_file = NULL, $compile_id = NULL, $cache_time = 0, $cache_update = false) {
	global $_G;
	/* 模板主目录 */
	$template_root = $_G ['app'] ['path_template'] . 'main' . DS . $_G ['app'] ['template_main'] . DS;
	/* 模板完整路径 */
	$template_file_name = $template_root . $template_file . $_G ['app'] ['tpl_ext'];
	/* 检查模板是否存在 */
	if (check_is_file ( $template_file_name ) < 1) {
		$msg_path = $_G ['web'] ['templatepath'] . $template_file;
		echo lang ( 'global:tpl_not_exist', $msg_path );
		exit ();
	}
	$template_arr = explode ( '/', $template_file );
	$template_len = count ( $template_arr );
	if ($template_len < 2) {
		echo lang ( 'global:tpl_rule_fail' );
		exit ();
	}
	/* 检查编译文件名id编号是否合法 */
	if ($compile_id != NULL) {
		if (check_num ( $compile_id ) < 1) {
			echo lang ( 'global:tpl_compile_id_fail' );
			exit ();
		} else {
			$compile_id = $compile_id . '_';
		}
	}
	/* 获取模板文件名 */
	$template_name = $template_arr [$template_len - 1];
	unset ( $template_arr [$template_len - 1] );
	/* 取出当前模块名 */
	$template_model = end ( $template_arr );
	/* 取出模块路径 */
	$model_dir = DS . implode ( '/', $template_arr ) . DS;
	/* 设置要编译的目录 */
	$compile_dir = 'template_c' . DS . 'main' . $model_dir;
	$compile_path = $_G ['app'] ['path_data'] . $compile_dir;
	/* 检查编译目录 */
	if (! is_dir ( $compile_path )) {
		if (create_dir ( $_G ['app'] ['path_data'], $compile_dir ) < 1) {
			echo lang ( 'global:dir_open_fail', $compile_dir );
			exit ();
		}
	}
	/* 检查cache_time缓存时间是否合法 */
	$cache_time = (check_num ( $cache_time ) < 1) ? 0 : $cache_time;
	/* 设置要编译的文件名 */
	// $compile_name=$compile_id.md5_str($template_name).$_G['app']['ext_php'];
	/* $compile_name=$compile_id.md5_str($template_name).'.'.$template_name.$_G['app']['tpl_ext'].$_G['app']['ext_php']; */
	$compile_name = $compile_id . $template_name . $_G ['app'] ['tpl_ext'] . $_G ['app'] ['ext_php'];
	/* 设置编译文件完整路径 */
	$compile_file_name = $compile_path . $compile_name;
	$check_val = 0;
	/* 检查编译文件是否存在,不存在则直接生成 */
	if (check_is_file ( $compile_file_name ) == 1) {
		/* 检查当前模板目录缓存 */
		$cache_config = $_G ['template']->check_cache_dir ( $template_model );
		/* 后台已设置缓存 */
		if (check_is_array ( $cache_config ) == 1) {
			/* 局部缓存cache_time优先 */
			/*检查cache_time是否过期*/
			if (check_cache_time ( $compile_file_name, $cache_time ) == 1) {
				$check_val = 1;
			} else {
				/* 后台设置时间已过期,更新缓存 */
				if (check_cache_time ( $compile_file_name, $cache_config [$template_model] ) == 1) {
					$check_val = 1;
				}
			}
		} else {
			/* 后台未设置缓存,检查cache_time缓存时间 */
			if ($cache_time >= 1) {
				/* 检查cache_time缓存时间是否过期 */
				if (check_cache_time ( $compile_file_name, $cache_time ) == 1) {
					$check_val = 1;
				}
			} else {
				$check_val = 1;
			}
		}
	} else {
		$check_val = 1;
	}
	if ($check_val == 1) {
		/* 检查模板是否更新 */
		if (check_template_time ( $template_file_name, $compile_file_name, md5_str ( $compile_id . $template_name ) ) == 1) {
			parse_template ( $template_file_name, $compile_file_name, compile_header_info ( $template_file_name, md5_str ( $compile_id . $template_name ) ) );
		}
	}
	return $compile_file_name;
}
function modtemplate($template_file = NULL, $compile_id = NULL) {
	global $_G;
	/* 模板主目录 */
	$template_root = $_G ['app'] ['path_source'] . 'module' . DS;
	/* 模板完整路径 */
	$template_file_name = $template_root . $template_file . $_G ['app'] ['tpl_ext'];
	/* 检查模板是否存在 */
	if (check_is_file ( $template_file_name ) < 1) {
		$msg_path = $_G ['web'] ['sourcepath'] . 'module' . DS . $template_file;
		echo lang ( 'global:file_not_exist', $msg_path );
		exit ();
	}
	$template_arr = explode ( '/', $template_file );
	$template_len = count ( $template_arr );
	if ($template_len < 2) {
		echo lang ( 'global:tpl_rule_fail' );
		exit ();
	}
	/* 检查编译文件名id编号是否合法 */
	if ($compile_id != NULL) {
		if (check_num ( $compile_id ) < 1) {
			echo lang ( 'global:tpl_compile_id_fail' );
			exit ();
		} else {
			$compile_id = $compile_id . '_';
		}
	}
	/* 获取模板文件名 */
	$template_name = $template_arr [$template_len - 1];
	unset ( $template_arr [$template_len - 1] );
	/* 取出当前模块名 */
	$template_model = end ( $template_arr );
	/* 取出模块路径 */
	$model_dir = DS . implode ( '/', $template_arr ) . DS;
	/* 设置要编译的目录 */
	$compile_dir = 'template_c' . DS . 'module' . $model_dir;
	$compile_path = $_G ['app'] ['path_data'] . $compile_dir;
	/* 检查编译目录 */
	if (! is_dir ( $compile_path )) {
		if (create_dir ( $_G ['app'] ['path_data'], $compile_dir ) < 1) {
			echo lang ( 'global:dir_open_fail' );
			exit ();
		}
	}
	/* 设置要编译的文件名 */
	/*$compile_name=$compile_id.md5_str($template_name).$_G['app']['ext_php'];*/
	/*$compile_name=$compile_id.md5_str($template_name).'.'.$template_name.$_G['app']['tpl_ext'].$_G['app']['ext_php'];*/
	$compile_name = $compile_id . $template_name . $_G ['app'] ['tpl_ext'] . $_G ['app'] ['ext_php'];
	/* 设置编译文件完整路径 */
	$compile_file_name = $compile_path . $compile_name;
	$check_val = 0;
	/* 检查编译文件是否存在,不存在则直接生成 */
	if (check_is_file ( $compile_file_name ) == 1) {
		/* 检查模板文件是否更新 */
		if (check_template_time ( $template_file_name, $compile_file_name, md5_str ( $compile_id . $template_name ) ) == 1) {
			$check_val = 1;
		} else {
		}
	} else {
		$check_val = 1;
	}
	if ($check_val == 1) {
		parse_template ( $template_file_name, $compile_file_name, compile_header_info ( $template_file_name, md5_str ( $compile_id . $template_name ) ) );
	}
	return $compile_file_name;
}
/* 将模板写入编译 */
function template_write($objfile, $template = NULL) {
	$status = write_file_content ( $objfile, $template );
	if (! $status) {
		$fileNameArr = get_fs ( $objfile, true );
		$ShowFile = str_ireplace ( APP_PATH, '/', $fileNameArr ['dir_name'] );
		echo lang ( 'global:file_not_exist', $ShowFile );
		exit ();
	}
}
/* 获取编译模板内容 */
function get_fetch($file_name = NULL, $_key_name = NULL) {
	global $_G;
	if (check_is_array ( $_key_name ) == 1) {
		foreach ( $_key_name as $_k => $_v ) {
			$_v = (empty ( $_v )) ? 'NULL' : $_v;
			eval ( '$' . $_k . '=' . $_v . ';' );
		}
	}
	/* 检查文件是否存在 */
	if (check_is_file ( $file_name ) == 1) {
		ob_start ();
		include $file_name;
		$content = ob_get_contents ();
		ob_end_clean ();
	} else {
		$content = $file_name;
	}
	return $content;
}
/* 计算缓存时间 */
function check_cache_time($file_name = NULL, $cache_time = 0) {
	global $_G;
	$newtime = ( int ) $_G ['app'] ['sys_time'];
	$filetime = ( int ) filemtime ( $file_name );
	if (($newtime - $filetime) > $cache_time) {
		return 1;
	}
	return 0;
}
/* 获取文件时间 */
function filetime($file_name = NULL) {
	if (check_is_file ( $file_name ) == 1) {
		$ftime = ( int ) filemtime ( $file_name );
	} else {
		$ftime = 0;
	}
	return $ftime;
}
/* 检查模板是否更新 */
function check_template_time($template_file = NULL, $compile_file = NULL, $valid_key = NULL) {
	/* 包含编译文件 */
	if (check_is_file ( $compile_file ) == 1) {
		$compile_content = file_get_contents ( $compile_file );
		/* 匹配模板文件信息 */
		if (! preg_match ( "/\_file_valid(.+?)\);/ies", $compile_content, $_val )) {
			$check_val = 1;
		} else {
			$check_val = 0;
			@eval ( '$' . $_val [0] . ';' );
		}
	}
	if ($check_val != 1) {
		/* 获取模板最后更新时间 */
		$t_time = filetime ( $template_file );
		$check_val = ($t_time == $_file_valid [$valid_key] ['file_time']) ? 0 : 1;
		unset ( $_file_valid );
	}
	return $check_val;
}
/* 清除模板缓存 */
function clear_cache($cache_file = NULL, $cache_id = NULL) {
}
/* 清除模板编译文件 */
function clear_compile($compile_file = NULL, $compile_id = NULL) {
}
function db_fetch_array($result) {
	global $_G;
	$result = $_G ['db']->fetch_array ( $result );
	return $result;
}
function transamp($str) {
	$str = str_replace ( '&', '&amp;', $str );
	$str = str_replace ( '&amp;amp;', '&amp;', $str );
	$str = str_replace ( '\"', '"', $str );
	return $str;
}
function addquote($var) {
	return str_replace ( "\\\"", "\"", preg_replace ( "/\[([a-zA-Z0-9_\-\.\x7f-\xff]+)\]/s", "['\\1']", $var ) );
}
function stripvtags($expr, $statement) {
	$expr = str_replace ( "\\\"", "\"", preg_replace ( "/\<\?\=(\\\$.+?)\?\>/s", "\\1", $expr ) );
	$statement = str_replace ( "\\\"", "\"", $statement );
	return $expr . $statement;
}
function stripscriptamp($script, $src) {
	$s = str_replace ( '&amp;', '&', $src );
	$search = array (
			$src,
			'\"' 
	);
	$replace = array (
			$s,
			'"' 
	);
	return str_replace ( $search, $replace, $script );
}
function strip_url($expr, $statement) {
	$expr = str_replace ( "\\\"", "\"", preg_replace ( "/\<\?\=(\\\$.+?)\?\>/s", "{\\1}", $expr ) );
	$statement = str_replace ( "\\\"", "\"", $statement );
	return $expr . $statement;
}
function strip_cj_module_tag($module, $param, $old_content = NULL) {
	/* 解析内容 */
	$_unTagContent = NULL;
	/* 模块 */
	$module = trim ( $module );
	/* 参数 */
	$param = str_stripslashes ( $param );
	/* 匹配函数是否存在 */
	preg_match_all ( "/(function)\=[\"]?([^\"]+)[\"]?/i", $param, $tagfunc, PREG_SET_ORDER );
	/* 获取函数 */
	$tagfunc = trim ( array_key_val ( 2, array_key_val ( 0, $tagfunc ) ) );
	global $_G;
	/* 载入标签 */
	hook_template_tag ( $module, $tagfunc );
	/* 标签函数是否存在 */
	$_funcName = '_hook_tag_' . $module . '_' . $tagfunc;
	/* 初始化解析内容 */
	$_unTagContent = "<?php hook_template_tag('{$module}','{$tagfunc}'); if(function_exists('" . $_funcName . "')){ ?>";
	if (! function_exists ( $_funcName )) {
		return $_unTagContent;
	}
	/* 解析参数 */
	$matchs = array ();
	preg_match_all ( "/([a-z]+)\=[\"]?([^\"]+)[\"]?/i", $param, $matchs, PREG_SET_ORDER );
	/* 调用该标签 */
	$_unTagContent .= $_funcName ( $module, $tagfunc, $matchs, $old_content );
	return $_unTagContent;
}
function strip_field($param, $content) {
	$arr = explode ( '.', $param );
	$str = '$' . $arr [0];
	if (count ( $arr ) > 1) {
		unset ( $arr [0] );
		foreach ( $arr as $val ) {
			$val = trim ( $val );
			if (strpos ( $val, '$' ) === 0) {
				$str .= '[' . $val . ']';
			} else {
				$str .= '[\'' . $val . '\']';
			}
		}
	}
	$str = "<?php echo " . $str . "; ?>";
	return $str;
}
?>