<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}

if (! function_exists ( '_hook_tag_common_category' )) {
	function _hook_tag_common_category($module, $tagfunc, $matchs, $old_content = NULL) {
		/* 默认值 */
		$defaultVal = array (
				'return' => 'result',
				'returnpage' => '_result_page' 
		);
		/* 标签参数 */
		$tagAttr = array (
				'where' => '',
				'sql' => '',
				'cache' => 0,
				'start' => 0,
				'offset' => 20,
				'orderby' => '',
				'page' => 'get/page',
				'pagenum' => 7,
				'return' => $defaultVal ['return'],
				'returnpage' => $defaultVal ['returnpage'] 
		);
		/* 设置参数 */
		foreach ( $matchs as $val ) {
			$val [1] = strtolower ( trim ( $val [1] ) );
			$val [2] = trim ( $val [2] );
			if (check_is_key ( $val [1], $tagAttr ) == 1) {
				$tagAttr [$val [1]] = $val [2];
				continue;
			}
			$tagAttr [$val [1]] = $val [2];
		}
		unset ( $matchs );
		/* 变量符号 */
		$s = '$';
		/* 随机数 */
		$randstr = getrand ( 6, 2 );
		/* 初始化一个系统变量 */
		$sysVarName = '_setValue_' . $randstr;
		/* ----------------------------------------------- */
	/*返回参数名*/
	$return = $tagAttr ['return'];
		if (check_enl_el ( $return ) < 1) {
			$return = $defaultVal ['return'];
		}
		/* 返回分页参数名 */
		$returnpage = $tagAttr ['returnpage'];
		if (check_enl_el ( $returnpage ) < 1) {
			$returnpage = $defaultVal ['returnpage'];
		}
		/* 清除不需要的值 */
		unset ( $defaultVal, $tagAttr ['function'], $tagAttr ['return'], $tagAttr ['returnpage'] );
		/* ----------------------------------------------- */
		$_unTagContent = "<?php " . $s . $sysVarName . " = tag_common_category(" . arraytostr ( $tagAttr ) . "); ";
		$_unTagContent .= $s . $returnpage . " = array_key_val(0," . $s . $sysVarName . "); ";
		$_unTagContent .= $s . $return . " = array_key_val(1," . $s . $sysVarName . "); ?>";
		return $_unTagContent;
	}
	function tag_common_category($data) {
		$cObj = loader ( 'class:class_common_category', 'common', true, true );
		$db = $cObj->db;
		/* 页码 */
		$page = de_page_param ( array_key_val ( 'page', $data ) );
		/* 排序 */
		$orderby = de_db_orderby ( array_key_val ( 'orderby', $data ), 'listorder,ASC' );
		/* 可用状态 */
		$normal = yesno_val ( 'normal' );
		/* 分类id */
		$catid = array_key_val ( 'catid', $data );
		
		$db->from ( $cObj->table_common_category );
		if (str_len ( array_key_val ( 'where', $data ) ) < 1) {
			if (check_nums ( $catid ) == 1) {
				$db->where ( 'catids', $catid );
			}
			$db->where ( 'disabled', $normal );
		} else {
			$db->set_where ( $data ['where'] );
		}
		/* 获取总数 */
		$total_num = $db->count_num ();
		/* 计算分页 */
		$pg = pagephow ( $total_num, $data ['offset'], $data ['pagenum'], $page );
		$db->order_by ( $orderby );
		$db->limit ( $pg ['first_count'], $pg ['page_size'] );
		$result = $db->select ();
		if ($result == $db->cw) {
			return $result;
		}
		$result = $db->get_list ();
		return array (
				$pg,
				$result 
		);
	}
}
?>