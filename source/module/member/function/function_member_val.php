<?php
if (! defined ( 'APP_PATH' )) {
	exit ( 'no direct access allowed' );
}

/* 获取配置参数 */
function member_value_get($m_key, $_key = NULL, $_kk = 'val', $_default_val = NULL) {
	$val = $_default_val;
	$arr = member_value ( $m_key );
	if (check_is_key ( $_key, $arr ) == 1) {
		$d = (str_len ( $_kk ) < 1) ? $arr [$_key] : $_default_val;
		$val = array_key_val ( $_kk, $arr [$_key], $d );
	} else {
		$val = (str_len ( $_key ) < 1) ? $arr : $_default_val;
	}
	unset ( $arr );
	return $val;
}
/* 获取初始化配置值 */
function member_config_get($_key = NULL, $_kk = NULL, $defaultVal = NULL) {
	$arr = member_value_get ( 'config' );
	if (check_is_key ( $_key, $arr ) == 1) {
		$d = (strlen ( $_kk ) < 1) ? $arr [$_key] : $defaultVal;
		$val = array_key_val ( $_kk, $arr [$_key], $d );
	} else {
		$val = (strlen ( $_key ) < 1) ? $arr : $defaultVal;
	}
	return $val;
}
/* 会员_状态参数 */
function member_status($_key = 'normal', $defaultVal = NULL) {
	$val = $defaultVal;
	$arr = member_value ( 'status' );
	if (check_is_key ( $_key, $arr ) == 1) {
		$val = array_key_val ( 'val', $arr [$_key] );
	}
	return $val;
}
/* 会员_状态参数 */
function member_avatar_status($_key = 'normal', $default_val = NULL) {
	$val = $default_val;
	$arr = member_value ( 'avatar_status' );
	if (check_is_key ( $_key, $arr ) == 1) {
		$val = array_key_val ( 'val', $arr [$_key] );
	}
	return $val;
}
/* 检查会员进入 */
function member_access($isexit = true) {
	$mObj = loader ( 'class:class_member', 'member', true, true );
	$result = $mObj->member_access ( $isexit );
	return $result;
}
/* 邮箱验证状态 */
function member_email_status($_key = NULL, $_kk = 'val', $default_val = NULL) {
	$val = $default_val;
	$arr = member_value ( 'email_status' );
	if (check_is_key ( $_key, $arr ) == 1) {
		$d = (str_len ( $_kk ) < 1) ? $arr [$_key] : $_default_val;
		$val = array_key_val ( $_kk, $arr [$_key], $d );
	} else {
		$val = (str_len ( $_key ) < 1) ? $arr : $_default_val;
	}
	unset ( $arr );
	return $val;
}
/* 头像状态 */
function member_head_status($_key = NULL, $default_val = NULL) {
	$val = $default_val;
	$arr = member_value ( 'head_status' );
	if (check_is_key ( $_key, $arr ) == 1) {
		$val = array_key_val ( 'val', $arr [$_key], $default_val );
	}
	unset ( $arr );
	return $val;
}
/* 按groupid获取用户组 */
function member_group_query($groupid, $fieldname = NULL) {
	if (check_nums ( $groupid ) < 1) {
		return NULL;
	}
	global $_G;
	$mg = loader ( 'class:class_member_group', 'member', true, true );
	$group = $mg->group_query ( 'groupid', $groupid );
	if (check_is_array ( $group ) < 1) {
		return NULL;
	}
	if (! empty ( $fieldname )) {
		$val = array_key_val ( $fieldname, $group );
	} else {
		$val = $group;
	}
	return $val;
}
/* 按类型(如:member)获取用户组 */
function member_group_getlist($grouptype = NULL) {
	global $_G;
	$grouptype = member_grouptype ( $grouptype );
	$gObj = loader ( 'class:class_member_group', 'member', true, true );
	$result = $gObj->group_list ( $grouptype );
	if ($result == $gObj->db->cw) {
		return NULL;
	}
	return $result;
}
/* 按组和模块获取组配置 */
function groupset_query($groupid, $module, $setting_de = false) {
	if (check_nums ( $groupid ) < 1) {
		return NULL;
	}
	global $_G;
	$gObj = loader ( 'class:class_member_group', 'member', true, true );
	$result = $gObj->groupset_query ( array (
			'groupid' => $groupid,
			'module' => $module 
	) );
	if (check_is_array ( $result ) < 1) {
		return NULL;
	}
	if ($setting_de === true) {
		$val = de_serialize ( $result ['setting'] );
	} else {
		$val = $result;
	}
	return $val;
}
/* 获取字段操作项 */
function member_term_check($term_key) {
	$term_val = NULL;
	$term_arr = dc_value ( 'member_stop_term' );
	if (check_is_key ( $term_key, $term_arr ) == 1) {
		$term_key = array_key_val ( $term_key, $term_arr );
		$term_val = array_key_val ( 'v_val', $term_key );
	}
	unset ( $term_key, $term_arr );
	return $term_val;
}
/* 检查会员状态 */
function member_status_check($member) {
	/* 检查状态 */
	if (check_nums ( array_key_val ( 'disabled', $member ) < 1 )) {
		/* 初始状态返回值 */
		$status_str = NULL;
		/* 初始化状态 */
		$status = dc_value ( 'member_status' );
		switch (array_key_val ( 'status', $member )) {
			case array_key_val ( 'v_val', $status ['normal'] ) :
				// $status_str=array_key_val('v_key',$status['normal']);
				return 1;
				break;
			case array_key_val ( 'v_val', $status ['everify'] ) :
				if (array_key_val ( 'email_auth', $member ) != 1) {
					$status_str = array_key_val ( 'v_key', $status ['everify'] );
					$status_href = modelurl ( 1020 );
				} else {
					return 1;
				}
				break;
			case array_key_val ( 'v_val', $status ['check'] ) :
				$status_str = array_key_val ( 'v_key', $status ['check'] );
				$status_href = get_home ( true );
				break;
			case array_key_val ( 'v_val', $status ['stop'] ) :
				$status_str = array_key_val ( 'v_key', $status ['stop'] );
				$status_href = get_home ( true );
				break;
			case array_key_val ( 'v_val', $status ['recycle'] ) :
				$status_str = array_key_val ( 'v_key', $status ['recycle'] );
				$status_href = get_home ( true );
				break;
			default :
				$status_str = 'undefined';
				$status_href = get_home ( true );
				break;
		}
		unset ( $member, $status );
		$status_val = array (
				'msg_status' => $status_str,
				'msg_href' => $status_href 
		);
		return $status_val;
	} else {
		return 1;
	}
}
/* 会员主页 */
function member_index($uid = NULL, $param = NULL) {
	$urlParam == NULL;
	if (check_nums ( $uid ) == 1) {
		$urlParam .= '/uid/' . $uid;
	}
	$url = url ( 'index', 'mod/member/ac/index' . $urlParam );
	return $url;
}
/* 默认头像 */
function member_default_avatar() {
	global $_G;
	$d = $_G ['web'] ['templatepath'] . 'member/image/default_avatar.png';
	return $d;
}
/* 头像获取 */
function member_avatar($uid, $isfull = false) {
	if (check_nums ( $uid ) < 1) {
		return NULL;
	}
	global $_G;
	$mh = loader ( 'class:class_member_avatar', 'member', true, true );
	$result = $mh->avatar_query ( 'uid', $uid );
	if ($isfull != true) {
		$result = array_key_val ( 'file_name', $result );
		;
	} else {
		if (check_is_array ( $result )) {
			$result = show_uf ( $result ['file_name'] );
		} else {
			$result = member_default_avatar ();
		}
	}
	return $result;
}
/* 获取会员 */
function member_query($uid, $isprofile = true) {
	if (check_nums ( $uid ) < 1) {
		return NULL;
	}
	global $_G;
	$m = loader ( 'class:class_member', 'member', true, true );
	$member = $m->member_query ( 'uid', $uid );
	if (check_is_array ( $member ) < 1) {
		return NULL;
	}
	/* 如果昵称为空,则用户名作为昵称 */
	if (empty ( $member ['nickname'] )) {
		$member ['nickname'] = $member ['username'];
	}
	if ($isprofile === true) {
		$p = loader ( 'class:class_member_profile', 'member', true, true );
		$profile = $p->profile_query ( 'uid', $uid );
		if (check_is_array ( $profile ) == 1) {
			unset ( $profile ['uid'] );
			$member = array_merge ( $member, $profile );
		}
		unset ( $profile );
	}
	return $member;
}
/* 会员地址解析 */
function member_address($str, $sign_str = ',', $arr_end = true) {
	if (str_len ( $str ) < 1) {
		return $str;
	}
	$val = explode_str ( $str, $sign_str, false, true );
	if (check_is_array ( $val ) < 1) {
		return $str;
	}
	if ($arr_end == true) {
		$val = end ( $val );
	}
	return $val;
}
/* 解析居住地址 */
function member_de_area($param_areaid, $param_spilt = NULL, $param_defaul = NULL) {
	if (str_len ( $param_areaid ) < 1) {
		return NULL;
	}
	/* 当为一级的时候 */
	if (check_is_array ( $param_areaid ) == 1) {
		$areaid = $param_areaid;
	} else {
		list ( , , $areaid ) = explode_str ( $param_areaid, ',', true, true );
	}
	global $_G;
	$m = loader ( 'class:class_member_area', 'member', true, true );
	$area = $m->area_nav ( $areaid );
	$area_val = array_join_str ( $param_spilt, array_key_val ( 'name_arr', $area ) );
	unset ( $m, $area );
	return $area_val;
}
/* 取出会员标签 */
function member_tagof($uid) {
	if (str_len ( $uid ) < 1) {
		return NULL;
	}
	$m = loader ( 'class:class_member_tag', 'member', true, true );
	$result = $m->tagof_get ( $uid );
	return $result;
}
/* 检查是否关注 */
function member_is_follow($follow_uid) {
	if (check_nums ( $follow_uid ) < 1) {
		return NULL;
	}
	global $_G;
	$uid = get_user ( 'uid' );
	$m = loader ( 'class:class_member_friend', 'member', true, true );
	$frs = $m->friend_query ( array (
			'follow_uid' => $follow_uid,
			'fans_uid' => $uid 
	) );
	if (check_is_array ( $frs ) < 1) {
		return NULL;
	}
	return 1;
}
/* 检查是否相互关注 */
function member_is_same_follow($follow_uid) {
	if (check_nums ( $follow_uid ) < 1) {
		return NULL;
	}
	global $_G;
	$uid = get_user ( 'uid' );
	if ($follow_uid == $uid) {
		return NULL;
	}
	/* 检查是否关注该会员 */
	$m = loader ( 'class:class_member_friend', 'member', true, true );
	$frs = $m->friend_query ( array (
			'follow_uid' => $follow_uid,
			'fans_uid' => $uid 
	) );
	if (check_is_array ( $frs ) < 1) {
		return NULL;
	}
	/* 检查该会员是否关注我 */
	$frs = $m->friend_query ( array (
			'follow_uid' => $uid,
			'fans_uid' => $follow_uid 
	) );
	if (check_is_array ( $frs ) < 1) {
		return NULL;
	}
	return 1;
}
/* 关注统计 */
function member_follow_count($uid) {
	if (check_nums ( $uid ) < 1) {
		return NULL;
	}
	global $_G;
	$m = loader ( 'class:class_member_friend', 'member', true, true );
	$result = $m->friend_count ( 'fans_uid', $uid );
	unset ( $m );
	return $result;
}
/* 粉丝统计 */
function member_fans_count($uid) {
	if (check_nums ( $uid ) < 1) {
		return NULL;
	}
	global $_G;
	$m = loader ( 'class:class_member_friend', 'member', true, true );
	$result = $m->friend_count ( 'follow_uid', $uid );
	unset ( $m );
	return $result;
}
/* 未读通知统计 */
function member_notice_count($uid) {
	if (check_nums ( $uid ) < 1) {
		return NULL;
	}
	global $_G;
	$isview = yesno_val ( 'check' );
	$m = loader ( 'class:class_member_notice', 'member', true, true );
	$result = $m->notice_count ( array (
			'inboxuid' => $uid,
			'isview' => $isview 
	) );
	unset ( $m );
	return $result;
}
/* 未读消息统计 */
function member_message_count($uid) {
	if (check_nums ( $uid ) < 1) {
		return NULL;
	}
	global $_G;
	$isview = yesno_val ( 'check' );
	$m = loader ( 'class:class_member_message', 'member', true, true );
	$result = $m->message_count ( array (
			'inboxuid' => $uid,
			'isview' => $isview 
	) );
	unset ( $m );
	return $result;
}
/* 主题模板类型匹配 */
function member_subject_template($_key, $default_val = NULL) {
	$status_val = NULL;
	$status_arr = member_value ( 'subject_template' );
	if (check_is_key ( $_key, $status_arr ) == 1) {
		$status_val = $status_arr [$_key] ['val'];
	}
	unset ( $status_arr );
	return $status_val;
}
/* 获取指定获取会员组配置值 */
function member_grouptype($_key = NULL, $_kk = 'field', $_defaultVal = NULL) {
	$arr = member_value ( 'group_type' );
	if (check_is_key ( $_key, $arr ) == 1) {
		$d = (strlen ( $_kk ) < 1) ? $arr [$_key] : $_defaultVal;
		$val = array_key_val ( $_kk, $arr [$_key], $d );
	} else {
		$val = (! empty ( $_key )) ? $_defaultVal : $arr;
	}
	return $val;
}
/* 获取指定消息类型值 */
function member_message_type_val($_key = NULL, $_kk = 'field', $_default_val = NULL) {
	$val = $_default_val;
	$arr = member_value ( 'message_type' );
	if (check_is_key ( $_key, $arr ) == 1) {
		$d = (str_len ( $_kk ) < 1) ? $arr [$_key] : $_default_val;
		$val = array_key_val ( $_kk, $arr [$_key], $d );
	}
	unset ( $arr );
	return $val;
}
/* 获取指定消息盒状态值 */
function member_message_box_status($_key = NULL, $_kk = 'val', $_default_val = NULL) {
	$val = $_default_val;
	$arr = member_value ( 'message_box_status' );
	if (check_is_key ( $_key, $arr ) == 1) {
		$d = (str_len ( $_kk ) < 1) ? $arr [$_key] : $_default_val;
		$val = array_key_val ( $_kk, $arr [$_key], $d );
	}
	unset ( $arr );
	return $val;
}
/* 获取会员组权限值 */
function member_group_access_get($uid, $groupid) {
	if (check_nums ( $uid ) < 1) {
		return NULL;
	}
	if (check_nums ( $groupid ) < 1) {
		return NULL;
	}
	global $_G;
}
/* 获取积分 */
function member_credit($uid, $iscore = 0) {
	if (check_nums ( $uid ) < 1) {
		return NULL;
	}
	$creditCoreKey = 'credit0';
	$creditfieldData = NULL;
	/* 已启用的积分字段 */
	$creditfield = common_creditfield ( NULL );
	if (check_is_array ( $creditfield ) < 1) {
		return NULL;
	}
	/* 会员积分 */
	$mcObj = loader ( 'class:class_member_credit', 'member', true, true );
	$qrs = $mcObj->member_credit_query ( 'uid', $uid );
	if ($qrs == $mcObj->db->cw) {
		return NULL;
	}
	/* 是否排除固定的积分字段 */
	if ($iscore != 1) {
		if (array_key_exists ( $creditCoreKey, $creditfield )) {
			unset ( $creditfield [$creditCoreKey] );
		}
		foreach ( $creditfield as $k => $v ) {
			$v ['number'] = getchecknum ( array_key_val ( $v ['field'], $qrs ), 0 );
			$creditfieldData [$v ['field']] = $v;
		}
	} else {
		foreach ( $creditfield as $k => $v ) {
			if ($creditCoreKey != $v ['field']) {
				continue;
			}
			$v ['number'] = getchecknum ( array_key_val ( $v ['field'], $qrs ), 0 );
			$creditfieldData [$v ['field']] = $v;
			break;
		}
	}
	return $creditfieldData;
}
?>