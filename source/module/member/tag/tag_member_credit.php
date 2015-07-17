<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}

if (! function_exists ( '_hook_tag_member_credit' )) {
	function _hook_tag_member_credit($module, $tagfunc, $matchs, $old_content = NULL) {
		/* 默认值 */
		$defaultVal = array (
				'return' => 'result' 
		);
		/* 标签参数 */
		$tagAttr = array (
				'where' => '',
				'sql' => '',
				'return' => $defaultVal ['return'] 
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
		/* 清除不需要的值 */
		unset ( $defaultVal, $tagAttr ['function'], $tagAttr ['return'] );
		/* ----------------------------------------------- */
		$_unTagContent = "<?php " . $s . $sysVarName . " = tag_member_credit(" . arraytostr ( $tagAttr ) . "); ";
		$_unTagContent .= $s . $return . " = " . $s . $sysVarName . "; unset(" . $s . $sysVarName . "); ?>";
		return $_unTagContent;
	}
	function tag_member_credit($data) {
		/* 如果没有设置uid,则取当前会员的 */
		if (check_is_key ( 'uid', $data ) == 1) {
			$uid = array_key_val ( 'uid', $data );
		} else {
			$uid = get_user ( 'uid' );
		}
		/* 获取核心(credit0)字段,为0则清除该字段,为1则只获取该字段 */
		$iscore = trim ( array_key_val ( 'iscore', $data, 0 ) );
		if (check_nums ( $uid ) < 1) {
			return NULL;
		}
		/* 获取会员组 */
		$MG = loader ( 'class:class_member_group', 'member', true, true );
		
		/* 开启事务 */
		$MG->db->trans_begin ();
		$groupResult = $MG->group_init ( $uid, true );
		if (! is_array ( $groupResult )) {
			/* 结束事物 */
			$MG->db->trans_rollback_end ();
			$groupResult = NULL;
		}
		/* 提交事务 */
		$MG->db->trans_commit_end ();
		unset ( $MG );
		
		/* 获取积分 */
		$creditResult = member_credit ( $uid, $iscore );
		$data = array (
				$creditResult,
				$groupResult 
		);
		return $data;
	}
}
?>