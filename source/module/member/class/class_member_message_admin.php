<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}

loader ( 'class:class_member_message', 'member', true );
class class_member_message_admin extends class_member_message {
	
	/* 析构函数 */
	function __construct() {
		parent::__construct ();
	}
	function class_member_message_admin() {
		$this->__construct ();
	}
	
	/* 发送消息 */
	function send($msg_to_uid, $msg_title, $msg_content, $msg_send_status) {
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
		/* 是否以系统身份发送 */
		if (str_len ( $msg_send_status ) < 1) {
			domsg ( lang ( 'member_adm:message_send_status_fail' ), NULL, $msg_call );
		}
		if (str_len ( member_config_value_get ( 'message_send_status', $msg_send_status, 'field' ) ) < 1) {
			domsg ( lang ( 'member_adm:message_send_status_fail' ), NULL, $msg_call );
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
		
		/* 发送会员 */
		$uid = get_user ( 'uid' );
		/* 标注未读状态 */
		$isview = member_isview_val ( 'no' );
		/* 以身份发送状态值 */
		$msg_send_status = member_config_value_get ( 'message_send_status', $msg_send_status, 'val' );
		/* 检查内容存在html,则编码 */
		$msg_content = html_special ( $msg_content );
		
		/* 消息状态 */
		$box_status = member_message_box_status ( 'normal' );
		/* 初始化值 */
		$data_arr = array (
				'inboxuid' => $msg_to_uid,
				'outboxuid' => $uid,
				'inbox' => $box_status,
				'outbox' => $box_status,
				'title' => $msg_title,
				'content' => $msg_content,
				'ctime' => $this->sys_time,
				'isview' => $isview,
				'isreply' => $msg_send_status 
		);
		$result = $this->db->db_insert ( $this->table_member_message, $data_arr );
		unset ( $data_arr );
		if ($result == $this->db->cw) {
			domsg ( lang ( 'member_adm:message_exception' ), NULL, $msg_call );
		}
		domsg ( lang ( 'member_adm:message_success' ), NULL, $msg_call_b );
	}
}
?>