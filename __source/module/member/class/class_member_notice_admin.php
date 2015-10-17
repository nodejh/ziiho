<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}

loader ( 'class:class_member_notice', 'member', true );
class class_member_notice_admin extends class_member_notice {
	
	/* 析构函数 */
	function __construct() {
		parent::__construct ();
	}
	function class_member_notice_admin() {
		$this->__construct ();
	}
	
	/* 发送提醒 */
	function send($msg_to_uid, $msg_title, $msg_content, $msg_content_type) {
		/* 回调参数 */
		$msg_call_url = msg_param ();
		$msg_call = msg_func ();
		$msg_call_b = msg_func ( 'msg_call_b' );
		
		/* 标题 */
		if (str_len ( $msg_title ) < 1) {
			domsg ( lang ( 'member_adm:message_title_null' ), NULL, $msg_call );
		}
		/* 内容 */
		if (str_len ( $msg_content ) < 1) {
			domsg ( lang ( 'member_adm:message_content_null' ), NULL, $msg_call );
		}
		/* 内容解析方式 */
		if (str_len ( $msg_content_type ) < 1) {
			domsg ( lang ( 'member_adm:message_content_type_fail' ), NULL, $msg_call );
		}
		if (str_len ( member_config_value_get ( 'message_content_type', $msg_content_type, 'field' ) ) < 1) {
			domsg ( lang ( 'member_adm:message_content_type_fail' ), NULL, $msg_call );
		}
		/* 检查发送到会员是否存在 */
		if (check_nums ( $msg_to_uid ) < 1) {
			domsg ( lang ( 'member_adm:message_to_uid_fail' ), NULL, $msg_call );
		}
		/* 检查会员是否存在 */
		$m = $this->_loader->model ( 'class:class_member', 'member', false );
		$member = $m->member_query ( 'uid', $msg_to_uid );
		unset ( $m );
		if ($member == $this->db->cw) {
			domsg ( lang ( 'member_adm:message_exception' ), NULL, $msg_call );
		}
		if (check_is_array ( $member ) < 1) {
			domsg ( lang ( 'member_adm:message_to_uid_no_exists' ), NULL, $msg_call );
		}
		/* 初始变量化参数 */
		$to_username = $member ['username'];
		$to_nickname = $member ['nickname'];
		$ctime = $this->sys_time;
		unset ( $member );
		
		/* 设置变量 */
		$set_arr = array (
				'username' => $to_username,
				'nickname' => $to_nickname,
				'time' => datestyle ( $ctime, 'Y-m-d H:s:i' ) 
		);
		/* 解析变量 */
		$msg_title = get_config_global ( $msg_title, $set_arr );
		$msg_content = get_config_global ( $msg_content, $set_arr );
		
		/* 检查内容方式html,编码和解码 */
		$content_func = member_config_value_get ( 'message_content_type', $msg_content_type, 'func' );
		$msg_content = $content_func ( $msg_content );
		/* 发送会员 */
		$uid = get_user ( 'uid' );
		/* 标注未读状态 */
		$isview = member_isview_val ( 'no' );
		/* 以身份发送状态值 */
		$msg_send_status = member_config_value_get ( 'message_send_status', 'yes', 'val' );
		
		/* 初始化值 */
		$data_arr = array (
				'inboxuid' => $msg_to_uid,
				'outboxuid' => $uid,
				'fromuid' => $uid,
				'title' => $msg_title,
				'content' => $msg_content,
				'ctime' => $this->sys_time,
				'isview' => $isview,
				'isreply' => $msg_send_status 
		);
		$result = $this->db->db_insert ( $this->table_member_notice, $data_arr );
		if ($result == $this->db->cw) {
			domsg ( lang ( 'member_adm:message_exception' ), NULL, $msg_call );
		}
		domsg ( lang ( 'member_adm:message_success' ), NULL, $msg_call_b );
	}
}
?>