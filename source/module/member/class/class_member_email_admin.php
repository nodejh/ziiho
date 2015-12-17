<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}
class class_member_email_admin extends class_model {
	
	/* 析构函数 */
	function __construct() {
		parent::__construct ();
	}
	function class_member_email_admin() {
		$this->__construct ();
	}
	
	/* 发送邮件 */
	function send($msg_to_uid, $msg_title, $msg_content, $msg_content_type) {
		/* 回调参数 */
		$msg_call_url = msg_param ();
		$msg_call = msg_func ();
		$msg_call_b = msg_func ( 'msg_call_b' );
		
		/* 标题 */
		if (str_len ( $msg_title ) < 1) {
			domsg ( lang ( 'member_adm:message_title_null' ), NULL, $msg_call );
			return NULL;
		}
		/* 内容 */
		if (str_len ( $msg_content ) < 1) {
			domsg ( lang ( 'member_adm:message_content_null' ), NULL, $msg_call );
			return NULL;
		}
		/* 内容解析方式 */
		if (str_len ( $msg_content_type ) < 1) {
			domsg ( lang ( 'member_adm:message_content_type_fail' ), NULL, $msg_call );
			return NULL;
		}
		if (str_len ( member_config_value_get ( 'message_content_type', $msg_content_type, 'field' ) ) < 1) {
			domsg ( lang ( 'member_adm:message_content_type_fail' ), NULL, $msg_call );
			return NULL;
		}
		
		/* 检查发送到会员是否存在 */
		if (check_nums ( $msg_to_uid ) < 1) {
			domsg ( lang ( 'member_adm:message_to_uid_fail' ), NULL, $msg_call );
			return NULL;
		}
		/* 检查会员是否存在 */
		$m = $this->_loader->model ( 'class:class_member', 'member', false );
		$member = $m->member_query ( 'uid', $msg_to_uid );
		unset ( $m );
		if ($member == $this->db->cw) {
			domsg ( lang ( 'member_adm:message_exception' ), NULL, $msg_call );
			return NULL;
		}
		if (check_is_array ( $member ) < 1) {
			domsg ( lang ( 'member_adm:message_to_uid_no_exists' ), NULL, $msg_call );
			return NULL;
		}
		/* 检查邮箱是否已验证 */
		if (array_key_val ( 'email_auth', $member ) != member_email_status ( 'normal' )) {
			domsg ( lang ( 'member:member_to_email_status_check' ), NULL, $msg_call );
			return NULL;
		}
		/* 初始变量化参数 */
		$to_email = $member ['email'];
		$to_username = $member ['username'];
		$to_nickname = $member ['nickname'];
		$ctime = $this->sys_time;
		unset ( $member );
		
		/* 获取邮箱配置 */
		$arr = get_config ( 'config_module', config_name_val ( 'email_set' ) );
		if (check_is_array ( $arr ) < 1) {
			domsg ( lang ( 'member_adm:message_email_init_null' ), NULL, $msg_call );
			return NULL;
		}
		/* 功能状态 */
		$status = config_val ( 'status', $arr );
		/* 发送方式 */
		$types = config_val ( 'types', $arr );
		/* smtp服务 */
		$smtp_server = config_val ( 'smtp_server', $arr );
		/* smtp端口 */
		$smtp_port = config_val ( 'smtp_port', $arr );
		/* 发件人 */
		$smtp_from_email = config_val ( 'smtp_from_email', $arr );
		/* smtp身份验证 */
		$smtp_auth = config_val ( 'smtp_auth', $arr );
		/* 发件人账户 */
		$smtp_auth_username = config_val ( 'smtp_auth_username', $arr );
		/* 发件人密码 */
		$smtp_auth_password = tostr_decode ( config_val ( 'smtp_auth_password', $arr ) );
		
		/* 检查功能是否开启 */
		if (str_len ( $status ) < 1) {
			domsg ( lang ( 'member_adm:message_email_status_fail' ), NULL, $msg_call );
			return NULL;
		}
		if (config_value_get ( 'email_status', $status, 'field' ) != config_value_get ( 'email_status', 'normal', 'field' )) {
			domsg ( lang ( 'member_adm:message_email_status_check' ), NULL, $msg_call );
			return NULL;
		}
		/* 检查发送方式 */
		if (str_len ( $types ) < 1) {
			domsg ( lang ( 'member_adm:message_email_type_fail' ), NULL, $msg_call );
			return NULL;
		}
		if (str_len ( config_value_get ( 'email_type', $types, 'field' ) ) < 1) {
			domsg ( lang ( 'member_adm:message_email_type_fail' ), NULL, $msg_call );
			return NULL;
		}
		/* 检查smtp身份验证 */
		if (str_len ( $smtp_auth ) < 1) {
			domsg ( lang ( 'member_adm:message_email_auth_fail' ), NULL, $msg_call );
			return NULL;
		}
		if (str_len ( config_value_get ( 'email_smtp_auth', $smtp_auth, 'field' ) ) < 1) {
			domsg ( lang ( 'member_adm:message_email_auth_fail' ), NULL, $msg_call );
			return NULL;
		}
		$smtp_auth = config_value_get ( 'email_smtp_auth', $smtp_auth, 'val' );
		
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
		$msg_content = str_stripslashes ( $content_func ( $msg_content ) );
		
		/* 初始化类参数 */
		$class_param = array (
				'smtp_server' => $smtp_server,
				'smtp_port' => $smtp_port,
				'smtp_auth' => $smtp_auth,
				'smtp_auth_username' => $smtp_auth_username,
				'smtp_auth_password' => $smtp_auth_password 
		);
		/* 发送 */
		$smtp = $this->_loader->model ( 'class:class_email_smtp', NULL, false, true, $class_param );
		unset ( $class_param );
		$result = $smtp->sendmail ( $to_email, $smtp_from_email, $msg_title, $msg_content, $msg_content_type );
		if ($result != true) {
			domsg ( lang ( 'member_adm:message_email_send_fail' ), NULL, $msg_call );
			return NULL;
		}
		domsg ( lang ( 'member_adm:message_success' ), NULL, $msg_call_b );
		return NULL;
	}
}
?>