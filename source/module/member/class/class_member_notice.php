<?php
if (! defined ( 'IN_PATH' )) {
	exit ( 'no direct access allowed' );
}
class class_member_notice extends class_model {
	public $table_member_notice = 'member_notice';
	
	/* 析构函数 */
	function __construct() {
		parent::__construct ();
	}
	function class_member_notice() {
		$this->__construct ();
	}
	
	/* 条件查询 */
	function notice_query($_key, $_val = NULL) {
		$this->db->from ( $this->table_member_notice );
		$this->db->where ( $_key, $_val );
		$result = $this->db->select ();
		if ($result == $this->db->cw) {
			return $result;
		}
		$result = $this->db->get_one ();
		return $result;
	}
	/* 统计 */
	function notice_count($_key, $_val = NULL) {
		$this->db->from ( $this->table_member_notice );
		$this->db->where ( $_key, $_val );
		$result = $this->db->count_num ();
		$this->db->clear_sql ();
		if ($result == $this->db->cw) {
			$result = 0;
		}
		return $result;
	}
	/* 更改为已读 */
	function notice_isview($uid) {
		$yes = yesno_val ( 'normal' );
		$no = yesno_val ( 'check' );
		$this->db->from ( $this->table_member_notice );
		$this->db->where ( 'inboxuid', $uid );
		$this->db->where ( 'isview', $no );
		$this->db->set ( 'isview', $yes );
		$result = $this->db->update ();
		return $result;
	}
	/* 删除 */
	function notice_del($noticeid) {
		/* 回调参数 */
		$callFunc = msg_func ();
		$callFunc_b = msg_func ( 'callFunc_b' );
		
		if (check_nums ( $noticeid ) < 1) {
			domsg ( lang ( 'common:param_id_fail' ), NULL, $callFunc );
		}
		/* 检查是否存在 */
		$notice = $this->notice_query ( 'noticeid', $noticeid );
		if ($notice == $this->db->cw) {
			domsg ( lang ( 'common:dbexception' ), NULL, $callFunc );
		}
		if (check_is_array ( $notice ) < 1) {
			domsg ( lang ( 'common:param_id_noexist' ), NULL, $callFunc_b );
		}
		/* 删除 */
		$result = $this->db->db_delete ( $this->table_member_notice, 'noticeid', $noticeid );
		if ($result == $this->db->cw) {
			domsg ( lang ( 'common:dbexception' ), NULL, $callFunc );
		}
		domsg ( lang ( 'common:dbsuccess' ), NULL, $callFunc_b );
	}
}
?>