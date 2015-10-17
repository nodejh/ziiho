<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}

loader ( 'class:class_member', 'member', true );
class class_member_profile extends class_member {
	public $table_member_profile = 'member_profile';
	
	/* 析构函数 */
	function __construct() {
		parent::__construct ();
	}
	function class_member_profile() {
		$this->__construct ();
	}
	
	/* 基本资料查询 */
	function profile_query($_key, $_val = NULL) {
		$this->db->from ( $this->table_member_profile );
		$this->db->where ( $_key, $_val );
		$result = $this->db->select ();
		if ($result == $this->db->cw) {
			return $result;
		}
		$result = $this->db->get_one ();
		return $result;
	}
	/* 基本资料设置 */
	function profile_base($nickname, $gender, $birthday, $hometown, $address, $inform) {
		sleep ( 1 );
		/* 回调参数 */
		$callFunc = msg_func ();
		$callFunc_b = msg_func ( 'callFunc_b' );
		
		/* 获取当前用户 */
		$uid = get_user ( 'uid' );
		
		/* 获取配置 */
		$sets = get_db_set ( array (
				'smodule' => 'member',
				'stype' => member_value_get ( 'set_field', 'baseset', 'field' ) 
		) );
		if ($sets == $this->db->cw) {
			showmsg ( lang ( 'global:dbexception' ), NULL, $callFunc );
		}
		if (check_is_array ( $sets ) < 1) {
			showmsg ( lang ( 'global:get_db_set_null' ), NULL, $callFunc );
		}
		
		/* 检查昵称长度 */
		$nickname_min = config_val ( 'nickname_min', $sets, 1 );
		$nickname_max = config_val ( 'nickname_max', $sets, 20 );
		if (str_len ( str_stripslashes ( $nickname ) ) < 1) {
			showmsg ( lang ( 'member:profile_nickname_null' ), NULL, $callFunc );
		}
		if (check_is_len ( str_stripslashes ( $nickname ), $nickname_min, $nickname_max ) < 1) {
			showmsg ( lang ( 'member:profile_nickname_info', array (
					$nickname_min,
					$nickname_max 
			) ), NULL, $callFunc );
		}
		/* 性别检查 */
		if (check_is_key ( $gender, gender_val () ) < 1) {
			showmsg ( lang ( 'member:profile_gender_fail' ), NULL, $callFunc );
		}
		/* 生日 */
		if (check_isdate ( $birthday ) < 1) {
			$birthday = timetoallday ();
		} else {
			$birthday = str_strtotime ( $birthday );
		}
		/* 检查个性签名长度 */
		$inform_max = config_val ( 'inform_max', $sets, 100 );
		if (check_is_len ( str_stripslashes ( $inform ), $inform_min, $inform_max ) < 1) {
			showmsg ( lang ( 'member:profile_inform_info', $inform_max ), NULL, $callFunc );
		}
		/* 清除不用值 */
		unset ( $sets );
		
		/* 初始数据 */
		$dataArr = array (
				'uid' => $uid,
				'nickname' => $nickname,
				'gender' => $gender,
				'birthday' => $birthday,
				'hometown' => $hometown,
				'address' => $address,
				'inform' => $inform 
		);
		
		/* 检查资料是否存在 */
		$profileRs = $this->profile_query ( 'uid', $uid );
		if ($profileRs == $this->db->cw) {
			showmsg ( lang ( 'global:dbexception' ), NULL, $callFunc );
		}
		/* 如果不存在,则新增 */
		if (check_is_array ( $profileRs ) < 1) {
			$result = $this->db->db_insert ( $this->table_member_profile, $dataArr );
		} else {
			unset ( $dataArr ['uid'] );
			$result = $this->db->db_update ( $this->table_member_profile, $dataArr, 'uid', $uid );
		}
		if ($result == $this->db->cw) {
			showmsg ( lang ( 'global:dbexception' ), NULL, $callFunc );
		}
		showmsg ( lang ( 'global:dbsuccess' ), NULL, $callFunc_b );
	}
}
?>