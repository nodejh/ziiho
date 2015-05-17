<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}
class class_member extends geshai_model {
	public $t_member = 'member';
	/* 默认有效时间(单位:分钟) */
	public $minutes = 60;
	
	/* 析构函数 */
	function __construct() {
		parent::__construct ();
	}
	function class_member() {
		$this->__construct ();
	}
	
	/* 查询 */
	function find($k, $v = null) {
		$this->db->from ( $this->t_member );
		$this->db->where ( $k, $v );
		$this->db->select ();
		return $this->db->get_one ();
	}
	/* 主表添加 */
	function add($k, $v = null, $isInsertId = false) {
		$this->db->from ( $this->t_member );
		$this->db->set ( $k, $v );
		$s = $this->db->insert ();
		if ($isInsertId == true) {
			return $this->db->insert_id ();
		}
		return $s;
	}
	/* 主表更新 */
	function update($data, $k, $v = null) {
		$this->db->from ( $this->t_member );
		$this->db->where ( $k, $v );
		$this->db->set ( $data );
		return $this->db->update ();
	}
	/* 更新在线时间 */
	function update_online($k, $v = null) {
		return $this->update ( array (
				'online' => _g ( 'cfg>time' ) 
		), $k, $v );
	}
	/* 会员初始进入,检查是否允许进入 */
	function member_access($isexit = true) {
		$is_access = $this->member_accessCheck ();
		if ($is_access < 1) {
			if ($isexit == true) {
				$url = url ( 'index', 'mod/member/ac/entry/op/login' );
				if (msg_param ( 'isajax' ) == 1 || post_param ( 'isajax' ) == 1) {
					showmsg ( lang ( 'admin:noaccess' ), $url, 'ajaxActionDialog' );
				} else {
					showmsg ( lang ( 'admin:noaccess' ), $url, NULL, array (
							'urlTarget' => '_top' 
					) );
				}
				return $is_access;
			}
		}
		return $is_access;
	}
	/* 会员初始进入,检查是否允许进入 */
	function member_accessCheck() {
		/* 获取会员参数 */
		if (check_is_key ( 'uid', $this->user ) == 1) {
			$uid = array_key_val ( 'uid', $this->user );
		} else {
			if (check_is_key ( 'ac_uid', $_GET ) == 1) {
				$uid = array_key_val ( 'ac_uid', $_GET );
			} else {
				$uid = array_key_val ( 'ac_uid', $_POST );
			}
		}
		if (check_nums ( $uid ) < 1) {
			return 0;
		}
		/* 转为整型 */
		$uid = intval ( $uid );
		/* 检查会员是否存在 */
		$member = $this->member_query ( 'uid', $uid );
		if ($member == $this->db->cw) {
			return 0;
		}
		if (check_is_array ( $member ) < 1) {
			return 0;
		}
		/* 有效会话时间 */
		$expire = timesecond ( $this->minutes );
		/* 会话是否过期 */
		if (is_expire ( getchecknum ( $member ['dateline'], $this->sys_time, 1 ), $expire )) {
			logout ();
			return 0;
		}
		/* ----------------------------- */
		/*检查状态*/
		/*-----------------------------*/
		/*检查会员组*/
		/*-----------------------------*/
		/*更新在线时间*/
		if ($this->member_expire_update ( $uid ) == $this->db->cw) {
			return 0;
		}
		return 1;
	}
}
?>