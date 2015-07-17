<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}

loader ( 'class:class_common_datacall', 'common', true );
class class_member_datacall_admin extends class_common_datacall {
	
	/* 析构函数 */
	function __construct() {
		parent::__construct ();
	}
	function class_member_datacall_admin() {
		$this->__construct ();
	}
	
	/* 添加 */
	function add($did, $avatarwidth, $avatarheight, $ordertype, $isrand, $startnum, $offsetnum, $usernamelen, $informlen) {
		/* 回调参数 */
		$msg_call_url = msg_param ();
		$msg_call = msg_func ();
		$msg_call_c = msg_func ( 'msg_call_c' );
		$msg_call_param = msg_callback_param ();
		
		/* 时间调用 */
		if (check_num ( $did ) < 1) {
			$did = 0;
		}
		
		/* 头像宽 */
		if (check_num ( $avatarwidth ) < 1) {
			$avatarwidth = 0;
		}
		/* 头像高 */
		if (check_num ( $avatarheight ) < 1) {
			$avatarheight = 0;
		}
		
		/* 排序 */
		if (check_num ( $ordertype ) < 1) {
			$ordertype = 0;
		}
		/* 是否随机 */
		if (check_num ( $isrand ) < 1) {
			$isrand = yesno_val ( 'normal' );
		}
		/* 起始行 */
		if (check_num ( $startnum ) < 1) {
			$startnum = 0;
		}
		/* 显示条数 */
		if (check_num ( $offsetnum ) < 1) {
			$offsetnum = 10;
		}
		
		/* 初始化参数 */
		$data = array (
				'did' => $did,
				'avatarwidth' => $avatarwidth,
				'avatarheight' => $avatarheight,
				'ordertype' => $ordertype,
				'isrand' => $isrand,
				'startnum' => $startnum,
				'offsetnum' => $offsetnum,
				'usernamelen' => $usernamelen,
				'informlen' => $informlen 
		);
		/* 如果为随机 */
		if ($isrand != yesno_val ( 'check' )) {
			unset ( $data ['startnum'] );
		}
		$this->datacall_add ( _M (), $data, $msg_call, $msg_call_url, $msg_call_c, array (
				'dourl' => modelurl ( 965 ) 
		) );
		return NULL;
	}
	/* 编辑 */
	function edit($did, $avatarwidth, $avatarheight, $ordertype, $isrand, $startnum, $offsetnum, $usernamelen, $informlen) {
		/* 回调参数 */
		$msg_call_url = msg_param ();
		$msg_call = msg_func ();
		$msg_call_b = msg_func ( 'msg_call_b' );
		$msg_call_param = msg_callback_param ();
		
		/* 时间调用 */
		if (check_num ( $did ) < 1) {
			$did = 0;
		}
		
		/* 头像宽 */
		if (check_num ( $avatarwidth ) < 1) {
			$avatarwidth = 0;
		}
		/* 头像高 */
		if (check_num ( $avatarheight ) < 1) {
			$avatarheight = 0;
		}
		
		/* 排序 */
		if (check_num ( $ordertype ) < 1) {
			$ordertype = 0;
		}
		/* 是否随机 */
		if (check_num ( $isrand ) < 1) {
			$isrand = yesno_val ( 'check' );
		}
		/* 起始行 */
		if (check_num ( $startnum ) < 1) {
			$startnum = 0;
		}
		/* 显示条数 */
		if (check_num ( $offsetnum ) < 1) {
			$offsetnum = 10;
		}
		
		/* 初始化参数 */
		$data = array (
				'did' => $did,
				'avatarwidth' => $avatarwidth,
				'avatarheight' => $avatarheight,
				'ordertype' => $ordertype,
				'isrand' => $isrand,
				'startnum' => $startnum,
				'offsetnum' => $offsetnum,
				'usernamelen' => $usernamelen,
				'informlen' => $informlen 
		);
		/* 如果为随机 */
		if ($isrand != yesno_val ( 'check' )) {
			unset ( $data ['startnum'] );
		}
		$this->datacall_edit ( $data, $msg_call, $msg_call_url, $msg_call_b, $msg_call_param );
		return NULL;
	}
}
?>