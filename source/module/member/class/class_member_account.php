<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}

loader ( 'class:class_member', 'member', true );
class class_member_account extends class_member {
	
	/* 析构函数 */
	function __construct() {
		parent::__construct ();
	}
	function class_member_account() {
		$this->__construct ();
	}
	
	/* 密码修改 */
	function password_update($old_password, $password, $password2) {
		sleep ( 1 );
		/* 回调参数 */
		$callFunc = msg_func ();
		$callFunc_b = msg_func ( 'callFunc_b' );
		
		/* 当前会员 */
		$uid = get_user ( 'uid' );
		
		/* 原密码是否为空 */
		if (str_len ( $old_password ) < 1) {
			showmsg ( lang ( 'member:password_set_old_pwd_null' ), NULL, $callFunc );
		}
		/* 新密码是否为空 */
		if (str_len ( $password ) < 1) {
			showmsg ( lang ( 'member:password_set_new_pwd_null' ), NULL, $callFunc );
		}
		/* 确认新密码是否为空 */
		if (str_len ( $password2 ) < 1) {
			showmsg ( lang ( 'member:password_set_new_pwd2_null' ), NULL, $callFunc );
		}
		/* 新密码是否和确认密码一致 */
		if (md5_str ( $password, 2 ) !== md5_str ( $password2, 2 )) {
			showmsg ( lang ( 'member:password_set_new_pwd_not_new_pwd2' ), NULL, $callFunc );
		}
		
		/* 初始化配置 */
		$baseSet = get_db_set ( array (
				'smodule' => 'member',
				'stype' => member_value_get ( 'set_field', 'baseset', 'field' ) 
		) );
		if ($baseSet == $this->db->cw) {
			showmsg ( lang ( 'global:dbexception' ), NULL, $callFunc );
		}
		if (check_is_array ( $baseSet ) < 1) {
			showmsg ( lang ( 'global:get_db_set_null' ), NULL, $callFunc );
		}
		/* 检查原始密码长度 */
		if (check_is_len ( $old_password, 1, 50 ) < 1) {
			showmsg ( lang ( 'member:password_set_old_pwd_fail' ), NULL, $callFunc );
		}
		/* 检查新密码长度 */
		$password_min = config_val ( 'password_min', $baseSet );
		$password_max = config_val ( 'password_max', $baseSet );
		if (check_is_len ( $password, $password_min, $password_max ) < 1) {
			showmsg ( lang ( 'member:password_set_new_pwd_info', array (
					$password_min,
					$password_max 
			) ), NULL, $callFunc );
		}
		/* 该会员是否存在 */
		$qrs = $this->member_query ( 'uid', $uid );
		if ($qrs == $this->db->cw) {
			showmsg ( lang ( 'global:dbexception' ), NULL, $callFunc );
		}
		if (check_is_array ( $qrs ) < 1) {
			showmsg ( lang ( 'member:uid_noexist' ), NULL, $callFunc );
		}
		/* 原密码是否正确 */
		if (array_key_val ( 'password', $qrs ) !== md5_str ( $old_password, 2 )) {
			showmsg ( lang ( 'member:password_set_old_pwd_fail' ), NULL, $callFunc );
		}
		/* 如果原密码和新密码相同,则不需修改 */
		if (md5_str ( $old_password, 2 ) === md5_str ( $password, 2 )) {
			showmsg ( lang ( 'member:password_set_old_pwd_equal_new_pwd' ), NULL, $callFunc );
		}
		/* 初始化数据 */
		$dataArr = array (
				'password' => md5_str ( $password, 2 ) 
		);
		$result = $this->db->db_update ( $this->table_member, $dataArr, 'uid', $uid );
		unset ( $dataArr );
		if ($result == $this->db->cw) {
			showmsg ( lang ( 'global:dbexception' ), NULL, $callFunc );
		}
		
		/* 系统自动退出会员 */
		logout ();
		$url = url ( 'index', 'mod/member/ac/entry/op/login' );
		showmsg ( lang ( 'member:password_set_success' ), $url, $callFunc_b );
	}
}
?>