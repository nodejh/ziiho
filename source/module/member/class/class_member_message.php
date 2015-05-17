<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}

loader ( 'class:class_member', 'member', true );
class class_member_message extends class_member {
	public $table_member_message = 'member_message';
	
	/* 析构函数 */
	function __construct() {
		parent::__construct ();
	}
	function class_member_message() {
		$this->__construct ();
	}
	
	/* 条件查询 */
	function message_query($_key, $_val = NULL) {
		$this->db->from ( $this->table_member_message );
		$this->db->where ( $_key, $_val );
		$result = $this->db->select ();
		if ($result == $this->db->cw) {
			return $result;
		}
		$result = $this->db->get_one ();
		return $result;
	}
	/* 统计 */
	function message_count($_key, $_val = NULL) {
		$this->db->from ( $this->table_member_message );
		$this->db->where ( $_key, $_val );
		$result = $this->db->count_num ();
		$this->db->clear_sql ();
		if ($result == $this->db->cw) {
			$result = 0;
		}
		return $result;
	}
	/* 更改为已读 */
	function message_isview($uid) {
		$yes = yesno_val ( 'normal' );
		$no = yesno_val ( 'check' );
		$this->db->from ( $this->table_member_message );
		$this->db->where ( 'inboxuid', $uid );
		$this->db->where ( 'isview', $no );
		$this->db->set ( 'isview', $yes );
		$result = $this->db->update ();
		return $result;
	}
	/* 收件箱删除 */
	function inbox_del($messageid) {
		/* 回调参数 */
		$callFunc = msg_func ();
		$callFunc_b = msg_func ( 'callFunc_b' );
		
		if (check_nums ( $messageid ) < 1) {
			showmsg ( lang ( 'member:message_id_fail' ), NULL, $callFunc );
		}
		/* uid */
		$uid = get_user ( 'uid' );
		/* 消息状态 */
		$box_status = member_message_box_status ( 'normal' );
		/* 检查是否存在 */
		$msg = $this->message_query ( array (
				'messageid' => $messageid,
				'inboxuid' => $uid,
				'inbox' => $box_status 
		) );
		if ($msg == $this->db->cw) {
			showmsg ( lang ( 'common:dbexception' ), NULL, $callFunc );
		}
		if (check_is_array ( $msg ) < 1) {
			showmsg ( lang ( 'member:message_noexist' ), NULL, $callFunc_b );
		}
		/* 消息状态 */
		$box_del_status = member_message_box_status ( 'delete' );
		/* 如果发件人未删除,则编辑inboxuid=0,则删除 */
		if (array_key_val ( 'outbox', $msg ) != $box_del_status) {
			$result = $this->db->db_update ( $this->table_member_message, array (
					'inbox' => $box_del_status 
			), 'messageid', $messageid );
		} else {
			$result = $this->db->db_delete ( $this->table_member_message, 'messageid', $messageid );
		}
		if ($result == $this->db->cw) {
			showmsg ( lang ( 'common:dbexception' ), NULL, $callFunc );
		}
		showmsg ( lang ( 'common:dbsuccess' ), NULL, $callFunc_b );
	}
	/* 发件箱删除 */
	function outbox_del($messageid) {
		/* 回调参数 */
		$callFunc = msg_func ();
		$callFunc_b = msg_func ( 'callFunc_b' );
		
		if (check_nums ( $messageid ) < 1) {
			showmsg ( lang ( 'member:message_id_fail' ), NULL, $callFunc );
		}
		/* uid */
		$uid = get_user ( 'uid' );
		/* 消息状态 */
		$box_status = member_message_box_status ( 'normal' );
		/* 检查是否存在 */
		$msg = $this->message_query ( array (
				'messageid' => $messageid,
				'outboxuid' => $uid,
				'outbox' => $box_status 
		) );
		if ($msg == $this->db->cw) {
			showmsg ( lang ( 'common:dbexception' ), NULL, $callFunc );
		}
		if (check_is_array ( $msg ) < 1) {
			showmsg ( lang ( 'member:message_noexist' ), NULL, $callFunc_b );
		}
		/* 消息状态 */
		$box_del_status = member_message_box_status ( 'delete' );
		/* 如果收件人未删除,则编辑outboxuid=0,则删除 */
		if (array_key_val ( 'inbox', $msg ) != $box_del_status) {
			$result = $this->db->db_update ( $this->table_member_message, array (
					'outbox' => $box_del_status 
			), 'messageid', $messageid );
		} else {
			$result = $this->db->db_delete ( $this->table_member_message, 'messageid', $messageid );
		}
		if ($result == $this->db->cw) {
			showmsg ( lang ( 'common:dbexception' ), NULL, $callFunc );
		}
		showmsg ( lang ( 'common:dbsuccess' ), NULL, $callFunc_b );
	}
	/* 发送消息 */
	function message_write($username, $title, $content) {
		/* 回调参数 */
		$callFunc = msg_func ();
		$callFunc_b = msg_func ( 'callFunc_b' );
		
		/* 检查用户名 */
		if (str_len ( $username ) < 1) {
			showmsg ( lang ( 'member:message_write_username_null' ), NULL, $callFunc );
		}
		if (check_en_ep ( $username, 3, 20 ) < 1) {
			showmsg ( lang ( 'member:message_write_username_fail' ), NULL, $callFunc );
		}
		/* 检查标题 */
		if (str_len ( $title ) < 1) {
			showmsg ( lang ( 'member:message_write_title_null' ), NULL, $callFunc );
		}
		/* 检查内容 */
		if (str_len ( $content ) < 1) {
			showmsg ( lang ( 'member:message_write_content_null' ), NULL, $callFunc );
		}
		/* 检查收件人是否存在 */
		$member = $this->member_query ( 'username', $username );
		if ($member == $this->db->cw) {
			showmsg ( lang ( 'member:message_write_exception' ), NULL, $callFunc );
		}
		if (check_is_array ( $member ) < 1) {
			showmsg ( lang ( 'member:message_write_username_noexist' ), NULL, $callFunc );
		}
		/* 收件人uid */
		$inboxuid = $member ['uid'];
		/* 发送会员 */
		$uid = get_user ( 'uid' );
		/* 如果为自己,则不允许发送 */
		if ($inboxuid == $uid) {
			showmsg ( lang ( 'member:message_write_username_self' ), NULL, $callFunc );
		}
		/* 标注未读状态 */
		$isview = yesno_val ( 'check' );
		/* 以会员身份发送,允许回复 */
		$isreply = yesno_val ( 'normal' );
		/* 检查内容存在html,则编码 */
		$content = html_special ( $content );
		/* 消息状态 */
		$box_status = member_message_box_status ( 'normal' );
		/* 初始化值 */
		$dataArr = array (
				'inboxuid' => $inboxuid,
				'outboxuid' => $uid,
				'inbox' => $box_status,
				'outbox' => $box_status,
				'title' => $title,
				'content' => $content,
				'ctime' => $this->sys_time,
				'isview' => $isview,
				'isreply' => $isreply 
		);
		/* 发送 */
		$result = $this->db->db_insert ( $this->table_member_message, $dataArr );
		unset ( $dataArr );
		if ($result == $this->db->cw) {
			showmsg ( lang ( 'member:message_write_exception' ), NULL, $callFunc );
		}
		showmsg ( lang ( 'member:message_write_success' ), NULL, $callFunc_b );
	}
}
?>