<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}

$module = _M ();

/* 回调参数 */
$callFunc = msg_func ();
$callFunc_b = msg_func ( 'callFunc_b' );

/* 数据库管理类 */
$MMysql = loader ( 'class:class_admin_database', $module, true, true );
$db = $MMysql->db;

/* 获取sql语句 */
$sqlContent = post_param ( 'sql_content' );
$sqlContent = str_replace ( "\r", '', $sqlContent );

$nStr = "\n";
$lStr = '----------------------------------------------------------------------------------------';
/* sql语句统计变量 */
$sqlContentIndex = 0;
/* 显示信息缓存变量 */
$printStr = '';

/* 是否存在多条语句 */
if (! empty ( $sqlContent )) {
	
	$sqlContentArr = split ( ";[ \t]{0,}\n", $sqlContent );
	$sqlContentLen = count ( $sqlContentArr );
	
	foreach ( $sqlContentArr as $sqlStr ) {
		$sqlStr = stripslashes ( stripslashes ( trim ( $sqlStr ) ) );
		$sqlStr = str_replace ( "\n", ' ', $sqlStr );
		
		if (empty ( $sqlStr )) {
			continue;
		}
		
		$sqlContentIndex ++;
		/* 加上sql语句结束符号(;) */
		if ($sqlContentIndex != $sqlContentLen)
			$sqlStr .= ';';
		
		$printStr .= $lStr . $nStr;
		$printStr .= '执行 SQL 语句第 ' . $sqlContentIndex . ' 条: ' . $sqlStr . $nStr;
		$printStr .= $lStr . $nStr;
		
		/* 屏蔽drop */
		if (preg_match_all ( "/^drop\s+(.+?)/i", $sqlStr, $sqlMatchNoAllow )) {
			$printStr .= lang ( 'admin:database_sqlquery_drop_noallow' ) . $nStr;
			continue;
		}
		if (! preg_match_all ( "/^(select|show|update|delete|create|alter|insert)\s+(.+?);/i", $sqlStr, $sqlMatch, PREG_PATTERN_ORDER )) {
			$printStr .= lang ( 'admin:database_sqlquery_fail' ) . $nStr;
			continue;
		}
		
		/* 如果为select */
		if (substr ( strtolower ( $sqlStr ), 0, 6 ) == 'select' && strpos ( $sqlStr, "()" ) === false) {
			/* 执行sql */
			$result = $db->_query ( $sqlStr );
			if ($result == $db->cw) {
				$printStr .= lang ( 'admin:database_sqlquery_fail' ) . $nStr;
				continue;
			}
			$result = $db->result;
			/* 记录数 */
			$RsNum = $db->db_num_rows ();
			if ($RsNum < 1) {
				$printStr .= lang ( 'admin:database_sqlquery_rows_null' ) . $nStr;
				continue;
			}
			/* 返回最大记录条数 */
			$sNum = 100;
			/* 计算有多少记录 */
			$index = 0;
			
			$printStr .= '共找到记录: ' . $RsNum . ' 条 , 最大返回记录: ' . $sNum . ' 条';
			$printStr .= $nStr;
			while ( $Rs = $db->fetch_assoc ( $result ) ) {
				$index ++;
				$printStr .= $lStr . $nStr;
				$printStr .= "第 {$index} 条记录:";
				$printStr .= $nStr . $lStr . $nStr;
				foreach ( $Rs as $k => $v ) {
					$printStr .= "{$k} : {$v}";
					$printStr .= $nStr;
				}
				if ($index >= $sNum) {
					break;
				}
			}
		} else if (preg_match_all ( "/^(insert|update|delete)\s+(.+?);/i", $sqlStr, $sqlMatchAffected )) {
			/* 执行sql */
			$result = $db->_query ( $sqlStr );
			if ($result == $db->cw) {
				$printStr .= lang ( 'admin:database_sqlquery_fail' ) . $nStr;
				continue;
			}
			$affectedRow = $db->db_affected_rows ();
			
			$printStr .= $affectedRow . ' 行受影响' . $nStr;
		}
	}
} else {
	$printStr .= lang ( 'admin:database_sqlquery_null' ) . $nStr;
}
$printStr .= $nStr;
showmsg ( $printStr, NULL, $callFunc_b );
?>