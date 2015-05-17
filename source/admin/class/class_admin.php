<?php
if (! defined ( 'IN_GESHAI' )) {
	exit ( 'no direct access allowed' );
}
class class_admin extends geshai_model {
	
	/* 默认有效时间(单位:分钟) */
	public $minutes = 60000;
	public $uid = 0;
	public $isAdmin = false;
	function __construct() {
		parent::__construct ();
		$this->_isAdmin ();
	}
	function class_admin() {
		$this->__construct ();
	}
	function _isAdmin() {
		$this->uid = $this->get_uid ();
		$this->isAdmin = ($this->getIsAdmin ( $this->uid ) ? true : false);
	}
	function getIsAdmin($uid) {
		return (preg_match ( "/^1{1,1}$/", $uid ) ? true : false);
	}
	function get_uid() {
		$uid = _g ( 'value' )->user ( 'uid' );
		return (_g ( 'validate' )->pnum ( $uid ) ? intval ( $uid ) : null);
	}
	function isInvalidOpr($uid) {
		if (! $this->isAdmin) {
			return ($this->getIsAdmin ( $uid ) ? false : true);
		} else {
			return true;
		}
	}
	/* 检查是否有权限操作 */
	function check() {
		$uid = $this->uid;
		if (! _g ( 'validate' )->pnum ( $uid )) {
			return false;
		}
		$memberCla = _g ( 'module' )->trigger ( 'member');
		$menuCla = _g ( 'cp' )->menu;
		
		$memberRs = $memberCla->find ( 'uid', $uid );
		if (! $this->db->is_success ( $memberRs )) {
			return false;
		}
		if (! my_is_array ( $memberRs )) {
			return false;
		}
		/* 有效会话时间 */
		$expire = _g ( 'value' )->v2second ( $this->minutes );
		
		/* 会话是否过期 */
		if (_g ( 'validate' )->expire ( $memberRs ['online'], $expire )) {
			return false;
		}
		/* 获取检查值 */
		$__isAction = false;
		$__chkData = array ();
		$__chkDoKey = NULL;
		/* 模块 */
		if (_g ( 'validate' )->hasget ( 'mod' )) {
			$__chkData [] = _get ( 'mod' );
		}
		/* 动作 */
		if (_g ( 'validate' )->hasget ( 'ac' )) {
			$__chkData [] = _get ( 'ac' );
		}
		/* 指向 */
		if (_g ( 'validate' )->hasget ( 'op' )) {
			$__isAction = true;
			$__chkDoKey = _get ( 'op' );
		}
		$__chkData = trim ( my_join ( ',', $__chkData ) );
		
		/* 为空时 */
		if (strlen ( $__chkData ) < 1) {
			if (! $this->db->is_success ( $memberCla->update_online ( 'uid', $uid ) )) {
				return false;
			}
			return true;
		}
		
		/* 排除已保留的 */
		if ($this->is_except_getval ( $__isAction ? ($__chkData . ',' . $__chkDoKey) : $__chkData )) {
			if (! $this->db->is_success ( $memberCla->update_online ( 'uid', $uid ) )) {
				return false;
			}
			return true;
		}
		$menuRs = $menuCla->find ( 'vals', $__chkData );
		if (! $this->isAdmin) {
			if (! my_is_array ( $menuRs )) {
				return false;
			}
			$menuOfRs = $menuCla->of_find ( array (
					'menuid' => $menuRs ['menuid'],
					'uid' => $uid 
			) );
			if (! my_is_array ( $menuOfRs )) {
				return false;
			}
			/* 允许的动作 */
			if ($__isAction) {
				if (! my_in_array ( $__chkDoKey, my_explode ( ',', $menuRs ['actions'] ) )) {
					return false;
				}
			}
		}
		if (! $this->db->is_success ( $memberCla->update_online ( 'uid', $uid ) )) {
			return false;
		}
		$this->set_current_menu ( array (
				'c_menuid' => my_array_value ( 'menuid', $menuRs ),
				'c_menu_title' => my_array_value ( 'title', $menuRs ) 
		) );
		return true;
	}
	/* 保留的,不需要验证是否拥有操作权限 */
	function is_except_getval($v) {
		$data = array (
				'login',
				'login,do',
				'main',
				'mcenter',
				'menu,load',
				'menu,pos' 
		);
		if (! my_in_array ( $v, $data )) {
			return false;
		}
		return true;
	}
	/* 设置当前菜单导航需获取的参数 */
	function set_current_menu($key, $val = NULL) {
		if (my_is_array ( $key )) {
			foreach ( $key as $k => $v ) {
				$this->set_current_menu ( $k, $v );
			}
		} else {
			$_GET [$key] = $val;
		}
	}
	/* 登录 */
	function login($username, $password, $checkcode) {
		if (! _g ( 'validate' )->fm ( true )) {
			return null;
		}
		/* 用户名 */
		if (strlen ( $username ) < 1) {
			smsg ( lang ( ':100002' ) );
			return null;
		}
		if (! _g ( 'validate' )->en_e ( $username )) {
			smsg ( lang ( ':100003' ) );
			return null;
		}
		
		/* 密码 */
		if (strlen ( $password ) < 1) {
			smsg ( lang ( ':100004' ) );
			return null;
		}
		if (strlen ( $checkcode ) < 1) {
			smsg ( lang ( '200011' ) );
			return null;
		}
		if (! _g ( 'validate' )->checkcode ( $checkcode )) {
			smsg ( lang ( '200012' ) );
			return null;
		}
		
		/* 用户类 */
		$memberCla = _g ( 'module' )->trigger ( 'member');
		
		/* 用户名是否存在 */
		$memberRs = $memberCla->find ( 'username', $username );
		if (! $this->db->is_success ( $memberRs )) {
			smsg ( lang ( '200013' ) );
			return null;
		}
		if (! my_is_array ( $memberRs )) {
			smsg ( lang ( ':100003' ) );
			return null;
		}
		if (! _g ( 'validate' )->v2eq ( $memberRs ['username'], $username, true )) {
			smsg ( lang ( ':100003' ) );
			return null;
		}
		/* 密码是否正确 */
		if (! _g ( 'validate' )->v2eq ( $memberRs ['password'], my_md5 ( $password, 2 ), true )) {
			smsg ( lang ( ':100005' ) );
			return null;
		}
		/* 系统时间 */
		$sysTime = _g ( 'cfg>time' );
		/* 更新主表(member)登录信息 */
		$fieldData = array (
				'lasttime' => my_array_value ( 'curtime', $memberRs ),
				'lastip' => my_array_value ( 'curip', $memberRs ),
				'curtime' => $sysTime,
				'curip' => getip (),
				'online' => $sysTime 
		);
		$result = $memberCla->update ( $fieldData, 'uid', my_array_value ( 'uid', $memberRs ) );
		if (! $this->db->is_success ( $result )) {
			smsg ( lang ( '200013' ) );
			return null;
		}
		
		/* 销毁当前验证码 */
		_g ( 'value' )->checkcode_destroy ();
		/* session - 当前登陆用户 */
		_g ( 'value' )->user ( null, $memberRs );
		
		/* 登陆成功 */
		smsg ( lang ( ':100006' ), _g ( 'cp' )->uri (), 1 );
	}
	/* 退出 */
	function logout() {
		logout ();
		prtMsg ( lang ( 'member:loginout_success' ), cpurl (), 1 );
	}
}
?>