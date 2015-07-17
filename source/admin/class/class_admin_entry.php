<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}

loader ( 'class:class_admin', 'admin', true );
class class_admin_entry extends class_admin {
	
	/* 会员类 */
	public $member = NULL;
	
	/* 析构函数 */
	function __construct() {
		parent::__construct ();
		$this->member = loader ( 'class:class_member', 'member', true, true );
	}
	function class_admin_entry() {
		$this->__construct ();
	}
	
	/* 管理员登录验证 */
	function login($username, $password, $checkcode) {
		sleep ( 1 );
		/* 回调参数 */
		$url = msg_param ();
		$callFunc = msg_func ();
		$callFunc_b = msg_func ( 'callFunc_b' );
		$callFunc_c = msg_func ( 'callFunc_c' );
		
		/* 检查用户名 */
		if (str_len ( $username ) < 1) {
			showmsg ( lang ( 'member:username_null' ), NULL, $callFunc );
		}
		/* 检查密码 */
		if (str_len ( $password ) < 1) {
			showmsg ( lang ( 'member:password_null' ), NULL, $callFunc );
		}
		if (str_len ( $checkcode ) < 1) {
			showmsg ( lang ( 'global:checkcode_null' ), NULL, $callFunc );
		}
		if ($checkcode != $_SESSION ['checkword']) {
			showmsg ( lang ( 'global:checkcode_fail' ), NULL, $callFunc_b );
		}
		unset ( $_SESSION ['checkword'] );
		/* 检查用户名格式 */
		if (check_en_ep ( $username, 3, 20 ) < 1) {
			showmsg ( lang ( 'member:username_fail' ), NULL, $callFunc_b );
		}
		/* 检查用户名是否存在 */
		$memberRs = $this->member->member_query ( 'username', $username );
		if ($memberRs == $this->db->cw) {
			showmsg ( lang ( 'global:dbexception' ), NULL, $callFunc_b );
		}
		/* 检查用户名是否存在 */
		if (check_is_array ( $memberRs ) < 1) {
			showmsg ( lang ( 'member:username_noexist' ), NULL, $callFunc_b );
		}
		/* 检查用户名是否存在 */
		if ($memberRs ['username'] !== $username) {
			showmsg ( lang ( 'member:username_noexist' ), NULL, $callFunc_b );
		}
		/* 检查密码是否正确 */
		$password = md5_str ( $password, 2 );
		if ($memberRs ['password'] !== $password) {
			showmsg ( lang ( 'member:password_noexist' ), NULL, $callFunc_b );
		}
		/* 系统时间 */
		$sysTime = $this->sys_time;
		/* 更新主表(member)登录信息 */
		$dataArr = array (
				'before_time' => array_key_val ( 'last_time', $memberRs ),
				'last_time' => $sysTime,
				'before_ip' => array_key_val ( 'last_ip', $memberRs ),
				'last_ip' => getip (),
				'dateline' => $sysTime 
		);
		$result = $this->member->member_update ( $dataArr, 'uid', array_key_val ( 'uid', $memberRs ) );
		if ($result == $this->db->cw) {
			showmsg ( lang ( 'global:dbexception' ), NULL, $callFunc_b );
		}
		/* 记录用户 */
		$_SESSION ['user'] = en_serialize ( $memberRs );
		showmsg ( lang ( 'member:login_success' ), $url, $callFunc_c );
	}
	/* 会员退出 */
	function logout() {
		/* 回调参数 */
		$url = msg_param ();
		$callFunc = msg_func ();
		/* 检查是否已存在会话 */
		$uid = get_user ( 'uid' );
		if (check_nums ( $uid ) == 1) {
			logout ();
		}
		showmsg ( lang ( 'member:loginout_success' ), $url, $callFunc );
	}
}
?>