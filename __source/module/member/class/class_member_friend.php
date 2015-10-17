<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}

loader ( 'class:class_member', 'member', true );
class class_member_friend extends class_member {
	public $table_member_friend = 'member_friend';
	
	/* 析构函数 */
	function __construct() {
		parent::__construct ();
	}
	function class_member_friend() {
		$this->__construct ();
	}
	
	/* 查询 */
	function friend_query($_key, $_val = NULL) {
		$this->db->from ( $this->table_member_friend );
		$this->db->where ( $_key, $_val );
		$result = $this->db->select ();
		if ($result == $this->db->cw) {
			return $result;
		}
		$result = $this->db->get_one ();
		return $result;
	}
	/* 统计 */
	function friend_count($_key, $_val = NULL) {
		$this->db->from ( $this->table_member_friend );
		$this->db->where ( $_key, $_val );
		$result = $this->db->count_num ();
		$this->db->clear_sql ();
		if ($result == $this->db->cw) {
			$result = 0;
		}
		return $result;
	}
	/* 添加关注 */
	function follow_add($follow_uid) {
		sleep ( 1 );
		/* 回调参数 */
		$callFunc = msg_func ();
		$callFunc_b = msg_func ( 'callFunc_b' );
		
		/* 检查参数 */
		if (check_nums ( $follow_uid ) < 1) {
			showmsg ( lang ( 'common:param_id_fail' ), NULL, $callFunc );
		}
		$uid = get_user ( 'uid' );
		if ($follow_uid == $uid) {
			showmsg ( lang ( 'member:follow_uid_self' ), NULL, $callFunc );
		}
		/* 检查关注会员是否存在 */
		$memberRs = $this->member_query ( 'uid', $follow_uid );
		if ($memberRs == $this->db->cw) {
			showmsg ( lang ( 'common:dbexception' ), NULL, $callFunc );
		}
		if (check_is_array ( $memberRs ) < 1) {
			showmsg ( lang ( 'member:uid_get_noexist' ), NULL, $callFunc );
		}
		/* 检查是否关注过 */
		$frs = $this->friend_query ( array (
				'follow_uid' => $follow_uid,
				'fans_uid' => $uid 
		) );
		if ($frs == $this->db->cw) {
			showmsg ( lang ( 'common:dbexception' ), NULL, $callFunc );
		}
		/* 如果不存在关注,则关注操作 */
		if (check_is_array ( $frs ) == 1) {
			showmsg ( lang ( 'member:follow_exist' ), NULL, $callFunc_b );
		}
		/* 初始化参数 */
		$dataArr = array (
				'follow_uid' => $follow_uid,
				'fans_uid' => $uid,
				'ctime' => $this->sys_time 
		);
		$result = $this->db->db_insert ( $this->table_member_friend, $dataArr );
		if ($result == $this->db->cw) {
			showmsg ( lang ( 'common:dbexception' ), NULL, $callFunc );
		}
		showmsg ( lang ( 'member:follow_success' ), NULL, $callFunc_b );
	}
	/* 取消关注 */
	function follow_del($follow_uid) {
		sleep ( 1 );
		/* 回调参数 */
		$callFunc = msg_func ();
		$callFunc_b = msg_func ( 'callFunc_b' );
		
		/* 当前会员 */
		$uid = get_user ( 'uid' );
		/* 检查参数 */
		if (check_nums ( $follow_uid ) < 1) {
			showmsg ( lang ( 'common:param_id_fail' ), NULL, $callFunc );
		}
		/* 检查是否关注过 */
		$frs = $this->friend_query ( array (
				'follow_uid' => $follow_uid,
				'fans_uid' => $uid 
		) );
		if ($frs == $this->db->cw) {
			showmsg ( lang ( 'common:dbexception' ), NULL, $callFunc );
		}
		if (check_is_array ( $frs ) < 1) {
			showmsg ( lang ( 'member:follow_noexist' ), NULL, $callFunc_b );
		}
		/* 取消操作 */
		$result = $this->db->db_delete ( $this->table_member_friend, 'friendid', $frs ['friendid'] );
		if ($result == $this->db->cw) {
			showmsg ( lang ( 'common:dbexception' ), NULL, $callFunc );
		}
		/* 取消成功 */
		showmsg ( lang ( 'member:follow_del_success' ), NULL, $callFunc_b );
	}
	/* 移除粉丝 */
	function fans_del($friendid) {
		sleep ( 1 );
		/* 回调参数 */
		$callFunc = msg_func ();
		$callFunc_b = msg_func ( 'callFunc_b' );
		
		/* 检查参数 */
		if (check_nums ( $friendid ) < 1) {
			showmsg ( lang ( 'common:param_id_fail' ), NULL, $callFunc );
		}
		$frs = $this->friend_query ( 'friendid', $friendid );
		if ($frs == $this->db->cw) {
			showmsg ( lang ( 'common:dbexception' ), NULL, $callFunc );
		}
		if (check_is_array ( $frs ) < 1) {
			showmsg ( lang ( 'member:fans_noexist' ), NULL, $callFunc_b );
		}
		$result = $this->db->db_delete ( $this->table_member_friend, 'friendid', $friendid );
		if ($result == $this->db->cw) {
			showmsg ( lang ( 'common:dbexception' ), NULL, $callFunc );
		}
		showmsg ( lang ( 'member:fans_del_success' ), NULL, $callFunc_b );
	}
}
?>