<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}

loader ( 'class:class_common_invitecode', 'common', true );
class class_common_invitecode_admin extends class_common_invitecode {
	public $common_set = NULL;
	
	/* 析构函数 */
	function __construct() {
		parent::__construct ();
	}
	function class_common_invitecode_admin() {
		$this->__construct ();
	}
	
	/* 初始化对象 */
	function set_common_set_obj() {
		$this->common_set = loader ( 'class:class_common_set', 'common', true, true );
	}
	/* 基本设置 */
	function baseset($validday, $cost, $costtype, $costmembergroup) {
		/* 回调参数 */
		$url = msg_param ();
		$callFunc = msg_func ();
		$callFunc_b = msg_func ( 'callFunc_b' );
		
		/* 当前模块 */
		$_m = _M ();
		/* 类型 */
		$_t = common_value_get ( 'set_field', 'invitecodebaseset', 'field' );
		
		/* 有效期限 */
		if (check_nums ( $validday ) < 1) {
			$validday = 3;
		}
		/* 转义允许会员组 */
		$costmembergroup = en_serialize ( $costmembergroup );
		/* 字段初始 */
		$data_arr [] = array (
				$_m,
				$_t,
				'validday',
				$validday 
		);
		$data_arr [] = array (
				$_m,
				$_t,
				'cost',
				$cost 
		);
		$data_arr [] = array (
				$_m,
				$_t,
				'costtype',
				$costtype 
		);
		$data_arr [] = array (
				$_m,
				$_t,
				'costmembergroup',
				$costmembergroup 
		);
		$this->set_common_set_obj ();
		$result = $this->common_set->set_save ( $data_arr );
		if ($result == $this->db->cw) {
			showmsg ( lang ( 'global:dbexception' ), NULL, $callFunc );
		}
		showmsg ( lang ( 'global:dbsuccess' ), NULL, $callFunc );
	}
	/* 邀请码生成 */
	function invitecode_create($num) {
		/* 回调参数 */
		$url = msg_param ();
		$callFunc = msg_func ();
		$callFunc_b = msg_func ( 'callFunc_b' );
		
		if (check_nums ( $num ) < 1) {
			showmsg ( lang ( 'common:invitecode_create_num_fail' ), NULL, $callFunc );
		}
		/* 最大生成个数 */
		$set_max_num = 100;
		
		/* 强制转为整型 */
		$num = intval ( $num );
		if ($num > $set_max_num) {
			showmsg ( lang ( 'common:invitecode_create_num_fail' ), NULL, $callFunc );
		}
		/* 操作则 */
		$uid = get_user ( 'uid' );
		/* 未买过 */
		$isbuy = yesno_val ( 'normal' );
		/* 开始生成 */
		$result = $this->invitecode_create_do ( $num, $uid, $isbuy );
		showmsg ( $result, NULL, $callFunc );
	}
	/* 生成邀请码处理 */
	function invitecode_create_do($num, $uid, $isbuy, $replace = 0) {
		if ($num < 1) {
			return lang ( 'global:dbsuccess' );
		}
		/* 生成位数 */
		$len = 16;
		/* 生成的随机码 */
		$invitecode = getrand ( $len, 6 );
		/* 检查是否存在 */
		$result = $this->invitecode_query ( 'invitecode', $invitecode );
		if ($result == $this->db->cw) {
			return lang ( 'global:dbexception' );
		}
		/* 如果存在则重新生成 */
		if (check_is_array ( $num ) == 1) {
			/* 为避免死循环,超过2次则退出生成 */
			if ($replace > 1) {
				return lang ( 'common:invitecode_create_replace_overfull' );
			}
			$this->invitecode_create_do ( $num, $uid, $isbuy, ($replace + 1) );
		}
		/* 添加 */
		$data_arr = array (
				'uid' => $uid,
				'invitecode' => $invitecode,
				'ctime' => $this->sys_time,
				'isbuy' => $isbuy 
		);
		$result = $this->db->db_insert ( $this->table_common_invitecode, $data_arr );
		if ($result == $this->db->cw) {
			return lang ( 'global:dbexception' );
		}
		return $this->invitecode_create_do ( ($num - 1), $uid, $isbuy );
	}
	/* 邀请码删除 */
	function invitecode_del($invitecodeid) {
		/* 回调参数 */
		$url = msg_param ();
		$callFunc = msg_func ();
		$callFunc_b = msg_func ( 'callFunc_b' );
		
		if (check_is_array ( $invitecodeid ) < 1) {
			showmsg ( lang ( 'global:param_ids_null' ), NULL, $callFunc );
		}
		for($i = 0; $i < array_number ( $invitecodeid ); $i ++) {
			$invitecodeid [$i] = trim_addslashes ( $invitecodeid [$i] );
			if (check_nums ( $invitecodeid [$i] ) < 1) {
				showmsg ( lang ( 'global:param_ids_fail' ), $url, $callFunc_b );
			}
			$result = $this->invitecode_query ( 'invitecodeid', $invitecodeid [$i] );
			if ($result == $this->db->cw) {
				showmsg ( lang ( 'global:dbexceptions' ), $url, $callFunc_b );
			}
			if (check_is_array ( $result ) < 1) {
				continue;
			}
			$result = $this->db->db_delete ( $this->table_common_invitecode, 'invitecodeid', $invitecodeid [$i] );
			if ($result == $this->db->cw) {
				showmsg ( lang ( 'global:dbexceptions' ), $url, $callFunc_b );
			}
		}
		showmsg ( lang ( 'global:dbsuccess' ), $url, $callFunc_b );
	}
}
?>