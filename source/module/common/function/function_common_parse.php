<?php
if (! defined ( 'APP_PATH' )) {
	exit ( 'no direct access allowed' );
}

/**
 * *
 * ** 模块数据部分解析
 */
function common_datablock_parse($module, $dcid, $template = NULL) {
	$nest = 5;
	$inserstr = '{loop_result_loop}';
	$match = array ();
	
	if (! preg_match ( "/[\n\r\t]*\{loop\}[\n\r\t]*(.+?)[\n\r\t]*\{\/loop\}[\n\r\t]*/ies", $template, $match )) {
		return $template;
	}
	$match = $match [1];
	/* 循环体 */
	$template = preg_replace ( "/[\n\r\t]*\{loop\}[\n\r\t]*(.+?)[\n\r\t]*\{\/loop\}[\n\r\t]*/ies", "stripvtags('$inserstr','')", $template );
	/* 索引判断 */
	$match = preg_replace ( "/[\n\r\t]*\{elseindex\=([0-9]|[1-9][0-9]+)\}[\n\r\t]*/ies", "stripvtags('<?php } elseif(\$index==\\1) { ?>','')", $match );
	/* else */
	$match = preg_replace ( "/[\n\r\t]*\{else\}[\n\r\t]*/is", "<?php } else { ?>", $match );
	for($i = 0; $i < $nest; $i ++) {
		/* 索引 */
		$match = preg_replace ( "/[\n\r\t]*\{index\=([0-9]|[1-9][0-9]+)\}[\n\r\t]*(.+?)[\n\r\t]*\{\/index\}[\n\r\t]*/ies", "stripvtags('<?php if(\$index==\\1){ ?>','\\2<?php return NULL; } ?>')", $match );
		/* 求余 */
		$match = preg_replace ( "/[\n\r\t]*\{mod\=([0-9]|[1-9][0-9]+)\}[\n\r\t]*(.+?)[\n\r\t]*\{\/mod\}[\n\r\t]*/ies", "stripvtags('<?php if(\$index%\\1<1){ ?>','\\2<?php return NULL; } ?>')", $match );
		/* 奇数 */
		$match = preg_replace ( "/[\n\r\t]*\{listorder\=odd\}[\n\r\t]*(.+?)[\n\r\t]*\{\/listorder\}[\n\r\t]*/ies", "stripvtags('<?php if(\$index%2==1){ ?>','\\1<?php } ?>')", $match );
		/* 偶数 */
		$match = preg_replace ( "/[\n\r\t]*\{listorder\=even\}[\n\r\t]*(.+?)[\n\r\t]*\{\/listorder\}[\n\r\t]*/ies", "stripvtags('<?php if(\$index%2<1){ ?>','\\1<?php } ?>')", $match );
	}
	/* 解析模块变量 */
	$func = $module . '_databock_variable';
	if (check_is_fun ( $func ) == 1) {
		$variable = $func ();
		if (check_is_array ( $variable ) == 1) {
			foreach ( $variable as $key => $val ) {
				$field = array_key_val ( 'field', $val );
				$level = array_key_val ( 'level', $val, 0 );
				if ($level < 1) {
					$match = preg_replace ( "/[\n\r\t]*\{{$field}\}[\n\r\t]*/ies", "stripvtags('<?php echo \$data[\'{$key}\']; ?>','')", $match );
				} else {
					$parse = trim_addslashes ( array_key_val ( 'parse', $val ) );
					$match = preg_replace ( "/[\n\r\t]*\{{$field}\}[\n\r\t]*/ies", "stripvtags('{$parse}','')", $match );
				}
			}
		}
	}
	/* 生成编译文件 */
	template_write ( common_datablock_file ( $dcid, true ), $match );
	/* 或返回值 */
	return array (
			$template,
			$match,
			$inserstr 
	);
}
function common_datablock_file($dcid, $create = false) {
	global $_G;
	$dirroot = $_G ['app'] ['path_data'];
	$dirname = 'datablock';
	$datafile = $dirroot . $dirname . $_G ['app'] ['ds'] . $dcid . $_G ['app'] ['ext_php'];
	if ($create === true) {
		create_dir ( $dirroot, $dirname );
	}
	return $datafile;
}
function common_datablock_db($dcid, $data, $content, $index) {
	$datafile = common_datablock_file ( $dcid );
	if (check_is_file ( $datafile ) < 1)
		return NULL;
	include $datafile;
}
?>