<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}

loader ( 'class:class_member', 'member', true );
class class_member_entry extends class_member {
	
	/* 析构函数 */
	function __construct() {
		parent::__construct ();
	}
	function class_member_entry() {
		$this->__construct ();
	}
	
	/* 登录 */
	function _login($username, $password, $checkcode, $_goback_url) {
		sleep ( 1 );
		/* 回调参数 */
		$url = msg_param ();
		$callFunc = msg_func ();
		$callFunc_b = msg_func ( 'callFunc_b' );
		/* 当前模块 */
		$module = _M ();
		
		/* 是否已登录 */
		if (check_is_array ( get_user () ) == 1) {
			showmsg ( lang ( 'member:logined' ), $_goback_url, $callFunc_b );
		}
		/* 获取配置 */
		$sets = get_db_set ( array (
				'smodule' => $module,
				'stype' => member_value_get ( 'set_field', 'baseset', 'field' ) 
		) );
		if ($sets == $this->db->cw) {
			showmsg ( lang ( 'global:exception' ), NULL, $callFunc_b );
		}
		if (check_is_array ( $sets ) < 1) {
			showmsg ( lang ( 'global:get_db_set_null' ), NULL, $callFunc_b );
		}
		/* 获取表单基本设置 */
		$memberBaseSet = get_db_set ( array (
				'smodule' => 'member',
				'stype' => member_value_get ( 'set_field', 'baseset', 'field' ) 
		) );
		if ($memberBaseSet == $this->db->cw) {
			showmsg ( lang ( 'global:exception' ), NULL, $callFunc );
		}
		if (check_is_array ( $memberBaseSet ) < 1) {
			showmsg ( lang ( 'global:get_db_set_null' ), NULL, $callFunc );
		}
		
		/* 是否允许登录 */
		if (config_val ( 'allowlogin', $sets, yesno_val ( 'check' ) ) == yesno_val ( 'check' )) {
			showmsg ( lang ( 'member:loginclose' ), $_goback_url, $callFunc_b );
		}
		/* 用户名是否为空 */
		if (str_len ( $username ) < 1) {
			showmsg ( lang ( 'member:username_null' ), NULL, $callFunc );
		}
		/* 密码是否为空 */
		if (str_len ( $password ) < 1) {
			showmsg ( lang ( 'member:password_null' ), NULL, $callFunc );
		}
		/* 如果为邮箱登录类型 */
		if (array_number ( explode ( '@', $username ) ) > 1) {
			if (check_email ( $username, $email_min, $email_max ) < 1) {
				showmsg ( lang ( 'member:email_fail' ), NULL, $callFunc );
			} else {
				$where_key = 'email';
			}
		} else {
			$username_min = config_val ( 'username_min', $memberBaseSet );
			$username_max = config_val ( 'username_max', $memberBaseSet );
			if (check_en_ep ( $username, $username_min, $username_max ) < 1) {
				showmsg ( lang ( 'member:username_info', array (
						$username_min,
						$username_max 
				) ), NULL, $callFunc );
			} else {
				$where_key = 'username';
			}
		}
		/* 检查密码 */
		$password_min = config_val ( 'password_min', $memberBaseSet );
		$password_max = config_val ( 'password_max', $memberBaseSet );
		if (check_is_len ( $password, $password_min, $password_max ) < 1) {
			showmsg ( lang ( 'member:password_info', array (
					$password_min,
					$password_max 
			) ), NULL, $callFunc );
		}
		/* 是否需要验证码 */
		if (config_val ( 'islogincheckcode', $sets, yesno_val ( 'normal' ) ) != yesno_val ( 'check' )) {
			if (str_len ( $checkcode ) < 1) {
				showmsg ( lang ( 'global:checkcode_null' ), NULL, $callFunc );
			}
			if ($checkcode != $_SESSION ['checkword']) {
				showmsg ( lang ( 'global:checkcode_fail' ), NULL, $callFunc );
			}
			unset ( $_SESSION ['checkword'] );
		}
		$memberRs = $this->member_query ( $where_key, $username );
		if ($memberRs == $this->db->cw) {
			showmsg ( lang ( 'global:exception' ), NULL, $callFunc );
		}
		if (check_is_array ( $memberRs ) < 1) {
			$langKey = ($where_key == 'username') ? 'username_noexist' : 'email_noexist';
			showmsg ( lang ( 'member:' . $langKey ), NULL, $callFunc );
		}
		$password = md5_str ( $password, 2 );
		if ($password !== $memberRs ['password']) {
			showmsg ( lang ( 'member:password_noexist' ), NULL, $callFunc );
		}
		/* 更新登录信息 */
		$sysTime = $this->sys_time;
		$dataArr = array (
				'before_time' => array_key_val ( 'last_time', $memberRs ),
				'last_time' => $sysTime,
				'before_ip' => array_key_val ( 'last_ip', $memberRs ),
				'last_ip' => getip (),
				'dateline' => $sysTime 
		);
		$result = $this->db->db_update ( $this->table_member, $dataArr, 'uid', array_key_val ( 'uid', $memberRs ) );
		if ($result == $this->db->cw) {
			showmsg ( lang ( 'global:exception' ), NULL, $callFunc );
		}
		/* 记录用户 */
		$_SESSION ['user'] = en_serialize ( $memberRs );
		showmsg ( lang ( 'member:login_success' ), $_goback_url, $callFunc_b );
	}
	/* 普通会员注册 */
	function _register($username, $email, $nickname, $password, $password2, $checkcode, $invitecode, $_goback_url) {
		sleep ( 1 );
		/* 回调参数 */
		$url = msg_param ();
		$callFunc = msg_func ();
		$callFunc_b = msg_func ( 'callFunc_b' );
		/* 当前模块 */
		$module = _M ();
		
		/* 是否已登录 */
		if (check_is_array ( get_user () ) == 1) {
			showmsg ( lang ( 'member:loginedregister' ), $_goback_url, $callFunc_b );
		}
		/* 获取注册设置 */
		$registerSet = get_db_set ( array (
				'smodule' => 'common',
				'stype' => common_value_get ( 'set_field', 'register_set', 'field' ) 
		) );
		if ($registerSet == $this->db->cw) {
			showmsg ( lang ( 'global:exception' ), NULL, $callFunc );
		}
		if (check_is_array ( $registerSet ) < 1) {
			showmsg ( lang ( 'global:get_db_set_null' ), NULL, $callFunc );
		}
		/* 如果已关闭注册 */
		if (config_val ( 'register_type', $registerSet ) == common_value_get ( 'allow_register_type', 'close', 'field' )) {
			showmsg ( config_val ( 'close_msg', $registerSet ), $_goback_url, $callFunc_b );
		}
		/* 如果需要邀请码 */
		$isInvitecode = 0;
		if (config_val ( 'register_type', $registerSet ) == common_value_get ( 'allow_register_type', 'invitecode', 'field' )) {
			$invitecodeRs = $this->_invitecodecheck ( $invitecode );
			if (check_is_array ( $invitecodeRs ) < 1) {
				showmsg ( $invitecodeRs, NULL, $callFunc );
			}
			$isInvitecode = 1;
		}
		/* 获取表单基本设置 */
		$memberBaseSet = get_db_set ( array (
				'smodule' => 'member',
				'stype' => member_value_get ( 'set_field', 'baseset', 'field' ) 
		) );
		if ($memberBaseSet == $this->db->cw) {
			showmsg ( lang ( 'global:exception' ), NULL, $callFunc );
		}
		if (check_is_array ( $memberBaseSet ) < 1) {
			showmsg ( lang ( 'global:get_db_set_null' ), NULL, $callFunc );
		}
		/* 用户名检查 */
		$username_min = config_val ( 'username_min', $memberBaseSet );
		$username_max = config_val ( 'username_max', $memberBaseSet );
		if (check_en_ep ( $username, $username_min, $username_max ) < 1) {
			showmsg ( lang ( 'member:username_info', array (
					$username_min,
					$username_max 
			) ), NULL, $callFunc );
		}
		/* 邮箱检查 */
		if (check_email ( $email ) < 1) {
			showmsg ( lang ( 'member:email_fail' ), NULL, $callFunc );
		}
		/* 密码检查 */
		$password_min = config_val ( 'password_min', $memberBaseSet );
		$password_max = config_val ( 'password_max', $memberBaseSet );
		if (check_is_len ( $password, $password_min, $password_max ) < 1) {
			showmsg ( lang ( 'member:password_info', array (
					$password_min,
					$password_max 
			) ), NULL, $callFunc );
		}
		if (md5_str ( $password, 2 ) !== md5_str ( $password2, 2 )) {
			showmsg ( lang ( 'member:pwd_not_pwd2' ), NULL, $callFunc );
		}
		/* 是否需要验证码 */
		if (config_val ( 'ischeckcode', $registerSet, yesno_val ( 'normal' ) ) != yesno_val ( 'check' )) {
			if (str_len ( $checkcode ) < 1) {
				showmsg ( lang ( 'global:checkcode_null' ), NULL, $callFunc );
			}
			if ($checkcode !== $_SESSION ['checkword']) {
				showmsg ( lang ( 'global:checkcode_fail' ), NULL, $callFunc );
			}
			unset ( $_SESSION ['checkword'] );
		}
		/* 用户是否存在 */
		$memberRs = $this->member_query ( 'username', $username );
		if ($memberRs == $this->db->cw) {
			showmsg ( lang ( 'global:exception' ), NULL, $callFunc );
		}
		if (check_is_array ( $memberRs ) == 1) {
			showmsg ( lang ( 'member:username_isexist' ), NULL, $callFunc );
		}
		/* 邮箱是否存在 */
		$memberRs = $this->member_query ( 'email', $email );
		if ($memberRs == $this->db->cw) {
			showmsg ( lang ( 'global:exception' ), NULL, $callFunc );
		}
		if (check_is_array ( $memberRs ) == 1) {
			showmsg ( lang ( 'member:email_isexist' ), NULL, $callFunc );
		}
		/* 加密密码 */
		$password = md5_str ( $password, 2 );
		/* 获取ip */
		$ip = getip ();
		/* 系统时间 */
		$sys_time = $this->sys_time;
		/* 初始化数据 */
		$dataArr = array (
				'username' => $username,
				'password' => $password,
				'email' => $email,
				'register_time' => $sys_time,
				'before_time' => $sys_time,
				'last_time' => $sys_time,
				'register_ip' => $ip,
				'before_ip' => $ip,
				'last_ip' => $ip,
				'status' => 0,
				'dateline' => $sys_time 
		);
		/* 事务开始 */
		$this->db->trans_begin ();
		
		$uid = $this->db->db_insert ( $this->table_member, $dataArr, true );
		if ($uid == $this->db->cw) {
			$this->db->trans_rollback_end ();
			showmsg ( lang ( 'global:exception' ), NULL, $callFunc );
		}
		/* 如果为邀请码注册,则更新此邀请码的注册uid */
		if ($isInvitecode == 1) {
			$I = loader ( 'class:class_common_invitecode', 'common', true, true );
			$result = $I->invitecode_update ( array (
					'registeruid' => $uid 
			), 'invitecodeid', $invitecodeRs ['invitecodeid'] );
			if ($result == $this->db->cw) {
				$this->db->trans_rollback_end ();
				showmsg ( lang ( 'global:exception' ), NULL, $callFunc );
			}
		}
		/* 初始化会员组 */
		$GObj = loader ( 'class:class_member_group', 'member', true, true );
		$groupinitStatus = $GObj->group_init ( $uid );
		unset ( $GObj );
		if ($groupinitStatus !== $this->db->zq) {
			$this->db->trans_rollback_end ();
			showmsg ( $groupinitStatus, NULL, $callFunc );
		}
		/* 提交事务 */
		$this->db->trans_commit_end ();
		
		/* 返回一个新uid */
		$dataArr ['uid'] = $uid;
		/* 记录用户 */
		$_SESSION ['user'] = en_serialize ( $dataArr );
		showmsg ( lang ( 'member:register_success' ), $_goback_url, $callFunc_b );
	}
	/* 邀请码注册检查 */
	function _invitecode($invitecode, $checkcode) {
		/* 回调参数 */
		$url = msg_param ();
		$callFunc = msg_func ();
		$callFunc_b = msg_func ( 'callFunc_b' );
		
		/* 邀请码 */
		if (str_len ( $invitecode ) < 1) {
			showmsg ( lang ( 'member:register_invitecode_null' ), NULL, $callFunc );
		}
		/* 验证码 */
		if (str_len ( $checkcode ) < 1) {
			showmsg ( lang ( 'member:checkcode_null' ), NULL, $callFunc );
		}
		if ($checkcode !== $_SESSION ['checkword']) {
			showmsg ( lang ( 'global:checkcode_fail' ), NULL, $callFunc );
		}
		unset ( $_SESSION ['checkword'] );
		/* 邀请码检查 */
		$result = $this->_invitecodecheck ( $invitecode );
		if (check_is_array ( $result ) < 1) {
			showmsg ( $result, NULL, $callFunc );
		}
		$urlStr = url ( 'index', 'mod/member/ac/entry/op/register/invitecode/' . $invitecode );
		showmsg ( lang ( 'global:validate_success' ), $urlStr, $callFunc_b );
	}
	/* 邀请码检查 */
	function _invitecodecheck($invitecode) {
		/* 邀请码是否合法 */
		if (! check_ln ( $invitecode )) {
			return lang ( 'member:register_invitecode_fail' );
		}
		/* 邀请码类 */
		$I = loader ( 'class:class_common_invitecode', 'common', true, true );
		$IRs = $I->invitecode_query ( 'invitecode', $invitecode );
		if ($IRs == $this->db->cw) {
			return lang ( 'global:exception' );
		}
		if (check_is_array ( $IRs ) < 1) {
			return lang ( 'member:register_invitecode_noexist' );
		}
		/* 是否被购买 */
		if ($IRs ['isbuy'] != yesno_val ( 'check' )) {
			return lang ( 'member:register_invitecode_nobuy' );
		}
		/* 获取配置有效时间 */
		$ISet = get_db_set ( array (
				'smodule' => 'common',
				'stype' => common_value_get ( 'set_field', 'invitecodebaseset', 'field' ) 
		) );
		if ($ISet == $this->db->cw) {
			return lang ( 'global:exception' );
		}
		if (check_is_array ( $ISet ) < 1) {
			return lang ( 'global:get_db_set_null' );
		}
		/* 过期时间 */
		$expire = timesecond ( op2num ( config_val ( 'validday', $ISet ), (24 * 60), 3 ) );
		/* 是否过期 */
		if (is_expire ( getchecknum ( $IRs ['buytime'], $this->sys_time, 1 ), $expire )) {
			return lang ( 'member:register_invitecode_expire' );
		}
		/* 是否被注册 */
		if (check_nums ( $IRs ['registeruid'] ) == 1) {
			return lang ( 'member:register_invitecode_used' );
		}
		return $IRs;
	}
	/* 会员退出 */
	function _logout($goback_url) {
		/* 回调参数 */
		$callFunc = msg_func ();
		$callFunc_b = msg_func ( 'callFunc_b' );
		
		$uid = get_user ( 'uid' );
		if (check_nums ( $uid ) == 1) {
			logout ();
		}
		showmsg ( lang ( 'member:loginout_success' ), $goback_url, $callFunc );
	}
}
?>