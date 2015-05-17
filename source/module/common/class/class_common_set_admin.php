<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}

loader ( 'class:class_common_set', 'common', true );
class class_common_set_admin extends class_common_set {
	
	/* 析构函数 */
	function __construct() {
		parent::__construct ();
	}
	function class_common_set_admin() {
		$this->__construct ();
	}
	
	/* 站点访问与控制 */
	function sitecontrol($site_status, $site_status_item) {
		/* 回调参数 */
		$callFunc = msg_func ();
		
		$_m = _M ();
		$_t = common_value_get ( 'set_field', 'sitecontrol', 'field' );
		
		/* 初始化站点现有的状态 */
		$site_status_arr = common_value_get ( 'site_status' );
		/* 如果提交的值不存在,则默认 */
		if (check_is_key ( $site_status, $site_status_arr ) < 1) {
			$site_status = common_value_get ( 'site_status', 'close', 'field' );
		}
		if (check_is_array ( $site_status_item ) == 1) {
			$site_status_item = trim_addslashes ( en_serialize ( $site_status_item ) );
		}
		/* 字段初始 */
		$data_arr [] = array (
				$_m,
				$_t,
				'site_status',
				$site_status 
		);
		$data_arr [] = array (
				$_m,
				$_t,
				'site_status_item',
				$site_status_item 
		);
		
		$result = $this->set_save ( $data_arr );
		if ($result == $this->db->cw) {
			showmsg ( lang ( 'global:dbexception' ), NULL, $callFunc );
		}
		showmsg ( lang ( 'global:dbsuccess' ), NULL, $callFunc );
	}
	/* 站点信息配置 */
	function sitebase_set($site_name, $web_name, $web_url, $admin_email, $permit_code) {
		/* 回调参数 */
		$callFunc = msg_func ();
		
		$_m = _M ();
		$_t = config_name_val ( 'sitebase' );
		/* 字段初始 */
		$data_arr [] = array (
				$_m,
				$_t,
				'site_name',
				$site_name 
		);
		$data_arr [] = array (
				$_m,
				$_t,
				'web_name',
				$web_name 
		);
		$data_arr [] = array (
				$_m,
				$_t,
				'web_url',
				$web_url 
		);
		$data_arr [] = array (
				$_m,
				$_t,
				'admin_email',
				$admin_email 
		);
		$data_arr [] = array (
				$_m,
				$_t,
				'permit_code',
				$permit_code 
		);
		
		$result = $this->set_save ( $data_arr );
		if ($result == $this->db->cw) {
			showmsg ( lang ( 'global:dbexception' ), NULL, $callFunc );
		}
		showmsg ( lang ( 'global:dbsuccess' ), NULL, $callFunc );
	}
	/* 全局设置 */
	function setting($timezone, $timeoffset) {
		/* 回调参数 */
		$callFunc = msg_func ();
		
		$_m = _M ();
		$_t = common_value_get ( 'set_field', 'set', 'field' );
		/* 字段初始 */
		$data_arr [] = array (
				$_m,
				$_t,
				'timezone',
				$timezone 
		);
		$data_arr [] = array (
				$_m,
				$_t,
				'timeoffset',
				$timeoffset 
		);
		
		$result = $this->set_save ( $data_arr );
		if ($result == $this->db->cw) {
			showmsg ( lang ( 'global:dbexception' ), NULL, $callFunc );
		}
		showmsg ( lang ( 'global:dbsuccess' ), NULL, $callFunc );
	}
	/* 注册控制 */
	function register_set($register_type, $ischeckcode, $invitecode_msg, $close_msg, $toemailregister, $status, $send_system_msg, $send_email_msg, $msg_title, $msg_content, $show_serve_item, $serve_item_content) {
		/* 回调参数 */
		$url = msg_param ();
		$callFunc = msg_func ();
		$callFunc_b = msg_func ( 'callFunc_b' );
		
		/* 当前模块 */
		$_m = _M ();
		/* 类型 */
		$_t = common_value_get ( 'set_field', 'register_set', 'field' );
		/* 字段初始 */
		$data_arr [] = array (
				$_m,
				$_t,
				'register_type',
				$register_type 
		);
		$data_arr [] = array (
				$_m,
				$_t,
				'ischeckcode',
				$ischeckcode 
		);
		$data_arr [] = array (
				$_m,
				$_t,
				'invitecode_msg',
				$invitecode_msg 
		);
		$data_arr [] = array (
				$_m,
				$_t,
				'close_msg',
				$close_msg 
		);
		$data_arr [] = array (
				$_m,
				$_t,
				'toemailregister',
				$toemailregister 
		);
		$data_arr [] = array (
				$_m,
				$_t,
				'status',
				$status 
		);
		$data_arr [] = array (
				$_m,
				$_t,
				'send_system_msg',
				$send_system_msg 
		);
		$data_arr [] = array (
				$_m,
				$_t,
				'send_email_msg',
				$send_email_msg 
		);
		$data_arr [] = array (
				$_m,
				$_t,
				'msg_title',
				$msg_title 
		);
		$data_arr [] = array (
				$_m,
				$_t,
				'msg_content',
				$msg_content 
		);
		$data_arr [] = array (
				$_m,
				$_t,
				'show_serve_item',
				$show_serve_item 
		);
		$data_arr [] = array (
				$_m,
				$_t,
				'serve_item_content',
				$serve_item_content 
		);
		$result = $this->set_save ( $data_arr );
		if ($result == $this->db->cw) {
			showmsg ( lang ( 'global:dbexception' ), NULL, $callFunc );
		}
		showmsg ( lang ( 'global:dbsuccess' ), NULL, $callFunc );
	}
	/* 站点seo设置 */
	function siteseo_set($index_title, $index_keywords, $index_description) {
		/* 回调参数 */
		$callFunc = msg_func ();
		
		$_m = _M ();
		$_t = config_name_val ( 'seo' );
		/* 字段初始 */
		$data_arr [] = array (
				$_m,
				$_t,
				'index_title',
				$index_title 
		);
		$data_arr [] = array (
				$_m,
				$_t,
				'index_keywords',
				$index_keywords 
		);
		$data_arr [] = array (
				$_m,
				$_t,
				'index_description',
				$index_description 
		);
		
		$result = $this->set_save ( $data_arr );
		if ($result == $this->db->cw) {
			showmsg ( lang ( 'global:dbexception' ), NULL, $callFunc );
		}
		showmsg ( lang ( 'global:dbsuccess' ), NULL, $callFunc );
	}
	/* 邮箱配置设置 */
	function siteemail_set($status, $types, $smtp_server, $smtp_port, $smtp_from_email, $smtp_auth, $smtp_auth_username, $smtp_auth_password) {
		/* 回调参数 */
		$callFunc = msg_func ();
		
		$_m = _M ();
		$_t = config_name_val ( 'email_set' );
		
		/* 邮箱功能状态 */
		if (str_len ( $status ) < 1) {
			showmsg ( lang ( 'common:email_set_status_fail' ), NULL, $callFunc );
		}
		if (check_num ( yesno_val ( $status ) ) < 1) {
			showmsg ( lang ( 'common:email_set_status_fail' ), NULL, $callFunc );
		}
		/* 初始化值 */
		$data_arr [] = array (
				$_m,
				$_t,
				'status',
				$status 
		);
		/* 状态 */
		if (yesno_val ( $status, 'field' ) != yesno_val ( 'check', 'field' )) {
			/* 邮箱发送方式 */
			if (str_len ( $types ) < 1) {
				showmsg ( lang ( 'common:email_set_types_fail' ), NULL, $callFunc );
			}
			if (str_len ( config_value_get ( 'email_type', $types, 'field' ) ) < 1) {
				showmsg ( lang ( 'common:email_set_types_fail' ), NULL, $callFunc );
			}
			$data_arr [] = array (
					$_m,
					$_t,
					'types',
					$types 
			);
			/* 检查类型 */
			if (config_value_get ( 'email_type', $types, 'field' ) != config_value_get ( 'email_type', 'mail', 'field' )) {
				/* 是否需验证 */
				if (str_len ( $smtp_auth ) < 1) {
					showmsg ( lang ( 'common:email_set_smtp_auth_fail' ), NULL, $callFunc );
				}
				if (check_num ( yesno_val ( $smtp_auth ) ) < 1) {
					showmsg ( lang ( 'common:email_set_smtp_auth_fail' ), NULL, $callFunc );
				}
				/* 密码加密 */
				if (str_len ( $smtp_auth_password ) >= 1) {
					/* 是否为原密码标记 */
					$is_old = 0;
					/* 获取原的密码 */
					$result = $this->set_query ( array (
							'smodule' => $_m,
							'stype' => $_t,
							'svariable' => 'smtp_auth_password' 
					) );
					if ($result == $this->db->cw) {
						showmsg ( lang ( 'global:dbexception' ), NULL, $callFunc );
					}
					/* 检查是否和上次设置密码相同 */
					$old_pwd = config_val ( 'smtp_auth_password', $result );
					unset ( $result );
					if (str_len ( $old_pwd ) >= 1) {
						if ($old_pwd === $smtp_auth_password) {
							$is_old = 1;
						}
					}
				}
				/* 如果不为原密码,则加密密码 */
				if ($is_old != 1) {
					$smtp_auth_password = tostr_encode ( $smtp_auth_password );
				}
				$data_arr [] = array (
						$_m,
						$_t,
						'smtp_server',
						$smtp_server 
				);
				$data_arr [] = array (
						$_m,
						$_t,
						'smtp_port',
						$smtp_port 
				);
				$data_arr [] = array (
						$_m,
						$_t,
						'smtp_from_email',
						$smtp_from_email 
				);
				$data_arr [] = array (
						$_m,
						$_t,
						'smtp_auth',
						$smtp_auth 
				);
				$data_arr [] = array (
						$_m,
						$_t,
						'smtp_auth_username',
						$smtp_auth_username 
				);
				$data_arr [] = array (
						$_m,
						$_t,
						'smtp_auth_password',
						$smtp_auth_password 
				);
			}
		}
		$result = $this->set_save ( $data_arr );
		if ($result == $this->db->cw) {
			showmsg ( lang ( 'global:dbexception' ), NULL, $callFunc );
		}
		showmsg ( lang ( 'global:dbsuccess' ), NULL, $callFunc );
	}
	/* 站点风格设置 */
	function sitestyle_set($templateid, $navid) {
		/* 回调参数 */
		$callFunc = msg_func ();
		
		$_m = _M ();
		$_t = config_name_val ( 'sitestyle' );
		
		if (check_nums ( $templateid ) < 1) {
			showmsg ( lang ( 'common:tplan_templateid_fail' ), NULL, $callFunc );
		}
		if (check_nums ( $navid ) < 1) {
			showmsg ( lang ( 'common:tplan_navid_fail' ), NULL, $callFunc );
		}
		$data_arr [] = array (
				$_m,
				$_t,
				'templateid',
				$templateid 
		);
		$data_arr [] = array (
				$_m,
				$_t,
				'navid',
				$navid 
		);
		$result = $this->set_save ( $data_arr );
		unset ( $data_arr );
		if ($result == $this->db->cw) {
			showmsg ( lang ( 'global:dbexception' ), NULL, $callFunc );
		}
		showmsg ( lang ( 'global:dbsuccess' ), NULL, $callFunc );
	}
	/* 服务器优化设置 */
	function serveroptimize_set($temp_attach_expire, $thumb_clear_time, $onlinehold) {
		/* 回调参数 */
		$callFunc = msg_func ();
		
		$_m = _M ();
		$_t = common_value_get ( 'set_field', 'serveroptimize', 'field' );
		
		if (check_nums ( $temp_attach_expire ) < 1) {
			$temp_attach_expire = 1;
		}
		
		/* 缩略图清理时段 */
		$start_hour = array_key_val ( 'start_hour', $thumb_clear_time, 3 );
		$end_hour = array_key_val ( 'end_hour', $thumb_clear_time, 5 );
		if (check_num ( $start_hour ) < 1)
			$start_hour = 3;
		if (check_num ( $end_hour ) < 1)
			$end_hour = 5;
		if ($start_hour > $end_hour) {
			showmsg ( lang ( 'global:starttime_more_endtime' ), NULL, $callFunc );
		}
		$thumb_clear_time = en_serialize ( array (
				'start_hour' => $start_hour,
				'end_hour' => $end_hour 
		) );
		
		/* 在线保持时间 */
		if (check_nums ( $onlinehold ) < 1) {
			$onlinehold = 30;
		} else {
			if ($onlinehold < 5) {
				$onlinehold = 5;
			}
		}
		$dataArr [] = array (
				$_m,
				$_t,
				'temp_attach_expire',
				$temp_attach_expire 
		);
		$dataArr [] = array (
				$_m,
				$_t,
				'thumb_clear_time',
				$thumb_clear_time 
		);
		$dataArr [] = array (
				$_m,
				$_t,
				'onlinehold',
				$onlinehold 
		);
		$result = $this->set_save ( $dataArr );
		unset ( $dataArr );
		if ($result == $this->db->cw) {
			showmsg ( lang ( 'global:dbexception' ), NULL, $callFunc );
		}
		showmsg ( lang ( 'global:dbsuccess' ), NULL, $callFunc );
	}
}
?>